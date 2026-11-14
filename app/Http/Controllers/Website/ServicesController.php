<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Page;
use Illuminate\Http\Request;

class ServicesController extends Controller
{

	public function index(Institute $institute) {

		$page = Page::where('institute_id', $institute->id)
		            ->where('slug', 'services')->first();
		$user = auth()->user();

		return view('page-template', compact('page', 'user'));
	}
}
