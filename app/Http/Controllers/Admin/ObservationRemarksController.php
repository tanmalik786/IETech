<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Observation;
use Illuminate\Http\Request;

class ObservationRemarksController extends Controller
{

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Observation  $observation
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(Request $request, Observation $observation) {
		$observation->remarks()->create([
			'remarks' => $request->input('remarks')
		]);
		return redirect(route('observations', ['observation_type' => $observation->type->name]))->with('message', $this->_message('success', 'Successfully added remarks'));
    }
}
