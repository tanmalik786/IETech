<?php

	namespace App\Http\Controllers\SuperAdmin;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\SuperAdmin\Topics\StoreRequest;
	use App\Http\Requests\SuperAdmin\Topics\UpdateRequest;
	use App\Models\Topic;
	use Illuminate\Http\Request;

	class TopicController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
		 */
		public function index( Request $request ) {
			return view( 'admin.topics.index' )
				->with( 'topics', Topic::orderBy( 'updated_at' )
				                       ->where( 'parent_id', null )
				                       ->active()
				                       ->paginate( 30 ) )
				->with( 'parent_topics', Topic::get() );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \App\Http\Requests\SuperAdmin\Topics\StoreRequest $request
		 * @param \App\Models\Topic                                 $topic
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store( StoreRequest $request, Topic $topic ) {
			$topic->create( array_merge( $request->except( '_token' ), [ 'slug' => $request->input( 'title' ) ] ) );

			return redirect( route( 'superadmin.topics' ) )->with( 'message', $this->_message( 'success', 'Successfully added a new topic' ) );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \App\Http\Requests\SuperAdmin\Topics\UpdateRequest $request
		 * @param \App\Models\Topic                                  $topic
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update( UpdateRequest $request, Topic $topic ) {
			$topic->update( array_merge( $request->toArray(), [ 'slug' => $request->input( 'title' ) ] ) );

			return redirect( route( 'superadmin.topics' ) )->with( 'message', $this->_message( 'success', 'Topic updated successfully' ) );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param \App\Models\Topic $topic
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( Topic $topic ) {
			$topic->update( [
				'status' => 0 // deleted
			] );

			return redirect( route( 'superadmin.topics' ) )->with( 'message', $this->_message( 'success', 'Topic deleted successfully' ) );
		}
	}
