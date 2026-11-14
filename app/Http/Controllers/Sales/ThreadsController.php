<?php

	namespace App\Http\Controllers\Sales;

	use App\Http\Controllers\Controller;
	use App\Models\Thread;
	use App\Models\Topic;
	use App\Models\User;
	use Illuminate\Console\View\Components\Alert;
	use Illuminate\Http\Request;

	class ThreadsController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index() {
			//
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create() {
			//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \App\Models\Topic        $topic
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store( Topic $topic, Request $request ) {
			$topic->threads()
			      ->create( array_merge( $request->toArray(), [ 'status'  => 1,
			                                                    'user_id' => User::first()->id,
			                                                    'slug'    => $request->input( 'title' ),
				      ] ) );

			return redirect( route( 'forum.show', [ 'topic' => $topic->slug ] ) )->with( 'message', $this->_message( 'success', 'New Thread created successfully' ) );
		}

		/**
		 * Display the specified resource.
		 *
		 * @param \App\Models\Thread $thread
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
		 */
		public function show( Thread $thread ) {
			return view( 'sales.forum.threads.show' )->with( [
				'thread' => $thread,
			] );
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit( $id ) {
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param int                      $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request, $id ) {
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $id ) {
			//
		}
	}
