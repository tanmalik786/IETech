<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\Observation;
	use App\Models\Post;
	use App\Models\Section;
	use App\Models\ShadowForm;
	use App\Models\Slider;
	use App\Models\User;
	use File;
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\Request;
	use Illuminate\View\View;

	class AjaxController extends Controller {

		public function getShadowForm( Request $request): View {
			$shadow_form = ShadowForm::find( $request->input( 'shadow_form_id' ) );
			$observation_type = 'shadow_form';
			$users = User::whereNotIn('id', [auth()->id()])->whereHas('roles', function($q) {
				$q->whereIn('name', ['Teaching Student', 'Mentor', 'Link Tutor']);
			})->where('institute_id', auth()->user()->institute_id)->get();

			return view( 'admin.common.observations.form', compact( 'shadow_form', 'observation_type', 'users' ) );
		}
		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function getMentorStudents( Request $request ) {
			$mentor   = User::find( $request->input( 'mentor_id' ) );
			$students = [];

			if ( ! empty( $mentor ) ) {
				$students = User::where(function($query) use ($request) {
									$query->where( 'mentor_id', $request->input( 'mentor_id' ) )
										->orWhere( 'mentor_id', '=', null );
								})
				                ->whereHas( 'roles', function ( $query ) {
					                $query->where( 'name', '=', 'Teaching Student' );
				                } )
				                ->where( 'institute_id', $mentor->institute_id )
				                ->get();
			}

			return view( 'admin.manage-mentors.partials.components.form', compact( 'students', 'mentor' ) );
		}


		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function getLinkTutorStudents( Request $request ) {
			$link_tutor   = User::find( $request->input( 'link_tutor_id' ) );
			$students = [];

			if ( ! empty( $link_tutor ) ) {
				$students = User::where(function($query) use ($request) {
									$query->where( 'link_tutor_id', $request->input( 'link_tutor_id' ) )
										->orWhere( 'link_tutor_id', null );
								})
				                ->whereHas( 'roles', function ( $query ) {
					                $query->where( 'name', 'Teaching Student' );
				                } )
				                ->where( 'institute_id', $link_tutor->institute_id )
				                ->get();
			}

			return view( 'admin.manage-link-tutors.partials.components.form-students', compact( 'students', 'link_tutor' ) );
		}


		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function getLinkTutorMentors( Request $request ) {
			$link_tutor   = User::find( $request->input( 'link_tutor_id' ) );
			$mentors = [];

			if ( ! empty( $link_tutor ) ) {
				$mentors = User::where(function($query) use ($request) {
									$query->where( 'link_tutor_id', $request->input( 'link_tutor_id' ) )
										->orWhere( 'link_tutor_id', null );
								})
				                ->whereHas( 'roles', function ( $query ) {
					                $query->where( 'name', 'Mentor' );
				                } )
				                ->where( 'institute_id', $link_tutor->institute_id )
				                ->get();
			}

			return view( 'admin.manage-link-tutors.partials.components.form', compact( 'mentors', 'link_tutor' ) );
		}

		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function updateSectionStatus( Request $request ) {

			$status     = $request->input( 'status' );
			$section_id = $request->input( 'section_id' );

			$section = Section::find( $section_id );
			$section->update( [
				'status' => $status,
			] );

			return response()->json( $section );
		}

		public function updateSectionOrder( Request $request ) {

			if ( $request->has( 'order' ) && count( $request->input( 'order' ) ) > 0 ) {
				foreach ( $request->input( 'order' ) as $order ) {
					Section::where( 'id', $order['id'] )
					       ->update( [ 'order' => $order['display_order'] ] );
				}
			}

			return response()->json( [
				'message' => 'Order updated successfully',
			] );
		}

		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
		 */
		public function getSectionForm( Request $request ) {

			$sliders         = Slider::where( 'type', 'slider' )->get();
			$carousels       = Slider::where( 'type', 'carousel' )->get();
			$section_type_id = $request->input( 'section_type_id' );

			return view( 'pages.partials.modals.section-form', compact( 'section_type_id', 'sliders', 'carousels', 'section_type_id' ) );
		}

		/**
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\Observation  $observation
		 *
		 * @return string
		 */
		public function fetchForm( Request $request, Observation $observation ) {
			$questions = $this->getQuestions( $request->input( 'key' ) );

			return view( 'admin.shadow-form.activities.form', compact( 'questions', 'observation' ) )->render();
		}

		/**
		 * @param \App\Http\Controllers\Admin\Post $post
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function getPostHoursLog( Post $post ) {
			return response()->json( $post->teachingLogs );
		}

		/**
		 * @param \Illuminate\Http\Request $request
		 * @param \App\Models\User         $user
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function updateProfileImage( Request $request, User $user ) {

			if ( ! $request->has( 'profile_image' ) ) {
				return response()->json( [
					"status"  => "411",
					"message" => "Image file not found",
				] );
			}

			$fileName = $request->file( 'profile_image' )->hashName();
			$request->profile_image->storeAs( 'public/media', $fileName );

			if ( $user->profileImage ) {
				$oldProfileImage = public_path( "storage/media/{$user->profileImage}" ); // get previous image from folder
				if ( File::exists( $oldProfileImage ) ) { // unlink or remove previous image from folder
					unlink( $oldProfileImage );
				}
			}


			$user->profileImage()->delete();

			$user->profileImage()->create( [
				'file_name' => $fileName,
			] );


			return response()->json( [
				"status"  => "200",
				"message" => "Successfully updated profile image",
			] );
		}
	}
