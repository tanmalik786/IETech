<?php

namespace App\Http\Controllers\Admin\V2;

use App\Http\Controllers\Controller;
use App\Models\Observation;
use App\Models\Rationale;
use App\Models\User;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index( Request $request )
    {
		$query = Observation::query();

	    $viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
	    if( ! empty( $viewing_as ) ) {
		    $query->where( 'observed_id', $viewing_as->id );
	    } else {
		    if ( auth()->user()->hasRole( 'Teaching Student' ) ) {
			    $query->where( 'observed_id', auth()->id() );
		    } else if ( auth()->user()->hasAnyRole( [
			    'Mentor',
			    'Link Tutor'
		    ] ) ) {
			    $query->where( 'observer_id', auth()->id() );
		    }
	    }

		$observations = $query->orderBy('id', 'desc')->paginate(25);

        return view('admin.v2.observations.index', compact('observations'));
    }

    /**
     * Show the form for creating a new resource.
     * @param \App\Models\Rationale $rationale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create( Rationale $rationale )
    {
	    $type = auth()->user()->hasRole('Mentor') ? 'Mentor Questionnaire' : 'Observation Questionnaire';
	    $questions = $this->getQuestions( $type );

	    return view('admin.v2.observations.create', compact('rationale', 'questions'));
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

		$type = auth()->user()->hasRole('Mentor') ? 'Mentor Questionnaire' : 'Observation Questionnaire';

		$new_observation = $observation->create( [
			'user_id'         => auth()->id(),
			'observer_id'     => auth()->id(),
			'observed_id'     => $rationale->observed_id,
			'course_year'     => $rationale->course_year,
			'observed_course' => $rationale->observed_course,
			'strength'        => $rationale->strength,
			'organization'    => $rationale->organization,
			'date'            => $rationale->date,
		] );

		if ( $new_observation ) {
			if ( $request->has( 'activities' ) ) {
				$this->update_activities( $request->input('activities' ), $request->input('responses'), $type, $new_observation );
			}
		}

		return redirect( route( 'observations' ) )->with( 'message', $this->_message( 'success', 'Observation submitted successfully' ) );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Observation $observation
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function show(Observation $observation)
    {
		return view('admin.v2.observations.show', compact('observation'));
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Observation $observation
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
    public function edit(Observation $observation)
    {
		$type = auth()->user()->hasRole('Mentor') ? 'Mentor Questionnaire' : 'Observation Questionnaire';
	    $questions = $this->getQuestions( $type );

	    return view('admin.v2.observations.edit', compact('observation', 'questions'));
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

		$type = auth()->user()->hasRole('Mentor') ? 'Mentor Questionnaire' : 'Observation Questionnaire';

		$observation->update( [
			'course_year'     => $request->input( 'year_group' ),
			'observed_course' => $request->input( 'course_title' ),
			'strength'        => $request->input( 'number_of_students' ),
			'organization'    => $request->input( 'organization' ),
			'date'            => $request->input( 'date' ),
		] );


		if ( $request->has( 'activities' ) ) {
			$observation->details()->delete();
			$this->update_activities( $request->input('activities' ), $request->input('responses'), $type, $observation );

		}

		return redirect( route( 'observations' ) )->with( 'message', $this->_message( 'success', 'Successfully updated observation' ) );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Observation $observation
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function destroy(Observation $observation)
    {
        $observation->details()->delete();
        $observation->delete();

	    return redirect( route( 'observations' ) )->with( 'message', $this->_message( 'success', 'Observation deleted successfully' ) );
    }


	/**
	 * @param $activities
	 * @param $responses
	 * @param $type
	 * @param $observation
	 *
	 * @return bool
	 */
	private function update_activities( $activities, $responses, $type, $observation ) {

		foreach ( $activities as $key => $activity ) {
			$response = '';

			if ( isset( $responses[ $key ] ) ) {
				$response = is_array( $responses[ $key ] ) ? implode( ',', $responses[ $key ] ) : $responses[ $key ];
			}

			$observation->details()->create( [
				'activity' => $activity,
				'step'     => $type,
				'response' => $response
			] );
		}

		return true;
	}
}
