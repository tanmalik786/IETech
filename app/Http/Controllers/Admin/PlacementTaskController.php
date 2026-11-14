<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\PlacementTask;
	use Illuminate\Http\Request;

	class PlacementTaskController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index() {

			$query = PlacementTask::query();

			$viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
			if( ! empty( $viewing_as ) ) {
				$query->where( 'user_id', $viewing_as->id );
			} else {
				if ( auth()->user()->hasRole( 'Teaching Student' ) ) {
					$query->where( 'user_id', auth()->id() );
				}
			}

			$placement_tasks = $query->orderBy('id', 'desc')->get();

			return view( 'admin.placement-tasks.index', compact('placement_tasks') );
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create() {
			return view( 'admin.placement-tasks.create' );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request  $request
		 * @param \App\Models\PlacementTask $placement_task
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store( Request $request, PlacementTask $placement_task ) {

			$newPlacementTask = $placement_task->create( [
				'student_needs' => $request->input( 'student_needs' ),
				'user_id' => auth()->id()
			] );

			if ( $newPlacementTask ) {
				if ( $request->has( 'focus' ) ) {
					for ( $i = 0; $i < count( $request->input( 'focus' ) ); $i ++ ) {
						$newPlacementTask->plannings()->create( [
							'focus' => $request->input( 'focus' )[ $i ],
							'notes' => $request->input( 'notes' )[ $i ],
						] );
					}
				}

				if ( $request->has( 'strategy' ) ) {
					for ( $i = 0; $i < count( $request->input( 'strategy' ) ); $i ++ ) {
						$newPlacementTask->differentials()->create( [
							'strategy' => $request->input( 'strategy' )[ $i ],
							'comments' => $request->input( 'comments' )[ $i ],
						] );
					}
				}

				if ( $request->has( 'key_skill' ) ) {
					for ( $i = 0; $i < count( $request->input( 'key_skill' ) ); $i ++ ) {
						$newPlacementTask->stems()->create( [
							'key_skill' => $request->input( 'key_skill' )[ $i ],
							'plan'      => $request->input( 'plan' )[ $i ],
						] );
					}
				}
			}

			return redirect( route( 'admin.placement-tasks' ) )->with( 'message', $this->_message( 'success', 'Successfully added placement task entry' ) );
		}

		/**
		 * Display the specified resource.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function show( PlacementTask $placement_task ) {
			return view('admin.placement-tasks.show', compact('placement_task'));
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit( PlacementTask $placement_task) {
			return view('admin.placement-tasks.edit', compact('placement_task'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param int                      $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request, PlacementTask $placement_task) {
			$placement_task->update([
				'student_needs' => $request->input('student_needs')
			]);

			if ( $request->has( 'focus' ) ) {
				$placement_task->plannings()->delete();
				for ( $i = 0; $i < count( $request->input( 'focus' ) ); $i ++ ) {
					$placement_task->plannings()->create( [
						'focus' => $request->input( 'focus' )[ $i ],
						'notes' => $request->input( 'notes' )[ $i ],
					] );
				}
			}

			if ( $request->has( 'strategy' ) ) {
				$placement_task->differentials()->delete();
				for ( $i = 0; $i < count( $request->input( 'strategy' ) ); $i ++ ) {
					$placement_task->differentials()->create( [
						'strategy' => $request->input( 'strategy' )[ $i ],
						'comments' => $request->input( 'comments' )[ $i ],
					] );
				}
			}

			if ( $request->has( 'key_skill' ) ) {
				$placement_task->stems()->delete();
				for ( $i = 0; $i < count( $request->input( 'key_skill' ) ); $i ++ ) {
					$placement_task->stems()->create( [
						'key_skill' => $request->input( 'key_skill' )[ $i ],
						'plan'      => $request->input( 'plan' )[ $i ],
					] );
				}
			}

			return redirect( route( 'admin.placement-tasks' ) )->with( 'message', $this->_message( 'success', 'Successfully updated placement task entry' ) );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param \App\Models\PlacementTask $placement_task
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
		 */
		public function destroy( PlacementTask $placement_task) {
			$placement_task->plannings()->delete();
			$placement_task->differentials()->delete();
			$placement_task->stems()->delete();
			$placement_task->delete();
			return redirect( route( 'admin.placement-tasks' ) )->with( 'message', $this->_message( 'success', 'Successfully deleted placement task entry' ) );
		}
	}
