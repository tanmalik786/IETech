<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Institute $institute, User $user)
    {
		$achievements = Post::where('user_id', $user->id)->where('type', 'achievements')->orderBy('id', 'desc')->get();
        return view('page-achievements', compact('achievements', 'user'));
    }

}
