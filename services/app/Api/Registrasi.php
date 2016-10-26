<?php
namespace App\Api;
use App\Models\RegistrasiModel;

use Illuminate\Http\Request;
use App\Api\CoreController as WsCore;

class Registrasi extends WsCore {
	public function byNik($nik){
        $myEloquent = RegistrasiModel::where("no_ktp",$nik)->orderby("id","desc")->first();
        return response()->json(['status' => true, 'data' => $myEloquent]);
	}

	public function byReg(Request $data) {
        $postData   = (object) $data->input();
        $myEloquent = RegistrasiModel::where("nomor_registrasi",$postData->nomor_registrasi)->first();
        return response()->json(['status' => true, 'data' => $myEloquent]);
	}
}