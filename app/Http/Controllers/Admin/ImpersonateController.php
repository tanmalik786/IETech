<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{

	public function login(Request $request) {
		session()->put('viewing', User::find($request->input('student_id')));
		return redirect()->route('home');
    }


	public function logout(Request $request) {
		session()->forget('viewing');
		return redirect()->route('home');
	}
}
