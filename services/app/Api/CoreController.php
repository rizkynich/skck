<?php
namespace App\Api;

use Mail;
use Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\ReferenceNumberModel;
class CoreController extends BaseController {
    protected $_currentClass;
    protected $_baseModelDirectory = "App\Models\\";
    protected $_modelPrefix = "Model";
    protected $_rule = NULL;

    protected $_maxListData = 20;
    /**
     * harus full address dengan namespace
     * contoh App\Models\mymodel;
     */
    protected $_overrideModel = NULL;
    protected $_currentNumber = 0;
    private $___modelClass;
    
    public function __construct() {
        $currentClass = basename(get_class($this));
        $this->_currentClass = $currentClass;

        //set default model
        $this->___modelClass = "{$this->_baseModelDirectory}{$this->_currentClass}{$this->_modelPrefix}";
        //override model jika diperlukan
        if (!empty($this->_overrideModel)) {
            $this->___modelClass = $this->_overrideModel;
        }
    }
        
    /**
     * listing request data
     */
    public function listData() {
        $myEloquent = new $this->___modelClass();
        $list  = $myEloquent::all();
        return response()->json(['status' => true, 'data' => $list]);
    }
    
    public function getById($id){
        $myEloquent = new $this->___modelClass();
        $data  = $myEloquent::find($id);
        return response()->json(['status' => true, 'data' => $data]);
    }
    
    public function getByNomorLayananSPS(Request $data){
        if($this->_rule != null){
            $validator = Validator::make($data->all(), $this->_rule);

            if($validator->fails()){
                $error = [
                    'status' => false,
                    'message' => 'validation_failed',
                    'errors' => $validator->errors()
                ];
                return response()->json($error);
            }
        }
//        echo $this->___modelClass();die();
        $myEloquent = new $this->___modelClass();
        $data  = $myEloquent::where('nomor_layanan', $data->input("nomor_layanan"))->first();
        return response()->json(['status' => true, 'data' => $data]);
    }
    
    public function getByNomorLayananSPSList(Request $data){
        if($this->_rule != null){
            $validator = Validator::make($data->all(), $this->_rule);

            if($validator->fails()){
                $error = [
                    'status' => false,
                    'message' => 'validation_failed',
                    'errors' => $validator->errors()
                ];
                return response()->json($error);
            }
        }
        
        $myEloquent = new $this->___modelClass();
        $data  = $myEloquent::where('nomor_layanan', $data->input("nomor_layanan"))->get();
        // $data->all();
        return response()->json(['status' => true, 'data' => $data]);
    }

    /**
     * menyimpan data kedalam database.
     * @param array $data
     * @return string json
     */
    public function save(Request $data_req){
        $data = $data_req->all();
        //rule checker
        if($this->_rule != null){
            $validator = Validator::make($data, $this->_rule);
            //validation failed
            if($validator->fails()){
                $error = [
                    'status' => false,
                    'message' => 'validation_failed',
                    'errors' => $validator->errors()
                ];
                return response()->json($error);
            }
        }
        
        //create instant class model
        $myEloquent = new $this->___modelClass();
        if (is_array($data) && !empty($data)) {
            foreach ($data as $field => $value) {
                $myEloquent->{$field} = $value;
            }
            // save data, return true jika sukses
            if ($myEloquent->save()) {
                return $myEloquent;
            }
        }

        return false;
    }


    /**
     *
     * update data on database by id
     * @param Request $data
     * @param int $data
     */
    public function update(Request $data, $id){
        if($this->_rule != null){
            $validator = Validator::make($data->all(), $this->_rule);

            if($validator->fails()){
                $error = [
                    'status' => false,
                    'message' => 'validation_failed',
                    'errors' => $validator->errors()
                ];
                return response()->json($error);
            }
        }

        $myEloquent = new $this->___modelClass();
        $myEloquent->find($id);

        $data_input = (object) $data->input();
        $vars = get_object_vars($data_input);
        foreach($vars as $key=>$value) {
            $myEloquent->{$key} = $value;
        }
        $myEloquent->save();
        return response()->json(['status' => true, 'data' => $myEloquent]);
    }

    public function delete($id){
        $myEloquent = new $this->___modelClass();
        $myEloquent->find($id);
        $myEloquent->delete();
        return response()->json("success");
    }


    /**
     * mentotal seluruh data yang didapat
     * @param array $condition
     * @return int
     */
    public function total($condition = array()) {
        $myEloquent = new $this->___modelClass();
        if (is_array($condition) && !empty($condition)) {
            return $myEloquent::where($condition)->count();
        }

        return $myEloquent->count();
    }


    /**
     * membuat row reference number baru jika tidak ada
     * @param string $refname
     * @return ReferenceNumberModel instant class
     */
    protected function _addNewReferenceNumber($refname, $portcode) {
        $refNumModel = new ReferenceNumberModel();
        $refNumModel->current_year = date("Y");
        $refNumModel->current_month = date("m");
        $refNumModel->reference_name = $refname;
        $refNumModel->portcode = $portcode;
        $refNumModel->save();

        return $refNumModel;
    }


    /**
     * Membuat nomor urut, max number default adalah 7 digit
     * @param int $number
     * @param int $maxNumber
     * @return string
     */
    protected function _createCounterNumber($number, $maxNumber = 7) {
        //set counter current number;
        // echo $number;
        // die();
        $this->_currentNumber = $number;

        $currentNumber  = $number + 1;
        $numberLength   = strlen((string) $currentNumber);
        $createNumber   = str_repeat("0", ($maxNumber - $numberLength));
        // echo $createNumber.$currentNumber;
        // die();
        return "{$createNumber}{$currentNumber}";
    }


    /**
     * Update counter number by key name and current year
     * @param string $keyname
     * @return string
     */
    protected function _updateCounterNumber($keyname, $portcode) {
        $currentYear    = date("Y");
        $currentMonth   = date("m");
        $currentNumber  = $this->_currentNumber;
        $objNumber      = ReferenceNumberModel::where('current_month', $currentMonth)
                        ->where('current_year', $currentYear)
                        ->where('reference_name', $keyname)
                        ->where('portcode', $portcode)
                        ->first();
        
        $objNumber->current_number = ($currentNumber + 1);
        $objNumber->save();
    }


    /**
     * generate product number
     * @protected method
     * @param string $keyname
     * @param string $kodeLayanan
     * @param string $kodePelabuhan
     * @return string
     */
    protected function _generateProductNumber($keyname, $kodeLayanan, $kodePelabuhan) {
        $buildProdNum   = "";
        $currentYear    = date("Y");
        $currentMonth   = date("n");
        $twoDMonth      = date("m");
        $twoDYear       = date("y");
        $objNumber      = ReferenceNumberModel::where('current_month', $currentMonth)
                        ->where('current_year', $currentYear)
                        ->where('reference_name', $keyname)
                        ->where('portcode', $kodePelabuhan)
                        ->first();

        //check if $objNumber is found
        if ($objNumber) {
            $myNumber = $this->_createCounterNumber($objNumber->current_number, 6);
        } else {
            //add new reference number
            $objNumber = $this->_addNewReferenceNumber($keyname, $kodePelabuhan);
            $myNumber = $this->_createCounterNumber(0, 6);
        }

        $buildProdNum = "{$kodeLayanan}.{$kodePelabuhan}.{$twoDMonth}{$twoDYear}.{$myNumber}";
        //save current number;
        $this->_updateCounterNumber($keyname, $kodePelabuhan);

        return $buildProdNum;
    }

    
    protected function ___triggerSearch($instanceClass, $arrSearch) {
      if (is_array($arrSearch) && !empty($arrSearch)) {
        foreach ($arrSearch as $key => $val) {
          if (!empty($val)) {
            $instanceClass = $instanceClass->where($key, "LIKE", "%{$val}%"); 
          }
        }
      }
      return $instanceClass;
    }


    /*
    * function untuk notifikasi
    */
    public function notifikasi($to, $subject, $mail_data){
        $header = ['to'=>$to,'bcc'=>'inaportnet@dephub.go.id','subject'=>$subject];
        $data = ['title' => $mail_data['title'], 'messages'=> $mail_data['messages']];
        Mail::send('user_notif', $data, function($message) use ($header){
            $message->to($header['to'])->subject($header['subject'])->from("admin-inaportnet@dephub.go.id");
        });
        
        // $header = ['to'=>"rizky.nich@gmail.com",'bcc'=>'inaportnet@dephub.go.id','subject'=>"email inaportnet"];
        // $header = ['to'=>"rizky.nich@gmail.com",'subject'=>"email inaportnet"];
        // $data = ['title' => "coba coba", 'messages'=> "coba email"];
        // return view("user_notif", $data);
        // Mail::send('user_notif', $data, function($message) use ($header){
        //     $message->to($header['to'])->subject($header['subject'])->from("admin-inaportnet@dephub.go.id");
        // });
    }

}