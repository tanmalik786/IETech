<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\ObservationType;
	use App\Models\ShadowForm;
	use Illuminate\Http\Request;

	class ShadowFormDetailsController extends Controller {

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\ShadowForm   $shadow_form
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function store( Request $request, ShadowForm $shadow_form ) {

			if ( $request->has( 'activities' ) ) {
				foreach ( $request->input( 'activities' ) as $key => $activity ) {

					$shadow_form->details()
					            ->where( 'activity', $activity )
					            ->where( 'step', $request->input( 'step' ) )
					            ->delete();

					$shadow_form->details()->create( [
						'activity' => $activity,
						'step'     => $request->input( 'step' ),
						'response' => $request->input( 'responses' )[ $key ],
					] );
				}
			}

			return response()->json( [
				'status' => 'success',
			] );
		}
	}
