<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\ObservationActivityStoreRequest;
	use App\Models\ExpertObservation;
	use App\Models\Observation;
	use App\Models\User;
	use Carbon\Carbon;
	use Illuminate\Http\Request;

	class ExpertObservationController extends Controller {

		/**
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index() {
			$query = ExpertObservation::query();

			$viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
			if( ! empty( $viewing_as ) ) {
				$query->where( 'user_id', $viewing_as->id );
			} else {
				if ( ! auth()->user()->hasAnyRole( [
					'Mentor',
					'Link Tutor'
				] ) ) {
					$query->where( 'user_id', auth()->id() );
				}
			}

			$observations = $query->orderBy( 'id', 'desc' )->paginate( 100 );

			return view( 'admin.v2.expert.index', compact( 'observations' ) );
		}

		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function create( Request $request ) {
			$sections = $this->getQuestions( 'Expert Questionnaire' );
			$teachers = User::whereHas( 'roles', function ( $query ) {
				$query->whereIn( 'name', [ 'Link Tutor', 'Mentor' ] );
			} )->where( 'id', '!=', auth()->id() )
			   ->where('institute_id', auth()->user()->institute_id)
			   ->get();


			return view( 'admin.v2.expert.create', compact( 'sections', 'teachers' ) );
		}

		/**
		 * @param \App\Models\ExpertObservation $expert_observation
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function edit( ExpertObservation $expert_observation ) {
			$sections    = $this->getQuestions( 'Expert Questionnaire' );
			$teachers    = User::whereHas( 'roles', function ( $query ) {
				$query->whereIn( 'name', [ 'Teaching Student', 'Link Tutor', 'Mentor' ] );
			} )->where( 'id', '!=', auth()->id() )->get();
			$observation = $expert_observation;

			return view( 'admin.v2.expert.edit', compact( 'sections', 'teachers', 'observation' ) );
		}

		/**
		 * Display the specified resource.
		 *
		 * @param \App\Models\ExpertObservation $observation
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function show(ExpertObservation $expert_observation)
		{
			return view('admin.v2.expert.show', compact('expert_observation'));
		}

		/**
		 * @param \App\Http\Requests\Admin\ObservationActivityStoreRequest $request
		 * @param \App\Models\ExpertObservation                            $observation
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store( ObservationActivityStoreRequest $request, ExpertObservation $observation ) {

			$newObservation = $observation->create( [
				'observer_id' => $request->input( 'observer_id' ),
				'observed_id' => $request->input( 'observed_id' ),
				'user_id'     => auth()->id(),
				'date'        => $request->input( 'date' ),
			] );

			if ( $newObservation ) {
				if ( $request->has( 'activities' ) ) {
					foreach ( $request->input( 'activities' ) as $key => $activity ) {
						$newObservation->details()->create( [
							'activity' => $activity,
							'step'     => 'Expert Questionnaire',
							'response' => $request->input( 'responses' )[ $key ] ?? '',
						] );
					}
				}
			}

			return redirect( route( 'expert.observations' ) )->with( 'message', $this->_message( 'success', 'Successfully create new expert observation' ) );
		}

		/**
		 * @param \App\Http\Requests\Admin\ObservationActivityStoreRequest $request
		 * @param \App\Models\ExpertObservation                            $expert_observation
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update( ObservationActivityStoreRequest $request, ExpertObservation $expert_observation ) {
			$expert_observation->update( [
				'observed_id' => $request->input( 'observed_id' ),
				'date'        => $request->input( 'date' ),
			] );
			if ( $request->has( 'activities' ) ) {
				$expert_observation->details()->delete();
				foreach ( $request->input( 'activities' ) as $key => $activity ) {
					$expert_observation->details()->create( [
						'activity' => $activity,
						'step'     => 'Expert Questionnaire',
						'response' => $request->input( 'responses' )[ $key ] ?? '',
					] );
				}
			}

			return redirect( route( 'expert.observations' ) )->with( 'message', $this->_message( 'success', 'Successfully updated observation' ) );
		}

		/**
		 * @param \App\Models\ExpertObservation $expert_observation
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function destroy( ExpertObservation $expert_observation ) {
			$expert_observation->details()->delete();
			$expert_observation->delete();

			return redirect( route( 'expert.observations' ) )->with( 'message', $this->_message( 'success', 'Successfully deleted observation' ) );
		}
	}
