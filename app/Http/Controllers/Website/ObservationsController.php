<?php

	namespace App\Http\Controllers\Website;

	use App\Http\Controllers\Controller;
	use App\Models\ExpertObservation;
	use App\Models\Institute;
	use App\Models\Observation;
	use App\Models\ObservationType;
	use App\Models\User;
	use Illuminate\Http\Request;

	class ObservationsController extends Controller {

		public function index( Institute $institute, User $user, $type ) {


			$data          = [];
			$data['title'] = 'Expert Observation';
			$data['type']  = $type;



			if( $type != 'Expert' ) {
				$query = Observation::query();
				$query->whereHas( 'observer', function ( $query ) use ( $type ) {
					$query->whereHas( 'roles', function ( $query ) use ( $type ) {
						$query->where( 'name', $type );
					} );
				} );
				$data['observations'] = $query->get();
				$data['title'] = "{$type} Observation";

			} else {
				$query = ExpertObservation::query();
				$query->whereHas( 'observer', function ( $query ) {
					$query->whereHas( 'roles', function ( $query ) {
						$query->where( 'name', 'Teaching Student' );
					} );
				} );
				$data['observations'] = $query->get();
			}




			return view( 'page-observations', compact( 'data', 'user', 'institute' ) );
		}

		public function show( Institute $institute, User $user, $id, $type ) {
			$data = [];


			if( $type == 'Expert' ) {
				$data['title'] = "{$type} Observation";

				$data['observation'] = ExpertObservation::where( 'observer_id', $user->id )
				                                  ->where( 'id', $id )
				                                  ->first();

			} else {
				$data['title'] = "{$type} Observation";

				$data['observation'] = Observation::where( 'observed_id', $user->id )
				                                  ->where( 'id', $id )
				                                  ->first();
			}

			return view( 'page-observation', compact( 'data', 'user', 'institute' ) );
		}
	}
