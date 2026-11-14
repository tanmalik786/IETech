<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\Topic;
use Illuminate\Http\Request;

class ForumController extends Controller
{

	public function index(Request $request) {

		$data = [];
		$data['search'] = $request->input('search') ?? '';

		$query = Topic::query();

		if ( ! empty($data['search']) ) {
			$query->where('title', 'like', '%' . $data['search'] . '%');
		}

		return view('sales.forum.index')
			->with('topics', $query->orderBy('id', 'desc')->parent()->active()->paginate(30))
			->with('data', $data);
    }

	public function show(Topic $topic, Request $request) {

		$data = [];
		$data['search'] = $request->input('search') ?? '';
		$data['tag'] = $request->input('tag') ?? '';

		$query = Thread::query();

		$query->where('topic_id', $topic->id);

		if ( ! empty($data['search']) ) {
			$query->where('title', 'like', '%' . $data['search'] . '%');
		}

		if( ! empty($data['tag']) ) {
			$query->where('tags', 'like', '%' . $data['tag']. '%');
		}

		if ( ! empty($data['tags']) ) {
			$query->where('title', 'like', '%' . $data['tag'] . '%');
		}

		return view('sales.forum.show')
			->with('topic', $topic)
			->with('threads', $query->orderBy('updated_at', 'desc')->paginate(20))
			->with('tags', array_unique(Thread::where('topic_id', $topic->id)->pluck('tags')->toArray()))
			->with('data', $data);
	}
}
