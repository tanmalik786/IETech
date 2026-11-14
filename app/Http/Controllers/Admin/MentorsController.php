<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MentorsController extends Controller
{

	public function index(Request $request) {

		$query = User::query();
		$query
			->whereHas('roles', function($query) {
				$query->where('name', 'Mentor');
			})
			->where('link_tutor_id', auth()->id());

		$mentors = $query->orderBy('id', 'desc')->paginate(30);

		return view('admin.mentors.index', compact('mentors'));
	}
}
