<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewFeedback;
use Illuminate\Http\Request;

class ReviewFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Review $review )
    {
	    $observation_mapping = [
		    [
			    'display_name' => 'Professional values and attributes',
			    'step'         => 'Professional-values-and-attributes',
			    'questions'    => $this->getQuestions( 'Professional-values-and-attributes' ),
		    ],
		    [
			    'display_name' => 'Professional knowledge and understanding',
			    'step'         => 'Professional-knowledge-and-understanding',
			    'questions'    => $this->getQuestions( 'Professional-knowledge-and-understanding' ),
		    ],
		    [
			    'display_name' => 'Professional Skills',
			    'step'         => 'Professional-Skills',
			    'questions'    => $this->getQuestions( 'Professional-Skills' ),
		    ],
	    ];


        return view('admin.review-feedback.create', compact('observation_mapping', 'review') );
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Review       $review
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function store(Request $request, Review $review )
    {
		ReviewFeedback::updateOrCreate([
			'user_id' => auth()->id(),
			'review_id' => $review->id,
			'step' => $request->input('step')
		], [
			'feedback' => $request->input('feedback')
		]);

	    return response()->json( [
		    'status'         => 'success',
		    'message'        => 'form stored successfully',
		    'review_id' => $review->id,
	    ] );
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
    public function edit($id)
    {
        //
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
