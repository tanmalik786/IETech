<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Observation;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HourLogsController extends Controller
{

	public function index(Institute $institute, User $user) {
		$hourlog = Post::where('user_id', $user->id)->where('type', 'logs')->orderBy('id', 'desc')->first();
		return view('page-hour-logs', compact('hourlog', 'user'));
    }
}
