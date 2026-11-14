<?php

	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use App\Models\Institute;
	use App\Providers\RouteServiceProvider;
	use App\Models\User;
	use Carbon\Carbon;
	use Illuminate\Foundation\Auth\RegistersUsers;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Validator;

	class RegisterController extends Controller {

		/*
		|--------------------------------------------------------------------------
		| Register Controller
		|--------------------------------------------------------------------------
		|
		| This controller handles the registration of new users as well as their
		| validation and creation. By default this controller uses a trait to
		| provide this functionality without requiring any additional code.
		|
		*/

		use RegistersUsers;

		/**
		 * Where to redirect users after registration.
		 *
		 * @var string
		 */
		protected $redirectTo = RouteServiceProvider::HOME;

		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct() {
			$this->middleware( 'guest' );
		}

		/**
		 * Get a validator for an incoming registration request.
		 *
		 * @param array $data
		 *
		 * @return \Illuminate\Contracts\Validation\Validator
		 */
		protected function validator( array $data ) {
			return Validator::make( $data, [
				'first_name'     => [ 'required', 'string', 'max:255' ],
				'last_name'      => [ 'required', 'string', 'max:255' ],
				'email'          => [
					'required',
					'string',
					'email',
					'max:255',
					'unique:users',
				],
				'password'       => [
					'required',
					'string',
					'min:8',
					'confirmed',
				],
				'institute_name' => [
					'required_if:type,institute',
					'string',
					'unique:institutes,name',
				],
			] );
		}

		/**
		 * Create a new user instance after a valid registration.
		 *
		 * @param array $data
		 *
		 * @return \App\Models\User
		 */
		protected function create( array $data ) {

			$institute_id = 0;
			$role = 'Subscriber';

			if( $data['type'] == 'institute' ) {
				$institute = Institute::create( [
					'name' => $data['institute_name'],
					'slug' => $this->slugify( $data['institute_name'] ),
				] );
				$institute_id = $institute->id;
				$role = 'Institute Admin';
			}


			$user = User::create( [
				'first_name'        => $data['first_name'],
				'last_name'         => $data['last_name'],
				'slug'              => $this->slugify( $data['first_name'], $data['last_name'] ),
				'institute_id'      => $institute_id,
				'email'             => $data['email'],
				'password'          => Hash::make( $data['password'] ),
				'email_verified_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
			] );

			$user->assignRole( $role );

			return $user;
		}
	}
