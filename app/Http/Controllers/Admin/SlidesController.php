<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlidesStoreRequest;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\View\View;
use File;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slides = Slide::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('admin.slides.index', compact('slides'));
    }


    /**
     * @param \App\Http\Requests\Admin\SlidesStoreRequest $request
     * @param \App\Models\User                            $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SlidesStoreRequest $request, User $user) {

        $fileName = $request->file('slide')->hashName();
        $request->slide->storeAs('public/slides', $fileName);

        $user->slides()->create(array_merge($request->except('slide'), ['name' => $fileName]));

        return redirect(route('slides'))->with('message', $this->_message('success','Successfully added new slide'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(SlidesStoreRequest $request, Slide $slide)
    {
			  $args = [];
        if( $request->has('slide') ) {
	        if( ! empty($slide->name) ) {
		        $slideImage = public_path("storage/slides/{$slide->name}"); // get previous image from folder
		        if (File::exists($slideImage)) { // unlink or remove previous image from folder
			        unlink($slideImage);
		        }
	        }
	        $args['name'] = $request->file('slide')->hashName();
	        $request->file('slide')->storeAs('public/slides', $args['name']);
        }

				$slide->update(array_merge($request->except('slide'), $args));
	      return redirect(route('slides'))->with('message', $this->_message('success','Successfully updated slide'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Slide $slide
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        if( ! empty($slide->name) ) {
            $slideImage = public_path("storage/slides/{$slide->name}"); // get previous image from folder
            if (File::exists($slideImage)) { // unlink or remove previous image from folder
                unlink($slideImage);
            }
        }

        $slide->delete();

        return redirect(route('slides'))->with('message', $this->_message('success','Successfully deleted slide'));
    }
}
