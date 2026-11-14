<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Institute $institute, User $user)
    {
		$reviews = Review::where('user_id', $user->id)->orderBy('id','desc')->get();
        return view('page-reviews', compact('reviews', 'user', 'institute'));
    }

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\User   $user
	 * @param \App\Models\Review $review
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
    public function show(Institute $institute, User $user, Review $review) {
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
        return view('page-review', compact('user', 'review', 'observation_mapping', 'institute') );
    }
}
