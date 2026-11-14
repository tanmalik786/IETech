<?php

	namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\ObservationActivityStoreRequest;
	use App\Models\Observation;
	use App\Models\ObservationType;
	use App\Models\ShadowForm;
	use App\Models\User;
	use Illuminate\Http\Request;

	class ShadowFormController extends Controller {

		public function index( Request $request ) {

			$query = ShadowForm::query();

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

			$observations = $query->get();

			$users = User::whereNotIn('id', [auth()->id()])->whereHas('roles', function($q) {
				$q->whereIn('name', ['Teaching Student', 'Mentor', 'Link Tutor']);
			})->where('institute_id', auth()->user()->institute_id)->get();

			return view('admin.shadow-form.index', compact('observations', 'users'));
		}

		public function show(Request $request, ShadowForm $shadow_form) {
			return view('admin.shadow-form.show', compact('shadow_form'));
		}

		public function create( Request $request, ShadowForm $shadow_form ) {
			$observation_mapping = [
				[
					'display_name' => 'TEACHER-LECTURE STAGE (BEGINNING)',
					'step'         => 'TEACHER-BEGIN',
					'questions'    => $this->getQuestions( 'TEACHER-BEGIN' ),
				],
				[
					'display_name' => 'Student-Lecture Stage (Beginning)',
					'step'         => 'STD-BEGIN',
					'questions'    => $this->getQuestions( 'STD-BEGIN' ),
				],
				[
					'display_name' => 'Teacher-Lecture Stage (Middle)',
					'step'         => 'TEACHER-MID',
					'questions'    => $this->getQuestions( 'TEACHER-MID' ),
				],
				[
					'display_name' => 'Student-Lecture Stage (Middle)',
					'step'         => 'STD-MID',
					'questions'    => $this->getQuestions( 'STD-MID' ),
				],
				[
					'display_name' => 'Teacher-Lecture Stage (End)',
					'step'         => 'TEACHER-CONCL',
					'questions'    => $this->getQuestions( 'TEACHER-CONCL' ),
				],
				[
					'display_name' => 'Student-Lecture Stage (End)',
					'step'         => 'STD-CONCL',
					'questions'    => $this->getQuestions( 'STD-CONCL' ),
				],
			];


			return view( 'admin.shadow-form.create', compact( 'observation_mapping', 'shadow_form' ) );
		}

		public function edit(ShadowForm $shadow_form) {
			$observation_mapping = [
				[
					'display_name' => 'TEACHER-LECTURE STAGE (BEGINNING)',
					'step'         => 'TEACHER-BEGIN',
					'questions'    => $this->getQuestions( 'TEACHER-BEGIN' ),
				],
				[
					'display_name' => 'Student-Lecture Stage (Beginning)',
					'step'         => 'STD-BEGIN',
					'questions'    => $this->getQuestions( 'STD-BEGIN' ),
				],
				[
					'display_name' => 'Teacher-Lecture Stage (Middle)',
					'step'         => 'TEACHER-MID',
					'questions'    => $this->getQuestions( 'TEACHER-MID' ),
				],
				[
					'display_name' => 'Student-Lecture Stage (Middle)',
					'step'         => 'STD-MID',
					'questions'    => $this->getQuestions( 'STD-MID' ),
				],
				[
					'display_name' => 'Teacher-Lecture Stage (End)',
					'step'         => 'TEACHER-CONCL',
					'questions'    => $this->getQuestions( 'TEACHER-CONCL' ),
				],
				[
					'display_name' => 'Student-Lecture Stage (End)',
					'step'         => 'STD-CONCL',
					'questions'    => $this->getQuestions( 'STD-CONCL' ),
				],
			];
			return view( 'admin.shadow-form.edit', compact( 'observation_mapping', 'shadow_form' ) );
		}

		public function store( ObservationActivityStoreRequest $request, ShadowForm $shadow_form ) {
			$new_shadow_form = $shadow_form->create(array_merge($request->except('_token'), ['user_id' => auth()->id()]));
			return redirect(route('admin.shadow-forms.create', ['shadow_form' => $new_shadow_form->id]));
		}

		public function destroy(ShadowForm $shadow_form) {
			$shadow_form->details()->delete();
			$shadow_form->delete();
			return redirect(route('admin.shadow-forms'))->with('message', $this->_message('success', 'Shadow form deleted successfully'));
		}
	}
