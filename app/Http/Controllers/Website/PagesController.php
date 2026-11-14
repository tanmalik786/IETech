<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function show(Institute  $institute, User $user, Page $page)
    {

		$page->load(['sections' => function($query) {
			$query->orderBy('order', 'asc');
		}]);

        return view('page-template', compact('page', 'user'));
    }
}
