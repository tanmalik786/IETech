<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ObservationStoreRequest;
use App\Models\Observation;
use App\Models\ObservationStep;
use App\Models\ObservationType;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request, ObservationType $observation_type)
    {
		$observations = Observation::mine()->where('observation_type_id', $observation_type->id)->orderBy('id', 'desc')->get();
        return view('admin.observations.index', compact('observations', 'observation_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request, ObservationType $observation_type)
    {
		return view('admin.observations.create', compact('observation_type'));
    }

	public function show(Request $request, ObservationType $observation_type, Observation $observation) {
		$observationSteps = ObservationStep::where('user_id', auth()->id())->orderBy('id', 'asc')->get();
		$observation->load([
			'remarks' => function($query) {
				$query->orderBy('id', 'desc');
			}
		]);
		return view('admin.observations.show', compact('observation', 'observationSteps', 'observation_type'));
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ObservationStoreRequest $request, ObservationType $observation_type)
    {
		$newObservation = auth()->user()->observations()->create( array_merge($request->except('_token'), ['observation_type_id' => $observation_type->id]) );


	    $route = route('admin.shadow-form.create', ['observation' => $newObservation->id]);

		switch ($observation_type->name) {
			case 'expert':
				$route = route('expert.activity.create', ['observation' => $newObservation->id]);
			break;
			case 'general':
				$route = route('general.activity.create', ['observation' => $newObservation->id]);
			break;
		}

        return redirect($route)->with('message', $this->_message('success', 'Successfully added the observation, Please continue and create activities for this observation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return string
     */
    public function edit(Observation $observation, ObservationType $observation_type)
    {
		return view('admin.common.observations.form', compact('observation', 'observation_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(ObservationStoreRequest $request, ObservationType $observation_type, Observation $observation)
    {
		$observation->update($request->except('_token'));
        return redirect(route('observations', ['observation_type' => $observation_type->slug]))->with('message', $this->_message('success', 'Successfully updated observation'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Observation $observation
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
	 */
    public function destroy(Observation $observation, ObservationType $observation_type)
    {
        $observation->details()->delete();
		$observation->delete();

	    return redirect(route('observations', ['observation_type' => $observation_type->slug]))->with('message', $this->_message('success', 'Successfully deleted observation'));
    }
}
