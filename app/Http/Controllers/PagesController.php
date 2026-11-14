<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagesStoreRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{

	public function index() {

		$query = Page::query();

		if( auth()->user()->hasRole('Teaching Student') ) {
			$query->where('user_id', auth()->id());
		}

		$query->where( 'institute_id', auth()->user()->institute_id );

		$pages = $query->orderBy('id', 'desc')->get();


		return view('pages.index', compact('pages'));
    }

    public function create(Request $request)
    {
        return view('pages.create');
    }

    public function store(PagesStoreRequest $request, Page $page)
    {

        $page->create(array_merge($request->except('featured_image'), [
            'slug' => $this->slugify_page_title( $request->input('title') ),
			'status' => $request->input('status') == 'draft' ?  0 : 1,
			'institute_id' => auth()->user()->institute_id,
            'user_id' => auth()->id()
        ]));

        return redirect(route('pages'))->with('message', $this->_message('success', 'Page created successfully'));
    }

	public function update( PagesStoreRequest $request, $id ) {

		$page = Page::find($id);

		if( ! empty($page) ) {
			$page->update([
				'status' => $request->input('status') == 'draft' ?  0 : 1,
				'title' => $request->input('title'),
				'slug' => $this->slugify_page_title( $request->input('title'), auth()->id() )
			]);
		}

		return redirect(route('pages'))->with('message', $this->_message('success', 'Page updated successfully'));
	}

	public function edit(Request $request, Page $page) {
		return view('pages.edit', compact('page'));
	}

	public function destroy( Page $page) {
		$page->delete();
		return redirect(route('pages'))->with('message', $this->_message('success', 'Page delete successfully'));
	}
}
