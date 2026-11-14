<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class InstituteController extends Controller
{

	public function index(Institute $institute) {
		$users = User::whereHas('roles', function($query){
			$query->where('name', 'Teaching Student');
		})->where('institute_id', $institute->id)->orderBy('id', 'desc')->get();
		$page = Page::where('slug', 'home')->where('institute_id', $institute->id)->first();

		return view('website.institute.index', compact('institute', 'users', 'page'));
    }
}
