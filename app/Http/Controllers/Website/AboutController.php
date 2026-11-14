<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{

	public function index(Institute $institute) {

		$page = Page::where('institute_id', $institute->id)
		            ->where('slug', 'about')->first();
		$user = auth()->user();

		return view('page-template', compact('page', 'user'));
    }
}
