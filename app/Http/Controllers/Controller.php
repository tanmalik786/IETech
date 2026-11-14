<?php

	namespace App\Http\Controllers;

	use App\Models\Observation;
	use App\Models\ObservationStep;
	use App\Models\ShadowForm;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	use Illuminate\Foundation\Bus\DispatchesJobs;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Routing\Controller as BaseController;

	class Controller extends BaseController {

		use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

		protected $field_labels = [
			'expert' => [
				'year_group'   => 'PSET course and year',
				'course_title' => 'Observed course/ level',
			],
			'shadow' => [
				'year_group'   => 'Year Group',
				'course_title' => 'Course Title',
			],
		];

		protected $questions = [
			
			'Expert Questionnaire'                     => [
				[
					'title'     => '',
					'questions' => [
						[
							'label'       => 'Planning (including clarity of learning outcomes)',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
						[
							'label'       => 'Subject Specific (effectiveness and relevance of resources and teaching strategies)',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
						[
							'label'       => 'Structure and Pace',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
						[
							'label'       => 'Student involvement, enjoyment and  motivation',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
						[
							'label'       => 'Assessment: How was learning measured? Comment on the type, range and effectiveness of questions',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
					],
				],
				[
					'title'     => 'After discussion between the observer and the observee agree on:',
					'questions' => [
						[
							'label'       => 'a) The best things from this session',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
						[
							'label'       => 'b) Aspects of the session that could be improved',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
						[
							'label'       => 'Action Points',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'help' => 'Identify up to three points that you (and, if relevant, the colleague you observed) could work on as a consequence of what you have seen today.',
							'options'     => [],
							'value'       => [],
						],
					],
				],
			],
			'Observation Questionnaire'                => [
				[
					'label'       => '1. Identify any specific needs present in the group.(e.g. SEND/EAL/High Level Learners)',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => '2. Purpose and context of the lesson: (e.g introducing a new topic, consolidating prior learning, completing assessment activity)',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => '3. Links to previous and next lesson',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => '4. Learning Intentions: (What do you want learners to achieve by the end of the session?)',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => '5. Maths, English, Digital, ESD and Wider Employability Skills (How have you planned to develop these skills in your learners? Comment on skills relevant to this session.)',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Summary of strengths:',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Summary of areas for development:',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How has the trainee planned effectively to deliver the subject specialism?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'title' => 'Requires Improvement',
					'label'       => 'Professional Values and Attributes:',
					'input_type'  => '',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
					'sub_questions' => [
						[
							'label'       => 'Reflect on and evaluate your practice to improve learner outcomes
(Evidence of reflection and action planning)',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Promote and embed education for sustainable development (ESD)',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Value and champion diversity, equality of opportunity, inclusion and social equity',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Develop collaborative and respectful relationships with learners and colleagues',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Summary of Professional Values and Attributes:',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
					]
				],
				[
					'label'       => 'Professional Knowledge and Understanding',
					'input_type'  => '',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
					'sub_questions' => [
						[
							'label'       => 'Inspire, motivate and raise the aspirations of learners by communicating high expectations and a
passion for learning.',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Support and develop learners’ confidence, autonomy and thinking skills.',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Use your subject specialist knowledge including new practices, research and/or industry
requirements',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Demonstrate evidence-informed and creative pedagogy',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Apply your knowledge of special educational needs and disabilities to create an inclusive learning
experience',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Demonstrate understanding of the role and responsibilities of a professional teacher.
(Including H&S, legal and ethical requirements)',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Summary of professional knowledge and understanding',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
					]
				],
				[
					'label'       => 'PLANNING',
					'input_type'  => '',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
					'sub_questions' => [
						[
							'label'       => 'Devise and share well-written learning outcomes/intentions',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Plan for adaptive teaching approaches that are stretching, inclusive and relevant to learners’
needs.',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Well-structured - including appropriate beginning, middle and end sections',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Manage learning; ensuring learners understand purpose, structure and context',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Promote and support positive learner behaviour, attitudes and wellbeing',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Communicate effectively and present information clearly',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Summary of Planning',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
					]
				],
				[
					'label'       => 'DELIVERY',
					'input_type'  => '',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
					'sub_questions' => [
						[
							'label'       => 'Apply motivational, coaching and skill development strategies to help learners progress and
achieve',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Select and use digital technologies safely and effectively to promote learning',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Develop learners’ mathematics skills',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Develop learners’ English skills',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Develop learners’ digital skills',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Develop learners’ wider employability skills',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Enable learners to develop responsibility for their learning, promoting independent learning and
critical thinking skills',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Summary of Delivery',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
					]
				],
				[
					'label'       => 'ASSESMENT',
					'input_type'  => '',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
					'sub_questions' => [
						[
							'label'       => 'Use formative assessment that captures the progress of learners throughout the session',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Provide constructive and timely feedback to support development and achievement',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Take the opportunity to use peer or self-assessment, where appropriate',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Employ effective questioning skills',
							'input_type'  => 'radio',
							'placeholder' => '',
							'options'     => [
								[
									'label'   => 'Established',
									'value'   => 'established',
									'checked' => false,
								],
								[
									'label'   => 'Consolidated',
									'value'   => 'consolidated',
									'checked' => false,
								],
								[
									'label'   => 'Area to develop',
									'value'   => 'area_to_develop',
									'checked' => false,
								],
								[
									'label'   => 'Not seen',
									'value'   => 'not_seen',
									'checked' => false,
								],
							],
							'value'       => [],
						],
						[
							'label'       => 'Summary of Assessment',
							'input_type'  => 'textarea',
							'placeholder' => '',
							'options'     => [],
							'value'       => [],
						],
					]
				],
				[
					'label'       => 'A successful session?',
					'input_type'  => 'radio',
					'placeholder' => '',
					'options'     => [
						[
							'label'   => 'Yes',
							'value'   => 'yes',
							'checked' => true,
						],
						[
							'label'   => 'No',
							'value'   => 'no',
							'checked' => false,
						],
					],
					'value'       => [],
				],
				[
					'label'       => 'The Post-Observation Process and Tasks',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => '',
				],
			],
			'Mentor Questionnaire'                => [
				[
					'label'       => '1. Identify any specific needs present in the group.(e.g. SEND/EAL/High Level Learners)',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => '2. Purpose and context of the lesson: (e.g introducing a new topic, consolidating prior learning, completing assessment activity)',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => '3. Links to previous and next lesson',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => '4. Learning Intentions: (What do you want learners to achieve by the end of the session?)',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => '5. Maths, English, Digital, ESD and Wider Employability Skills (How have you planned to develop these skills in your learners? Comment on skills relevant to this session.)',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Summary of strengths',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Summary of areas to develop:',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Requires Improvement:',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How has the trainee planned effectively to deliver the subject specialism?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How effective are the resources in supporting learning in the subject?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],[
					'label'       => 'Describe the range, and quality, of teaching techniques used in the subject and how the trainee established a purposeful and motivating environment',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],[
					'label'       => 'How did the trainee work creatively to overcome individual barriers?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How did they develop the Maths/ English/Employability/Digital skills and address learner needs in these areas?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How did the trainee use formative assessment to check all learners’ progress and was this assessment accessible?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How did the trainee use questioning and student feedback to effectively support learning?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],[
					'label'       => 'How has the trainee managed the classroom to support the learning of the subject?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Highlight as many of the following that best describes the trainee during this observation:',
					'input_type'  => 'checkbox',
					'placeholder' => '',
					'options'     => [
						[
							'label'   => 'Fluent',
							'value'   => 'fluent',
							'checked' => false,
						],
						[
							'label'   => 'Articulate',
							'value'   => 'articulate',
							'checked' => false,
						],
						[
							'label'   => 'Creative',
							'value'   => 'creative',
							'checked' => false,
						],
						[
							'label'   => 'Effective',
							'value'   => 'effective',
							'checked' => false,
						],
						[
							'label'   => 'Sound',
							'value'   => 'sound',
							'checked' => false,
						],
						[
							'label'   => 'Innovative',
							'value'   => 'Secure',
							'checked' => false,
						],
						[
							'label'   => 'Original',
							'value'   => 'original',
							'checked' => false,
						],
						[
							'label'   => 'Dynamic',
							'value'   => 'dynamic',
							'checked' => false,
						],
						[
							'label'   => 'Engaging',
							'value'   => 'engaging',
							'checked' => false,
						],
					],
					'value'       => [],
				],
			],
			'TEACHER-BEGIN'                            => [
				[
					'label'       => 'Where did the tutor stand?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor say?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were tutor expectations about behaviour clear to the students?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How did the tutor gain student\'s attention?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Tutor body language?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor do to ensure all students were ready to start?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor do to take the register?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor do to collect work?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor do to distribute resources?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor do state lesson objectives?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor do recall previous knowledge?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor do check and assess understanding?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How were errors and misconceptions handled?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Closed questioning?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Open questioning?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the tutor do to move to the main part of the lesson?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Comments',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
			],
			'STD-BEGIN'                                => [
				[
					'label'       => 'How did they enter the room?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Did they have high expectations?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were they noisy?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Did they speak to the tutor?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Did they get books and equipment from bags without fuss?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'How did the students respond to the tutor’s actions?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Did they want to start the lesson?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were all students paying attention?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were all students asking questions?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were all students explaining own thinking?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were all students giving examples of related knowledge?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were all students giving examples of related knowledge?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were all students clarifying their understanding by explanation or demonstration?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were all students raising their own expectations?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Were all students understanding what to do?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'What did the students do to move into the main part of the lesson?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Comments',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
			],
			'TEACHER-MID'                              => [
				[
					'label'       => 'Introduce the main part of the lesson:',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Instruct/demonstrate/explain /illustrate ideas and skills?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'The activities were used to gain their attention, do some research and shake their brain to learn something valuable.',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Check students are on task?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Keep an overview of student progress?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'The activities were used to gain their attention, do some research and shake their brain to learn something valuable.',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Check students are on task?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Keep an overview of student progress?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Work with students/groups?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Assess understanding with individual students/whole class?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Deal with errors and misconceptions?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Ensure students work without interruption?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Spend adequate time with students/groups?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Make clear to students what they need to prepare for the plenary session?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Insist that students work to a deadline for the completion of their work?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Monitor and check student behaviour?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Use appropriate classroom management strategies to ensure good lesson pace?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Comments',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
			],
			'STD-MID'                                  => [
				[
					'label'       => 'Work on the tasks individually/ in pairs/in groups?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Work on newly introduced topics?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Continue to work on ideas introduced in previous lessons?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Seek help from the tutor?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Remain on task?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Recall and use previous knowledge?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Work collaboratively, helping each other?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Record in an appropriate way and at an appropriate standard?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Check the reasonableness of their answers?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Raise their expectations?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Reach their full potential?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Assess their achievement?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Undertake work appropriate to their various abilities?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'value'       => [],
				],
				[
					'label'       => 'Comments',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
			],
			'TEACHER-CONCL'                            => [
				[
					'label'       => 'Deal with errors and misconceptions?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Evaluate the overall success of the lesson',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Check learning objectives achieved?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Reinforce and consolidate the main teaching points?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Extend main teaching activities?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Discuss and set directed study?',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Set targets for future learning? ',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
				[
					'label'       => 'Comments',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
			],
			'STD-CONCL'                                => [
				[
					'label'       => 'Explain their work to others?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Demonstrate their work to others?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Reflect on what they have learnt?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Contribute by answering questions?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Listen to other views and approaches?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Recognise own success however small?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Show a positive attitude?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Raise their expectations?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Take responsibility for directed study tasks?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Show sensitivity to other students’ lack of understanding?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Make self -assessments?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],
				[
					'label'       => 'Act sensibly, ready to be dismissed?',
					'input_type'  => 'textarea',
					'value'       => [],
					'placeholder' => '',
					'options'     => [],
				],

				[
					'label'       => 'Comments',
					'input_type'  => 'textarea',
					'placeholder' => '',
					'options'     => [],
					'value'       => [],
				],
			],
			'Professional-values-and-attributes'       => [
				[
					'label'       => '1) Critically reflect on and evaluate your practices, values, and beliefs to improve learner outcomes.',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
							'value'      => [],
						],
					],
				],
				[
					'label'       => '2) Promote and embed education for sustainable development (ESD) across learning and working practices',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
							'value'      => [],
						],
					],
				],
				[
					'label'       => '3) Inspire, motivate, and raise aspirations of learners by communicating high expectations and a passion for learning',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
							'value'      => [],
						],
					],
				],
				[
					'label'       => '4) Support and develop learners’ confidence, autonomy and thinking skills, taking account of their needs and starting points',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
							'value'      => [],
						],
					],
				],
				[
					'label'       => '5) Value and champion diversity, equality of opportunity, inclusion and social equity.',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
							'value'      => [],
						],
					],
				],
				[
					'label'       => '6) Develop collaborative and respectful relationships with learners, colleagues and external stakeholders',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
							'value'      => [],
						],
					],
				],
				[
					'label'       => '7) Engage with and promote a culture of continuous learning and quality improvement',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
							'value'      => [],
						],
					],
				],

			],
			'Professional-knowledge-and-understanding' => [
				[
					'label'       => '8) Develop and update knowledge of your subject specialism, taking account of new practices, research and/ or industry requirements.',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '9) Critically review and apply your knowledge of educational research, pedagogy, and assessment to develop evidence-informed practice',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '10) Share and update knowledge of effective practice with colleagues, networks and/or research communities to support improvement',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '11) Develop and apply your knowledge of special educational needs and disabilities to create inclusive learning experiences',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '12) Understand your teaching role and responsibilities and how these are influenced by legal, regulatory, institutional and ethical contexts',
					'input_type'  => 'textarea',
					'value'       => [],
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
			],
			'Professional-Skills'                      => [
				[
					'label'       => '13) Promote and support positive learner behaviour, attitudes and wellbeing.',
					'input_type'  => 'textarea',
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '14) Apply motivational, coaching and skill development strategies to help learners progress and achieve',
					'input_type'  => 'textarea',
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '15) Plan and deliver learning programmes that are safe, inclusive, stretching and relevant to learners’ needs',
					'input_type'  => 'textarea',
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '16) Select and use digital technologies safely and effectively to promote learning.',
					'input_type'  => 'textarea',
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '17) Develop learners’ mathematics, English, digital and wider employability skills',
					'input_type'  => 'textarea',
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '18) Provide access to up-to-date information, advice and guidance so that learners can take ownership of their learning and make informed progression choices',
					'input_type'  => 'textarea',
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '19) Apply appropriate and fair methods of assessment and provide constructive and timely feedback to support learning and achievement',
					'input_type'  => 'textarea',
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
				[
					'label'       => '20) Develop enrichment and progression opportunities for learners through collaboration with employers, higher education and/or community groups',
					'input_type'  => 'textarea',
					'sub_section' => [
						[
							'label'      => 'Plans/Opportunities for future evidencing',
							'input_type' => 'textarea',
						],
					],
				],
			],
		];

		/**
		 * @param string $key
		 *
		 * @return array[]
		 */
		public function getQuestions( string $key = 'TEACHER-BEGIN' ): array {
			return $this->questions[ $key ];
		}

		/**
		 * @param $type
		 * @param $message
		 *
		 * @return string
		 */
		public function _message( $type, $message ) {
			$html = '<div class="alert alert-' . $type . '" role="alert">
                  ' . $message . '
                </div>';

			return $html;
		}

		/**
		 * @param $first_name
		 * @param $last_name
		 *
		 * @return string
		 */
		public function slugify( $first_name, $last_name = '' ) {
			$formatted_first_name = str_replace( " ", "-", strtolower( $first_name ) );
			$formatted_last_name  = str_replace( " ", "-", strtolower( $last_name ) );

			if( $last_name == '' ) {
				return $formatted_first_name;
			}

			return $formatted_first_name . '-' . $formatted_last_name;
		}

        public function slugify_page_title( $title, $id = null )
        {
            $page =  str_replace( " ", "-", strtolower( $title ) );

			if( $id != null ) {
				$page .= '-' .$id;
			}

			return $page;
        }


		/**
		 * Returns the next step for observation process flow
		 *
		 * @param \App\Models\ShadowForm $shadow_form
		 * @param bool                   $observation_type
		 * @param int                    $current_step_id
		 *
		 * @return false|mixed
		 */
		public function getNextStep( ShadowForm $shadow_form, $observation_type = false, $current_step_id = 0 ) {

			if ( $observation_type != false ) {
				return ObservationStep::where( 'observation_type_id', $observation_type->id )
				                      ->first() ?? false;
			}

			if ( $current_step_id !== 0 ) {
				return ObservationStep::where( 'user_id', auth()->id() )
				                      ->where( 'id', $current_step_id + 1 )
				                      ->orderBy( 'id', 'asc' )
				                      ->first() ?? false;
			}

			$observation_steps = ObservationStep::where( 'user_id', auth()->id() )
			                                    ->orderBy( 'id', 'asc' )
			                                    ->get();

			if ( empty( $observation_steps ) ) {
				return $this->registerObservationSteps( auth()->id() );
			}

			// getting first step after initiation
			if ( count( $shadow_form->details ) == 0 ) {
				return $observation_steps[0];
			}

			// getting already included step ids
			$existing_step_ids = $shadow_form->details->pluck( 'observation_step_id' )
			                                          ->toArray();

			// loop through observation steps and return the first element
			foreach ( $observation_steps as $observation_step ) {
				if ( ! in_array( $observation_step->id, $existing_step_ids ) ) {
					return $observation_step;
				}
			}


			// return false if no steps are available
			return false;

		}

		/**
		 * @return mixed
		 */
		public function getFirstStep( $observation_type = false ) {

			if ( $observation_type ) {
				return ObservationStep::where( 'observation_type_id', $observation_type->id )
				                      ->first() ?? false;
			}

			$observationStep = ObservationStep::where( 'user_id', auth()->id() )
			                                  ->orderBy( 'id', 'asc' )
			                                  ->first();
			if ( empty( $observationStep ) ) {
				$observationStep = $this->registerObservationSteps( auth()->id() );
			}

			return $observationStep;
		}

		/**
		 * @param $user_id
		 *
		 * @return mixed
		 */
		public function registerObservationSteps( $user_id ) {
			$observationSteps = [
				[
					'name'    => 'TEACHER-BEGIN',
					'slug'    => 'teacher-begin-' . $user_id,
					'user_id' => $user_id,
				],
				[
					'name'    => 'STD-BEGIN',
					'slug'    => 'student-begin-' . $user_id,
					'user_id' => $user_id,
				],
				[
					'name'    => 'TEACHER-MID',
					'slug'    => 'teacher-mid-' . $user_id,
					'user_id' => $user_id,
				],
				[
					'name'    => 'STD-MID',
					'slug'    => 'student-mid-' . $user_id,
					'user_id' => $user_id,
				],
				[
					'name'    => 'TEACHER-CONCL',
					'slug'    => 'teacher-cncl-' . $user_id,
					'user_id' => $user_id,
				],
				[
					'name'    => 'STD-CONCL',
					'slug'    => 'student-cncl-' . $user_id,
					'user_id' => $user_id,
				],
			];

			foreach ( $observationSteps as $step ) {
				ObservationStep::create( $step );
			}

			return ObservationStep::where( 'user_id', $user_id )
			                      ->orderBy( 'id', 'asc' )
			                      ->first();
		}

	}
