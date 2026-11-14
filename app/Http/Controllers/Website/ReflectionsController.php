<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\User;
use Illuminate\Http\Request;

class ReflectionsController extends Controller
{

	public function index( Institute $institute, Request $request, User $user) {
		$reflections = $user->reflections;
		return view('page-reflections', compact('reflections', 'user'));
    }
}
