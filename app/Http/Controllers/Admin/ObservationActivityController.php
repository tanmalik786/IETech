<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\ObservationActivityStoreRequest;
	use App\Models\Observation;
	use App\Models\ObservationDetail;
	use App\Models\ObservationStep;
	use App\Models\ObservationType;
	use Illuminate\Http\Request;

	class ObservationActivityController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
		 */
		public function index( Request $request ) {
			//
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
		 */
		public function create( Observation $observation, ObservationType $observation_type, ObservationStep $observationStep ) {
			$questions = $this->getQuestions($observationStep->name);
			return view( "admin.observations.activities.create", compact( 'questions', 'observationStep', 'observation', 'observation_type' ) );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \App\Http\Requests\Admin\ObservationActivityStoreRequest $request
		 * @param \App\Models\Observation                                  $observation
		 * @param \App\Models\ObservationStep                              $observation_step
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
		 */
		public function store( ObservationActivityStoreRequest $request, Observation $observation, ObservationType $observation_type, ObservationStep $observationStep ) {


			if ( $request->has( 'activities' ) ) {
				foreach ( $request->input( 'activities' ) as $key => $activity ) {
					$observation->details()->create( [
						'activity'            => $activity,
						'observation_step_id' => $observationStep->id,
						'response'            => $request->input( 'responses' )[ $key ],
					] );
				}
			}

			$observationStep = $this->getNextStep( $observation );

			if ( false === $observationStep || $observation_type->slug != 'shadow' ) {
				return redirect( route( 'observations', ['observation_type' => $observation_type->slug] ) )->with( 'message', $this->_message( 'success', 'Successfully completed observation' ) );
			}

			return redirect( route( 'observations.activities.create', [ 'observation' => $observation, 'observation_type' => $observation_type->slug, 'observationStep' => $observationStep->slug ] ) );

		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
		 */
		public function edit( Observation $observation, ObservationType $observation_type, ObservationStep $observationStep) {
			$questions = $this->getQuestions($observationStep->name);
			return view( 'admin.observations.activities.edit', compact( 'questions', 'observation', 'observationStep', 'observation_type' ) );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \App\Http\Requests\Admin\ObservationActivityStoreRequest $request
		 * @param \App\Models\Observation                                  $observation
		 * @param \App\Models\ObservationStep                              $observationStep
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( ObservationActivityStoreRequest $request, Observation $observation, ObservationType $observation_type, ObservationStep $observationStep) {

			if ( $request->has( 'activities' ) ) {

				$observation->details()->where("observation_step_id", $observationStep->id)->delete();

				foreach ( $request->input( 'activities' ) as $key => $activity ) {

					$observation->details()->create( [
						'activity'            => $activity,
						'observation_step_id' => $observationStep->id,
						'response'            => $request->input( 'responses' )[ $key ],
					] );
				}
			}

			$observationStep = $this->getNextStep( $observation, $observation_type->slug == 'shadow' ? false : $observation_type, $observationStep->id );


			if ( false === $observationStep || $observation_type->slug != 'shadow' ) {
				return redirect( route( 'observations', ['observation_type' => $observation_type->slug] ) )->with( 'message', $this->_message( 'success', 'Successfully updated observation' ) );
			}

			return redirect( route( 'observations.activities.edit', [ 'observation' => $observation, 'observation_type' => $observation_type->slug, 'observationStep' => $observationStep->slug ] ) );
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
