<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeachingLogsRequest;
use App\Models\Post;
use App\Models\TeachingLog;
use Illuminate\Http\Request;

class TeachingHoursLogController extends Controller
{
	private $type = 'logs';

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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

	    $posts = $query->where( 'type', 'logs' )
	                   ->orderBy( 'id', 'desc' )
	                   ->get();

        return view('admin.teach-hours-log.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
	    $months = ["January", "February", "March", "April", "May", "June",
		    "July", "August", "September", "October", "November", "December"
	    ];
        return view('admin.teach-hours-log.create', compact('months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(TeachingLogsRequest $request)
    {
        $newPost = auth()->user()->posts()->create(array_merge($request->except('logs', '_token'), ['type' => $this->type]));

		if( $request->has('logs') ) {
			foreach($request->input('logs') as $log ) {
				$newPost->teachingLogs()->create($log);
			}
		}

		return redirect(route('hourslog.index'))->with('message', $this->_message('success', 'Hours logged successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.teach-hours-log.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
	    $months = ["January", "February", "March", "April", "May", "June",
		    "July", "August", "September", "October", "November", "December"
	    ];
		return view('admin.teach-hours-log.edit', compact('post', 'months'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(TeachingLogsRequest $request, Post $post)
    {
		$post->update($request->except('_token', 'logs'));
	    if( $request->has('logs') ) {
			$post->teachingLogs()->delete();
		    foreach($request->input('logs') as $log ) {
			    $post->teachingLogs()->create($log);
		    }
	    }

	    return redirect(route('hourslog.index'))->with('message', $this->_message('success', 'Hours log updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        $post->teachingLogs()->delete();
		$post->delete();

		return redirect(route('hourslog.index'))->with('message', $this->_message('success', 'hours log deleted successfully'));
    }
}
