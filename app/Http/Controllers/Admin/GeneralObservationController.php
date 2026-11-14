<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\ObservationActivityStoreRequest;
	use App\Models\Observation;
	use Illuminate\Http\Request;

	class GeneralObservationController extends Controller {

		public function create( Request $request, Observation $observation ) {
			$questions = $this->getQuestions( 'Observation Questionnaire' );

			return view( 'admin.general-observations.create', compact( 'observation', 'questions' ) );
		}

		public function store( ObservationActivityStoreRequest $request, Observation $observation ) {

			if ( $request->has( 'activities' ) ) {
				foreach ( $request->input( 'activities' ) as $key => $activity ) {
					$observation->details()->create( [
						'activity' => $activity,
						'step'     => 'Expert Questionnaire',
						'response' => $request->input( 'responses' )[ $key ] ?? '',
					] );
				}
			}

			return redirect( route( 'observations', [ 'observation_type' => $observation->type->name ] ) )->with( 'message', $this->_message( 'success', 'Successfully added activity to this observation' ) );
		}
	}
