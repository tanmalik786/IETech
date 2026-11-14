<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\Post;
	use App\Models\User;
	use Illuminate\Http\Request;

	class MinimumCoreController extends Controller {

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
		 */
		public function index() {

			$query = Post::query();
			$query->where( 'type', 'minimum_core' );

			$viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
			if( ! empty( $viewing_as ) ) {
				$query->where( 'user_id', $viewing_as->id );
			} else {
				if ( auth()->user()->hasRole( 'Teaching Student' ) ) {
					$query->where( 'user_id', auth()->id() );
				} else if ( auth()->user()->hasRole( 'Mentor' ) ) {
					$query->whereIn( 'user_id', auth()
						->user()
						->students()
						->pluck( 'id' )
						->toArray() );
				} else if ( auth()->user()->hasRole( 'Link Tutor' ) ) {
					$student_ids = User::where( 'institute_id', auth()->user()->institute_id )
					                   ->whereHas( 'roles', function ( $query ) {
						                   $query->where( 'name', '=', 'Teaching Student' );
					                   } )
					                   ->whereIn( 'mentor_id', auth()
						                   ->user()
						                   ->mentors()
						                   ->pluck( 'id' )
						                   ->toArray() )
					                   ->pluck( 'id' )
					                   ->toArray();
					$query->whereIn( 'user_id', $student_ids );
				}
			}
			$cores = $query->orderBy('id', 'desc')->get();

			return view( 'admin.minimum-core.index', compact( 'cores' ) );
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\Post         $post
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store( Request $request, Post $post ) {


			$post->create( array_merge( $request->except( '_token', 'content' ), [
				'user_id' => auth()->id(),
				'type'    => 'minimum_core',
				'content' => $request->input('content')
			] ) );

			return redirect( route( 'minimum-core' ) )->with( 'message', $this->_message( 'success', 'Successfully added item to minimum core' ) );
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

			if ($request->has('comments') ) {
				$post->postMetas()->where('meta_key', "comments_".auth()->id())->delete();
				$post->postMetas()->create( [
					'meta_key'   => "comments_".auth()->id(),
					'meta_value' => $request->input('comments'),
				] );
			} else {
				$post->update( array_merge($request->except( '_token', 'content' ), [
					'type' => 'minimum_core',
					'content' => $request->input('content')
				]) );
			}


			return redirect( route( 'minimum-core' ) )->with( 'message', $this->_message( 'success', 'Item updated successfully' ) );
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param \App\Models\Post $post
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function destroy( Post $post ) {
			$post->postMetas()->delete();
			$post->delete();

			return redirect( route( 'minimum-core' ) )->with( 'message', $this->_message( 'success', 'Successfully deleted item' ) );
		}


		/**
		 * @param $html
		 *
		 * @return string
		 */
		private function parseContentClean( $html ) {

			$allowed_tags = array('ul', 'ol', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'pre', 'code', 'strong', 'span', 'a');

			// Create a new DOMDocument object
			$dom = new \DOMDocument();

			// Load the HTML into the DOMDocument
			$dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

			// Get all the tags in the DOMDocument
			$tags = $dom->getElementsByTagName('*');

			// Loop through all the tags
			foreach ($tags as $tag) {
				// Check if the tag is not in the allowed list
				if (!in_array($tag->tagName, $allowed_tags)) {
					// Remove the tag and its contents from the DOMDocument
					$tag->parentNode->removeChild($tag);
				}
			}

			// Get the HTML of the cleaned DOMDocument
			$cleaned_html = $dom->saveHTML();

			return trim($cleaned_html);

		}
	}
