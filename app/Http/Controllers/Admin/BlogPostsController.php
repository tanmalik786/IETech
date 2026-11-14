<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\Post;
	use Illuminate\Http\Request;
	use File;
	class BlogPostsController extends Controller {

		public function index( Request $request ) {
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

			$posts = $query->where( 'type', 'blog_posts' )
			               ->orderBy( 'id', 'desc' )
			               ->paginate( 20 );

			return view( 'admin.blog-posts.index' )->with( [
				'posts' => $posts
			] );
		}

		public function create() {
			return view( 'admin.blog-posts.create' );
		}

		public function edit(Post $post) {
			return view( 'admin.blog-posts.edit' )->with(['post' => $post]);
		}

		public function store( Post $post, Request $request ) {

			$request->validate( [
				'title'   => 'required',
				'content' => 'required',
				'excerpt' => 'required|max:150',
				'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:4068'
				// Assuming 'body' is a 'text' or 'longtext' column
			] );

			$newPost = $post->create( [
				'title'   => $request->input( 'title' ),
				'content' => $request->input( 'content' ),
				'excerpt' => $request->input( 'excerpt' ),
				'type'    => 'blog_posts',
				'user_id' => auth()->id(),
			] );

			$newPost->slug()->create([
				'slug' => $newPost->title
			]);

			if( $request->has('featured_image') ) {

				// storing new image
				$fileName = $request->file('featured_image')->hashName();

				$request->file('featured_image')
				        ->storeAs('blog-posts/featured-image/', $fileName, 'public');

				$newPost->featuredImage()->create([
					'file_name' => $fileName
				]);

			}

			return redirect( route( 'admin.blog-posts' ) )->with( 'message', $this->_message( 'success', 'Post added successfully' ) );

		}

		public function update(Post $post, Request $request) {

			$request->validate( [
				'title'   => 'required',
				'content' => 'required',
				'excerpt' => 'required',
				'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:4068'
				// Assuming 'body' is a 'text' or 'longtext' column
			] );

			$post->update( [
				'title'   => $request->input( 'title' ),
				'content' => $request->input( 'content' ),
				'excerpt' => $request->input( 'excerpt' ),
			] );

			$post->slug()->delete();
			$post->slug()->create([
				'slug' => $request->input('title')
			]);

			if( $request->has('featured_image') ) {

				// deleting old image
				if( $post->featuredImage ) {
					$oldFeaturedImage = public_path("storage/blog-posts/featured-image/{$post->featuredImage->file_name}"); // get previous image from folder
					if (File::exists($oldFeaturedImage)) { // unlink or remove previous image from folder
						unlink($oldFeaturedImage);
					}
				}
				$post->featuredImage()->delete();

				// storing new image
				$fileName = $request->file('featured_image')->hashName();

				$request->file('featured_image')
				        ->storeAs('blog-posts/featured-image/', $fileName, 'public');

				$post->featuredImage()->create([
					'file_name' => $fileName
				]);

			}

			return redirect( route( 'admin.blog-posts' ) )->with( 'message', $this->_message( 'success', 'Post updated successfully' ) );

		}

		public function destroy(Post  $post) {

			// deleting old image
			if( $post->featuredImage ) {
				$oldFeaturedImage = public_path("storage/blog-posts/featured-image/{$post->featuredImage->file_name}"); // get previous image from folder
				if (File::exists($oldFeaturedImage)) { // unlink or remove previous image from folder
					unlink($oldFeaturedImage);
				}
			}

			$post->featuredImage()->delete();
			$post->slug()->delete();
			$post->delete();

			return redirect( route( 'admin.blog-posts' ) )->with( 'message', $this->_message( 'success', 'Post deleted successfully' ) );
		}
	}
