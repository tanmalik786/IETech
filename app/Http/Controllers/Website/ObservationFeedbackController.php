<?php

	namespace App\Http\Controllers\Website;

	use App\Http\Controllers\Controller;
	use App\Models\ExpertObservation;
	use App\Models\Institute;
	use App\Models\ObservationDetail;
	use App\Models\Observation;
	use App\Models\Review;
	use App\Models\ReviewFeedback;
	use App\Models\User;
	use Illuminate\Http\Request;

	class ObservationFeedbackController extends Controller {

		private $feedback_questions = [
			'Examiner/Link tutor feedback [Comments]',
			'Summary of strengths',
			'How has the trainee planned effectively to deliver the subject specialism?',
			'How effective are the resources in supporting learning in the subject?',
			'Describe the range, and quality, of teaching techniques used in the subject and how the trainee established a purposeful and motivating environment',
			'How did the trainee work creatively to overcome individual barriers?',
			'How did they develop the Maths/ English/Employability/Digital skills and address learner needs in these areas?',
			'How did the trainee use formative assessment to check all learners’ progress and was this assessment accessible?',
			'How did the trainee use questioning and student feedback to effectively support learning?',
			'How did the trainee use questioning and student feedback to effectively support learning?',
			'Summary of areas for development:',
			'Summary of professional knowledge and understanding',
			'Summary of Planning',
			'Summary of Delivery',
			'Summary of Assessment'
		];

		private $expert_feedback_questions = [
			'Planning (including clarity of learning outcomes)',
			'Subject Specific (effectiveness and relevance of resources and teaching strategies)',
			'a) The best things from this session',
			'b) Aspects of the session that could be improved',
		];

		public function index( Institute $institute, Request $request, User $user ) {

			$observations = Observation::where( 'observed_id', $user->id )
			                           ->with( 'details', function ( $query ) {
				                           $query->whereIn( 'activity', $this->feedback_questions );
			                           } )
			                           ->whereHas( 'details', function ( $query ) {
				                           $query->whereIn( 'activity', $this->feedback_questions )
				                                 ->where( 'response', '!=', '' );
			                           } )
			                           ->get();

			$expert_observations = ExpertObservation::where('observer_id', $user->id)
			                                         ->with( 'details', function ( $query ) {
				                                         $query->whereIn( 'activity', $this->expert_feedback_questions );
			                                         } )
			                                         ->whereHas( 'details', function ( $query ) {
				                                         $query->whereIn( 'activity', $this->expert_feedback_questions )
				                                               ->where( 'response', '!=', '' );
			                                         } )
			                                         ->get();

			return view( 'page-feedback', compact( 'observations', 'user', 'expert_observations', 'institute' ) );
		}
	}
