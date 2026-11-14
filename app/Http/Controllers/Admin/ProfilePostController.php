<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilePostController extends Controller
{

    /**
     * @param \App\Http\Requests\Admin\PostRequest $request
     * @param \App\Models\User                     $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostRequest $request, User $user) {


        $newPost = $user->posts()->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'type' => $request->input('type'),
            'category' => $request->input('category')
        ]);

        if( $newPost && $request->has('metas') ) {
            foreach( $request->input('metas') as $meta ) {
                $newPost->postMetas()->create([
                    'meta_key' => $meta['meta_key'],
                    'meta_value' => $meta['meta_value'] ?? null
                ]);
            }
        }

        return redirect(route('profile'))->with('message', $this->_message('success', 'Profile updated successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\PostRequest $request
     * @param \App\Models\Post                     $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category' => $request->input('category')
        ]);

        if( $request->has('metas') ) {

            $post->postMetas()->delete();

            foreach( $request->input('metas') as $meta ) {
                $post->postMetas()->create([
                    'meta_key' => $meta['meta_key'],
                    'meta_value' => $meta['meta_value'] ?? null
                ]);
            }
        }

        return redirect(route('profile'))->with('message', $this->_message('success', 'Profile updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->postMetas()->delete();
        $post->delete();
        return redirect(route('profile'))->with('message', $this->_message('success', 'Profile updated successfully'));
    }
}
