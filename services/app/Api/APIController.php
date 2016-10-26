<?php

namespace App\Api;

use App\User;
use App\Api\CoreController as WsCore;

class APIController extends WsCore {

	public function __construct() {
   		$this->middleware('jwt.auth', ['except' => ['authenticate']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
	}

	public function getUser() {
   		return response()->json(User::limit(10)->get());
	}

	public function getUserPost() {
   		return response()->json(User::limit(10)->get());
	}
}