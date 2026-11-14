<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

	public function index() {

		// TOOD: give visiblity to relevent users only
		// mentor can see the students which are linked to him
		// link tutor can see all
		$query = User::query();
		$roleQuery = Role::query();

		if( auth()->user()->hasAnyRole(['Institute Admin'])) {
			$query->where('institute_id', auth()->user()->institute_id);
			$roleQuery->whereNotIn('name', ['Institute Admin', 'Super Admin']);
		}

		$users = $query->orderBy('id', 'desc')->paginate(10);
		$roles = $roleQuery->get();

		return view('admin.users.index', compact('users', 'roles'));
    }

	public function store(Request $request, User $user) {

		$newUser = $user->create(
			array_merge(
				$request->except('_token', 'role'),
				[
					'institute_id' => auth()->user()->institute_id,
					'password' => bcrypt('secret'),
					'email_verified_at' => Carbon::now()->format('Y-m-d'),
					'slug' => $this->slugify( $request->first_name, $request->last_name )
				]
			)
		);

		if( $newUser ) {
			$newUser->assignRole($request->input('role'));
		}

		return redirect(route('users'))->with('message', $this->_message('success', 'Successfully added new User'));
	}

	public function update( Request $request, User $user) {

		$user->update(array_merge($request->except('_token', 'role'), ['slug' => $this->slugify( $request->first_name, $request->last_name )]));
		$user->syncRoles($request->input('role'));

		return redirect(route('users'))->with('message', $this->_message('success', 'Successfully update the User'));
	}

	public function destroy(User $user) {
	}
}
