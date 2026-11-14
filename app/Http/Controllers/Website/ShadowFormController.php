<?php

	namespace App\Http\Controllers\Website;

	use App\Http\Controllers\Controller;
	use App\Models\Institute;
	use App\Models\ShadowForm;
	use App\Models\User;
	use Illuminate\Http\Request;

	class ShadowFormController extends Controller {

		public function index( Institute $institute, User $user ) {
			$data['observation'] = ShadowForm::with('details')->where('user_id', $user->id)->first();
			return view( 'page-shadow-form' )->with( [
				'institute' => $institute,
				'user'      => $user,
				'data' => $data
			] );
		}
	}
