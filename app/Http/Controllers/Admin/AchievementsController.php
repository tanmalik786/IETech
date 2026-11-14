<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\Post;
	use Illuminate\Http\Request;

	class AchievementsController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index() {

			$query = Post::query();
			$viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
			if( ! empty( $viewing_as ) ) {
				$query->where( 'user_id', $viewing_as->id );
			} else {
				if ( auth()->user()->hasRole( 'Teaching Student' ) ) {
					$query->where( 'user_id', auth()->id() );
				}

				if ( auth()->user()->hasRole( 'Mentor' ) ) {
					$query->whereIn( 'user_id', auth()
						->user()
						->students()
						->pluck( 'id' )
						->toArray() );
				}

				if ( auth()->user()->hasRole( 'Link Tutor' ) ) {
					$query->whereIn( 'user_id', auth()
						->user()
						->linkTutorStudents()
						->pluck( 'id' )
						->toArray() );
				}
			}


			$achievements = $query->where( 'type', 'achievements' )
			                    ->orderBy( 'id', 'desc' )
			                    ->get();

			return view( 'admin.achievements.index', compact( 'achievements' ) );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\Post         $post
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
		 */
		public function store( Request $request, Post $post ) {
			$newPost = $post->create( [
				'title'    => $request->input( 'title' ),
				'content'  => $request->input( 'content' ),
				'type'     => 'achievements',
				'category' => $request->input( 'category' ),
				'user_id'  => auth()->id(),
			] );

			if ( $newPost && $request->has( 'metas' ) ) {
				foreach ( $request->input( 'metas' ) as $meta ) {
					$newPost->postMetas()->create( [
						'meta_key'   => $meta['meta_key'],
						'meta_value' => $meta['meta_value'] ?? null,
					] );
				}
			}

			return redirect( route( 'achievements' ) )->with( 'message', $this->_message( 'success', 'Item added successfully' ) );
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\Post         $post
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update( Request $request, Post $post ) {
			$post->update( [
				'title'    => $request->input( 'title' ),
				'content'  => $request->input( 'content' ),
				'category' => $request->input( 'category' ),
			] );

			if ( $request->has( 'metas' ) ) {

				$post->postMetas()->delete();

				foreach ( $request->input( 'metas' ) as $meta ) {
					$post->postMetas()->create( [
						'meta_key'   => $meta['meta_key'],
						'meta_value' => $meta['meta_value'] ?? null,
					] );
				}
			}

			return redirect( route( 'achievements' ) )->with( 'message', $this->_message( 'success', 'Item updated successfully' ) );
		}

		public function show(Post $post ) {
			return view( 'admin.achievements.show', compact( 'post' ) );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( Post $post ) {
			$post->postMetas()->delete();
			$post->delete();

			return redirect( route( 'achievements' ) )->with( 'message', $this->_message( 'success', 'Item deleted successfully' ) );
		}
	}
