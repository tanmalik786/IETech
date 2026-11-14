<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Rationale;
use App\Models\User;
use Illuminate\Http\Request;

class RationaleController extends Controller
{

	public function index(Institute $institute, User $user, Request $request) {
		$rationales = Rationale::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
		return view('page-rationales', compact('rationales', 'user' ,'institute'));
    }

	public function show(Institute $institute, User $user, Rationale $rationale) {
		return view('page-rationale', compact('rationale', 'user', 'institute'));
	}
}
