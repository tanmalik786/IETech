<?php

	namespace App\Http\Controllers;

	use App\Models\Slider;
	use Illuminate\Http\Request;

	class SlidersController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			$sliders = Slider::where('type','!=', 'carousel')->orderBy('id', 'desc')->get();
			return view('sliders.index', compact('sliders'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\Slider       $slider
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request, Slider $slider)
		{
			$newSlider = $slider->create([
				'name' => $request->input('name'),
				'type' => 'slider'
			]);

			return redirect(route('sliders.edit', ['slider' => $newSlider->id]))->with('message', $this->_message('success', 'Successfully added new Slider'));
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Slider $slider)
		{
			$slides = $slider->slides;
			return view('sliders.edit', compact('slider', 'slides'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
			//
		}
	}
