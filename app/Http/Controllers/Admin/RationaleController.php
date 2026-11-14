<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\RationaleRequest;
	use App\Models\Rationale;
	use App\Models\User;
	use Carbon\Carbon;
	use Illuminate\Http\Request;

	class RationaleController extends Controller {

		/**
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function index() {

			$query = Rationale::query();

			$viewing_as = session()->has('viewing') ? session()->get('viewing') : null;
			if( ! empty( $viewing_as ) ) {
				$query->where( 'user_id', $viewing_as->id );
			} else {
				if ( auth()->user()->hasRole( 'Teaching Student' ) ) {
					$query->where( 'user_id', auth()->id() );
				} else if ( auth()->user()->hasAnyRole( [
					'Mentor',
					'Link Tutor'
				] ) ) {
					$query->where( 'observer_id', auth()->id() );
				}
			}
			$rationales = $query->whereHas('observed')->orderBy( 'id', 'desc' )->get();

			return view( 'admin.rationale.index', compact( 'rationales' ) );

		}

		/**
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function create() {
			$observers = User::whereHas( 'roles', function ( $q ) {
				$q->whereIn( 'name', [ 'Link Tutor', 'Mentor' ] );
			} )->where('institute_id', auth()->user()->institute_id)
			                 ->get();

			return view( 'admin.rationale.create', compact( 'observers' ) );
		}

		/**
		 * @param \App\Http\Requests\Admin\RationaleRequest $request
		 * @param \App\Models\Rationale                     $rationale
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store( RationaleRequest $request, Rationale $rationale ) {

			$newRationale = $rationale->create( array_merge( [
				'user_id'     => auth()->id(),
				'observed_id' => auth()->id(),
				'date'        => Carbon::parse( $request->input( 'date' ) )
				                       ->format( 'Y-m-d' ),
			], $request->except( '_token', 'details', 'files', 'date' ) ) );

			if ( $request->has( 'details' ) && count( $request->input( 'details' ) ) > 0 ) {
				foreach ( $request->input( 'details' ) as $detail ) {
					$newRationale->details()->create( $detail );
				}
			}

			return redirect( route( 'rationale' ) )->with( 'message', $this->_message( 'success', 'Successfully added new rationale' ) );
		}

		/**
		 * @param \App\Models\Rationale $rationale
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function edit( Rationale $rationale ) {
			$observers = User::whereHas( 'roles', function ( $q ) {
				$q->whereIn( 'name', [ 'Link Tutor', 'Mentor' ] );
			} )->get();

			return view( 'admin.rationale.edit', compact( 'rationale', 'observers' ) );
		}

		/**
		 * @param \App\Http\Requests\Admin\RationaleRequest $request
		 * @param \App\Models\Rationale                     $rationale
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update( RationaleRequest $request, Rationale $rationale ) {
			$rationale->update( array_merge( $request->except( '_token', 'details', 'files', 'date' ), [
				'date' => Carbon::parse( $request->input( 'date' ) )
				                ->format( 'Y-m-d' ),
			] ) );

			if ( $request->has( 'details' ) && count( $request->input( 'details' ) ) > 0 ) {
				$rationale->details()->delete();
				foreach ( $request->input( 'details' ) as $detail ) {
					$rationale->details()->create( $detail );
				}
			}

			return redirect( route( 'rationale' ) )->with( 'message', $this->_message( 'success', 'Successfully updated rationale' ) );
		}

		/**
		 * @param \App\Models\Rationale $rationale
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function destroy( Rationale $rationale ) {
			$rationale->details()->delete();
			$rationale->delete();
			return redirect( route( 'rationale' ) )->with( 'message', $this->_message( 'success', 'Successfully deleted rationale' ) );
		}
	}
