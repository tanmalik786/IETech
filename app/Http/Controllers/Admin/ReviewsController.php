<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\Institute;
	use App\Models\Observation;
	use App\Models\ObservationType;
	use App\Models\Review;
	use App\Models\ReviewDetail;
	use App\Models\User;
	use Illuminate\Http\Request;

	class ReviewsController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index( Request $request ) {

			$query = Review::query();

			$viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
			if( ! empty( $viewing_as ) ) {
				$query->where( 'user_id', $viewing_as->id );
			} else {
				if( auth()->user()->hasRole('Teaching Student') ) {
					$query->where( 'user_id', auth()->id() );
				} else if( auth()->user()->hasRole('Mentor') ) {
					$query->whereIn('user_id', auth()->user()->students()->pluck('id')->toArray());
				} else if( auth()->user()->hasRole('Link Tutor') ) {
					$student_ids = User::where('institute_id', auth()->user()->institute_id)
					                   ->whereHas('roles', function($query) {
						                   $query->where('name', '=', 'Teaching Student');
					                   })->where('link_tutor_id', auth()->id())->pluck('id')->toArray();
					$query->where(
						'user_id',
						$student_ids
					);
				}
			}


			$reviews = $query->orderBy('id', 'desc')->get();

			return view( 'admin.reviews.index', compact( 'reviews' ) );
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create( Request $request ) {
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

			$clone = false;
			return view( 'admin.reviews.create-update', compact( 'observation_mapping', 'clone' ) );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\Review       $review
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function store( Request $request, Review $review ) {


			if ( ! $request->has( 'review_id' ) || empty( $request->input( 'review_id' ) ) ) {
				$newReview = $review->create( [
					'stage'               => $request->input('stage'),
					'user_id'             => auth()->id(),
				] );
			} else {
				$newReview = Review::find( $request->input( 'review_id' ) );
			}


			if ( $request->has( 'activities' ) ) {
				foreach ( $request->input( 'activities' ) as $key => $activity ) {
					$reviewDetail = $newReview->details()->updateOrCreate( [
						'activity' => $activity,
						'step'     => $request->input( 'step' ),
						'review_id' => $newReview->id,
					], [
						'response' => $request->input( 'responses' )[ $key ] ?? '',
					] );

					if( $request->has('sub_activities') && isset($request->input('sub_activities')[$key])) {
						$reviewDetail->subActivity()->updateOrCreate([
							'review_id' => $newReview->id,
							'parent_id' => $reviewDetail->id,
							'activity'       => $request->input( 'sub_activities' )[ $key ],
							'step'           => $request->input( 'step' ),
						],[
								'response'       => $request->input( 'sub_responses' )[ $key ] ?? '',
							]
						);
					}
				}
			}

			return response()->json( [
				'status'         => 'success',
				'message'        => 'form stored successfully',
				'review_id' => $newReview->id,
			] );
		}

		/**
		 * Display the specified resource.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show( $id ) {
			//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit( $id ) {
			$review         = Review::find( $id );
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

			$clone = false;

			return view( 'admin.reviews.create-update', compact( 'observation_mapping', 'review', 'clone' ) );
		}

		/**
		 * @param $id
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function clone( $id ) {
			$review         = Review::find( $id );
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

			$clone = true;
			return view( 'admin.reviews.create-update', compact( 'observation_mapping', 'review', 'clone' ) );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param int                      $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request, $id ) {
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $id ) {
			$review = Review::find($id);

			if( count($review->details) > 0 ) {
				foreach($review->details as $detail) {
					$detail->subActivity()->delete();
				}
			}

			$review->details()->delete();
			$review->delete();

			return redirect(route('review-forms'))->with('message', $this->_message('success', 'Action Successfull'));
		}
	}
