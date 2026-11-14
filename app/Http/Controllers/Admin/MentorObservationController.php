<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\Observation;
	use App\Models\Rationale;
	use Illuminate\Http\Request;

	class MentorObservationController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index() {
			$query = Observation::query();

			$query->whereHas( 'mentorObservation' );

			if ( auth()->user()->hasRole( 'Mentor' ) ) {
				$query->where( 'user_id', auth()->id() );
			}

			$observations = $query->orderBy( 'id', 'desc' )->get();

			return view( 'admin.mentor-observations.index', compact( 'observations' ) );
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function create( Rationale $rationale ) {
			$questions = $this->getQuestions( 'Mentor Questionnaire' );

			return view( 'admin.mentor-observations.create', compact( 'rationale', 'questions' ) );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\Rationale    $rationale
		 * @param \App\Models\Observation  $observation
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store( Request $request, Rationale $rationale, Observation $observation ) {
			$new_observation = $observation->create( [
				'user_id' => auth()->id(),
			] );

			if ( $new_observation ) {
				$mentor_observation = $new_observation->mentorObservation()
				                                      ->create( [
					                                      'user_id'         => auth()->id(),
					                                      'observer_id'     => auth()->id(),
					                                      'observed_id'     => $rationale->observed_id,
					                                      'course_year'     => $rationale->course_year,
					                                      'observed_course' => $rationale->observed_course,
					                                      'strength'        => $rationale->strength,
					                                      'organization'    => $rationale->organization,
					                                      'date'            => $rationale->date,
				                                      ] );

				if ( $mentor_observation ) {
					if ( $request->has( 'activities' ) ) {
						foreach ( $request->input( 'activities' ) as $key => $activity ) {
							$new_observation->details()->create( [
								'activity' => $activity,
								'step'     => 'Mentor Questionnaire',
								'response' => $request->input( 'responses' )[ $key ] ?? '',
							] );
						}
					}
				}
			}

			return redirect( route( 'mentor-observation' ) )->with( 'message', $this->_message( 'success', 'Observation submitted successfully' ) );
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
		 * @param \App\Models\Observation $observation
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function edit( Observation $observation ) {
			$questions = $this->getQuestions( 'Mentor Questionnaire' );

			return view( 'admin.mentor-observations.edit', compact( 'questions', 'observation' ) );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\Observation  $observation
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update( Request $request, Observation $observation ) {

			$observation->mentorObservation->update( [
				'course_year'     => $request->input( 'year_group' ),
				'observed_course' => $request->input( 'course_title' ),
				'strength'        => $request->input( 'number_of_students' ),
				'organization'    => $request->input( 'organization' ),
				'date'            => $request->input( 'date' ),
			] );


			if ( $request->has( 'activities' ) ) {
				$observation->details()->delete();
				foreach ( $request->input( 'activities' ) as $key => $activity ) {

					$response = '';

					if ( isset( $request->input( 'responses' )[ $key ] ) ) {
						$response = is_array( $request->input( 'responses' )[ $key ] ) ? implode( ',', $request->input( 'responses' )[ $key ] ) : $request->input( 'responses' )[ $key ];
					}

					$observation->details()->create( [
						'activity' => $activity,
						'step'     => 'Mentor Questionnaire',
						'response' => $response
			    ] );
				}
			}

			return redirect( route( 'mentor-observation' ) )->with( 'message', $this->_message( 'success', 'Successfully updated observation' ) );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $id ) {
			//
		}
	}
