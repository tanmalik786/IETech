<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class MinimumCoreController extends Controller
{

	/**
	 * @param \App\Models\Institute $institute
	 * @param \App\Models\User      $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function show( Institute $institute, User $user)
    {
        $cores = Post::where('user_id', $user->id)->where('type', 'minimum_core')->orderBy('id', 'desc')->get();
		return view('page-minimum-core', compact('cores', 'user'));
    }
}
