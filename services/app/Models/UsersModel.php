<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model {
	public $timestamps = false;
    protected $table = 'user';
    protected $primaryKey = 'id';
    
    
}