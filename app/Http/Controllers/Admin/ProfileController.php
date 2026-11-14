<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $qualifications = Post::mine()->qualifications()->orderBy('created_at', 'desc')->get();
        $experiences = Post::mine()->experiences()->orderBy('created_at', 'desc')->get();
        $achievements = Post::mine()->achievements()->orderBy('created_at', 'desc')->get();

        return view('admin.profile', compact('qualifications', 'experiences', 'achievements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User         $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->except('_token'));
        return redirect(route('profile'))->with('message', $this->_message('success', 'Profile updated successfully'));
    }

}
