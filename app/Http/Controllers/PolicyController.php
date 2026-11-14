<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{

	public function index(Request  $request) {
		return view('page-policy')->with('policy',$request->input('pn'));
    }
}
