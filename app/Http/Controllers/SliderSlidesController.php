<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Slider;
use Illuminate\Http\Request;
use File;

class SliderSlidesController extends Controller
{

	public function store(Request $request, Slider $slider) {

		$fileName = $request->file('slide')->hashName();
		$request->slide->storeAs('public/slides', $fileName);

		$slider->slides()->create(array_merge($request->except('slide'), ['name' => $fileName, 'user_id' => auth()->id()]));

		return redirect(route('sliders.edit', ['slider' => $slider->id]))->with('message', $this->_message('success','Successfully added new slide'));
    }

	public function update(Request $request, Slide $slide) {

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
		return redirect(route('sliders.edit', ['slider' => $slide->slider_id]))->with('message', $this->_message('success','Successfully added new slide'));

	}

	public function destroy(Request $request, Slide $slide) {

		$slider_id = $slide->slider_id;
		if( ! empty($slide->name) ) {
			$slideImage = public_path("storage/slides/{$slide->name}"); // get previous image from folder
			if (File::exists($slideImage)) { // unlink or remove previous image from folder
				unlink($slideImage);
			}
		}

		$slide->delete();

		return redirect(route('sliders.edit', ['slider' => $slider_id]))->with('message', $this->_message('success','Successfully deleted slide'));
	}
}
