<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\PlacementTask;
use App\Models\User;
use Illuminate\Http\Request;

class PlacementTaskController extends Controller
{

	public function show(Institute $institute, User $user) {
		return view('page-placement-task')->with([
			'institute' => $institute,
			'user' => $user,
			'placement_task' => PlacementTask::where('user_id', $user->id)->orderBy('id', 'desc')->first()
		]);
    }
}
