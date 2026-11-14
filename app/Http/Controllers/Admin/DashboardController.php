<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

	public function index(Request $request) {

		$query = User::query();

		$query->whereHas('roles', function($query) {
			$query->where('name', 'Teaching Student');
		});

		if( auth()->user()->hasRole('Mentor')) {
			$query->where('mentor_id', auth()->id());
		}

		if( auth()->user()->hasRole('Link Tutor') ) {
			$query->where('link_tutor_id', auth()->id());
		}

		$students = $query->orderBy('id', 'desc')->paginate(30);

		return view('admin.dashboard', compact('students'));
    }
}
