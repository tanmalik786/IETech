<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\ActionPlan;
	use Illuminate\Http\Request;
	use Illuminate\Notifications\Action;

	class ActionPlanController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
		 */
		public function index() {
			$query = ActionPlan::query();
			$viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
			if( ! empty( $viewing_as ) ) {
				$query->where( 'user_id', $viewing_as->id );
			} else {
				if ( auth()->user()->hasRole( 'Link Tutor' ) ) {
					$query->where( 'user_id', auth()
						->user()
						->linkTutorStudents()
						->pluck( 'id' )
						->toArray() );
				}

				if ( auth()->user()->hasRole( 'Mentor' ) ) {
					$query->where( 'user_id', auth()
						->user()
						->students()
						->pluck( 'id' )
						->toArray() );
				}

				if ( auth()->user()->hasRole( 'Teaching Student' ) ) {
					$query->where( 'user_id', auth()->id() );
				}
			}

			$action_plans = $query->orderBy( 'id', 'desc' )->get();

			return view( 'admin.action-plans.index', compact( 'action_plans' ) );
		}

		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function create( Request $request ) {
			return view( 'admin.action-plans.create' );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\ActionPlan   $action_plan
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store( Request $request, ActionPlan $action_plan ) {
			$action_plan->create( array_merge( $request->except( '_token' ), [
				'created_by' => auth()->id(),
			] ) );

			return redirect( route( 'action-plans' ) )->with( 'message', $this->_message( 'success', 'Successfully added new action plan' ) );
		}

		/**
		 * @param \App\Models\ActionPlan $action_plan
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function edit(ActionPlan $action_plan) {
			return view('admin.action-plans.edit', compact('action_plan'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\ActionPlan   $action_plan
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update( Request $request, ActionPlan $action_plan) {
			$action_plan->update( array_merge($request->except('_token', 'user_id', 'files'), ['created_by', auth()->id()]) );
			return redirect( route( 'action-plans' ) )->with( 'message', $this->_message( 'success', 'Successfully updated action plan' ) );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param \App\Models\ActionPlan $action_plan
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function destroy( ActionPlan $action_plan ) {
			$action_plan->delete();
			return redirect( route( 'action-plans' ) )->with( 'message', $this->_message( 'success', 'Successfully deleted action plan' ) );
		}
	}
