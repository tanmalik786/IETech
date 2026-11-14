<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reflection;
use Illuminate\Http\Request;

class ReflectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$query = Reflection::query();

	    $viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
	    if( ! empty( $viewing_as ) ) {
		    $query->where( 'user_id', $viewing_as->id );
	    } else {
		    if ( auth()->user()->hasRole( 'Link Tutor' ) ) {
			    $query->where( 'user_id', auth()
				    ->user()
				    ->linkTutorStudents()
				    ->pluck( 'id' )
				    ->toArray() );
		    }

		    if ( auth()->user()->hasRole( 'Mentor' ) ) {
			    $query->where( 'user_id', auth()
				    ->user()
				    ->students()
				    ->pluck( 'id' )
				    ->toArray() );
		    }

		    if ( auth()->user()->hasRole( 'Teaching Student' ) ) {
			    $query->where( 'user_id', auth()->id() );
		    }
	    }

		$reflections = $query->orderBy('created_at', 'desc')->get();

        return view('admin.reflections.index', compact('reflections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Reflection $reflection)
    {
        $reflection->create(array_merge($request->except('_token'), ['user_id' => auth()->id(), 'slug' => $this->slugify_page_title($request->input('title'), auth()->id())]));
		return redirect(route('reflections'))->with('message', $this->_message('success', 'Successfully added new reflection'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reflection $reflection)
	{
		return view('admin.reflections.show', compact('reflection'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reflection = Reflection::find($id);
		if( ! empty($reflection) ) {
			$reflection->update( $request->except('_token') );
		}

	    return redirect(route('reflections'))->with('message', $this->_message('success', 'Successfully updated reflection'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reflection = Reflection::find($id);
		$reflection->delete();
	    return redirect(route('reflections'))->with('message', $this->_message('success', 'Successfully deleted reflection'));
    }
}
