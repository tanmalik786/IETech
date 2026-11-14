<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageLinkTutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
	    $query = User::query();
	    $users = $query->whereHas( 'roles', function ( $query ) {
		    $query->where( 'name', '=', 'Link Tutor' );
	    } )
	                   ->where( 'institute_id', auth()->user()->institute_id )
	                   ->orderBy( 'id', 'desc' )
	                   ->paginate( 30 );

	    return view( 'admin.manage-link-tutors.index', compact( 'users' ) );
    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\User         $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update( Request $request, User $user ) {

		foreach($user->mentors as $mentor) {
			$mentor->update([
				'link_tutor_id' => null
			]);
		}


		if ( $request->has( 'mentors' ) && count( $request->input( 'mentors' ) ) > 0 ) {
			foreach ( $request->input( 'mentors' ) as $mentor_id ) {

				User::where( 'id', $mentor_id )->update( [
					'link_tutor_id' => $user->id,
				] );

				User::where('mentor_id', $mentor_id)->update([
					'link_tutor_id' => $user->id
				]);

			}
		}

		return redirect( route( 'manage.link-tutors' ) )->with( 'message', $this->_message( 'success', 'Successfully updated mentors' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\User         $mentor
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function updateStudents( Request $request, User $user ) {


		foreach($user->linkTutorStudents as $student) {
			$student->update([
				'link_tutor_id' => null
			]);
		}

		if ( $request->has( 'students' ) && count( $request->input( 'students' ) ) > 0 ) {
			foreach ( $request->input( 'students' ) as $std_id ) {
				User::where( 'id', $std_id )->update( [
					'link_tutor_id' => $user->id,
				] );
			}
		}

		return redirect( route( 'manage.link-tutors' ) )->with( 'message', $this->_message( 'success', 'Successfully updated students' ) );
	}

}
