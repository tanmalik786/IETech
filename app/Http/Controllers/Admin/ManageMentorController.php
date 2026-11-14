<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\User;
	use Illuminate\Http\Request;
	use Spatie\Permission\Models\Role;

	class ManageMentorController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
		 */
		public function index() {
			$query = User::query();
			$users = $query->whereHas( 'roles', function ( $query ) {
					$query->where( 'name', '=', 'Mentor' );
				} )
			               ->where( 'institute_id', auth()->user()->institute_id )
			               ->orderBy( 'id', 'desc' )
			               ->paginate( 30 );

			return view( 'admin.manage-mentors.index', compact( 'users' ) );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\User         $mentor
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update( Request $request, User $user ) {



			foreach($user->students as $student) {
				$student->update([
					'mentor_id' => null
				]);
			}

			if ( $request->has( 'students' ) && count( $request->input( 'students' ) ) > 0 ) {
				foreach ( $request->input( 'students' ) as $std_id ) {

					User::where( 'id','=',$std_id )->update( [
						'mentor_id' => $user->id,
						'link_tutor_id' => $user->link_tutor_id
					] );

				}
			}

			return redirect( route( 'manage.mentors' ) )->with( 'message', $this->_message( 'success', 'Successfully updated students' ) );
		}
	}
