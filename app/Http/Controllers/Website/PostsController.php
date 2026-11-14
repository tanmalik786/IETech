<?php

	namespace App\Http\Controllers\Website;

	use App\Http\Controllers\Controller;
	use App\Models\Institute;
	use App\Models\Post;
	use App\Models\PostSlug;
	use App\Models\User;
	use Illuminate\Http\Request;

	class PostsController extends Controller {


		public function index( Institute $institute, User $user ) {
			return view( 'website.blog-posts.index' )->with( [
				'posts'     => Post::where( 'type', 'blog_posts' )
				                   ->where( 'user_id', $user->id )
				                   ->orderBy( 'id', 'desc' )
				                   ->paginate( 20 ),
				'institute' => $institute,
				'user'      => $user,
			] );
		}

		public function instituteIndex( Institute $institute ) {
			return view( 'website.blog-posts.index' )->with( [
				'posts'     => Post::where( 'type', 'blog_posts' )
				                   ->whereHas( 'user', function ( $query ) use ( $institute ) {
					                   $query->where( 'institute_id', $institute->id );
				                   } )
				                   ->orderBy( 'id', 'desc' )
				                   ->paginate( 20 ),
				'institute' => $institute,
			] );
		}

		public function show( Institute $institute, User $user, PostSlug $post_slug ) {
			return view( 'website.blog-posts.show' )->with( [
				'post'      => $post_slug->post,
				'institute' => $institute,
				'user'      => $user,
			] );
		}
	}
