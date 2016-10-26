<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class RegistrasiModel extends Model {
	public $timestamps = false;
	
	protected $table = 'registrasi';
	protected $primarykey = "id";
}