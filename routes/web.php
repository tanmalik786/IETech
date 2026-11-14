<?php

	use App\Models\Post;
	use App\Models\User;
	use Illuminate\Support\Facades\Artisan;
	use Illuminate\Support\Facades\Route;

	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the RouteServiceProvider within a group which
	| contains the "web" middleware group. Now create something great!
	|
	*/

	Route::get('policy', [\App\Http\Controllers\PolicyController::class, 'index'])->name('policy');


	Auth::routes();

	Route::get( 'symlink', function () {
		Artisan::call( 'storage:link' );
	} );

	Route::get( 'run-migrations', function () {
		return Artisan::call( 'migrate', [ "--force" => true ] );
	} );

	Route::get( 'register', function () {
		return view( 'admin.signup' );
	} )->middleware('guest')->name('register');

	Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
		$request->fulfill();

		return redirect('/home');
	})->middleware(['auth', 'signed'])->name('verification.verify');

	Route::post('/email/verification-notification', function (Request $request) {
		auth()->user()->sendEmailVerificationNotification();

		return back()->with('message', 'Verification link sent!');
	})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

	Route::group( [ 'middleware' => 'auth' ], function () {

		Route::get('/email/verify', function () {
			return view('auth.verify');
		})->name('verification.notice');




		Route::group( [ 'middleware' => 'verified' ], function () {

			Route::get('/forum', [\App\Http\Controllers\Sales\ForumController::class, 'index'])->name('forum');
			Route::get('/forum/topics/{topic}/show', [\App\Http\Controllers\Sales\ForumController::class, 'show'])->name('forum.show');
			Route::post('{topic}/threads/store', [\App\Http\Controllers\Sales\ThreadsController::class, 'store'])->name('topic.threads.store');
			Route::get('threads/{thread}/show', [\App\Http\Controllers\Sales\ThreadsController::class, 'show'])->name('threads.show');
			Route::post('threads/{thread}/replies/store', [\App\Http\Controllers\Sales\RepliesController::class, 'store'])->name('reply.store');


			/**
			 * Routes accessible to only institute users
			 */

			Route::group( [ 'middleware' => 'institute' ], function() {

				Route::get( 'home', function () {
					return view( 'admin.dashboard' );
				} )->name( 'home' );

				Route::get( 'dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name( 'home' );

				Route::get('blog-posts', [\App\Http\Controllers\Admin\BlogPostsController::class, 'index'])->name('admin.blog-posts');
				Route::get('blog-posts/create', [\App\Http\Controllers\Admin\BlogPostsController::class, 'create'])->name('admin.blog-posts.create');
				Route::post('blog-posts/store', [\App\Http\Controllers\Admin\BlogPostsController::class, 'store'])->name('admin.blog-posts.store');
				Route::get('blog-posts/{post}/edit', [\App\Http\Controllers\Admin\BlogPostsController::class, 'edit'])->name('admin.blog-posts.edit');
				Route::post('blog-posts/{post}/update', [\App\Http\Controllers\Admin\BlogPostsController::class, 'update'])->name('admin.blog-posts.update');
				Route::post('blog-posts/{post}/destroy', [\App\Http\Controllers\Admin\BlogPostsController::class, 'destroy'])->name('admin.blog-posts.destroy');

				Route::group(['prefix' => 'impersonate'], function() {
					Route::post('/', [\App\Http\Controllers\Admin\ImpersonateController::class, 'login'])->name('impersonate');
					Route::post('logout', [\App\Http\Controllers\Admin\ImpersonateController::class, 'logout'])->name('impersonate.logout');
				});
				// observations
				Route::group( [ 'prefix' => 'observations' ], function () {

					Route::get( '/', [
						\App\Http\Controllers\Admin\V2\ObservationController::class,
						'index',
					] )->name( 'observations' );
					Route::get( '{observation}', [
						\App\Http\Controllers\Admin\V2\ObservationController::class,
						'show',
					] )->name( 'observations.show' );

					Route::get( '/rationale/{rationale}/create', [
						\App\Http\Controllers\Admin\V2\ObservationController::class,
						'create',
					] )->name( 'observations.create' );
					Route::post( '/rationale/{rationale}/store', [
						\App\Http\Controllers\Admin\V2\ObservationController::class,
						'store',
					] )->name( 'observations.store' );

					Route::get( '/{observation}/edit', [
						\App\Http\Controllers\Admin\V2\ObservationController::class,
						'edit',
					] )->name( 'observations.edit' );
					Route::post( '/{observation}/update', [
						\App\Http\Controllers\Admin\V2\ObservationController::class,
						'update',
					] )->name( 'observations.update' );

					Route::post( '/{observation}/destroy', [
						\App\Http\Controllers\Admin\V2\ObservationController::class,
						'destroy',
					] )->name( 'observations.destroy' );

				} );

				Route::group( [ 'prefix' => 'expert-observations' ], function () {

					Route::get( '/', [
						\App\Http\Controllers\Admin\ExpertObservationController::class,
						'index',
					] )->name( 'expert.observations' );
					// Expert observations
					Route::get( 'expert/create', [
						\App\Http\Controllers\Admin\ExpertObservationController::class,
						'create',
					] )->name( 'expert.observations.create' );
					Route::get( 'expert/{expert_observation}/edit', [
						\App\Http\Controllers\Admin\ExpertObservationController::class,
						'edit',
					] )->name( 'expert.observations.edit' );
					Route::get( 'expert/{expert_observation}/show', [
						\App\Http\Controllers\Admin\ExpertObservationController::class,
						'show',
					] )->name( 'expert.observations.show' );
					Route::post( 'expert/{expert_observation}/update', [
						\App\Http\Controllers\Admin\ExpertObservationController::class,
						'update',
					] )->name( 'expert.observations.update' );
					Route::post( 'expert/store', [
						\App\Http\Controllers\Admin\ExpertObservationController::class,
						'store',
					] )->name( 'expert.observations.store' );
					Route::post( 'expert/{expert_observation}/destroy', [
						\App\Http\Controllers\Admin\ExpertObservationController::class,
						'destroy',
					] )->name( 'expert.observations.destroy' );

				} );

				Route::group( [ 'prefix' => 'placement-tasks' ], function () {
					Route::get( '/', [
						\App\Http\Controllers\Admin\PlacementTaskController::class,
						'index',
					] )->name( 'admin.placement-tasks' );
					Route::get( 'create', [
						\App\Http\Controllers\Admin\PlacementTaskController::class,
						'create',
					] )->name( 'admin.placement-tasks.create' );
					Route::post( 'store', [
						\App\Http\Controllers\Admin\PlacementTaskController::class,
						'store',
					] )->name( 'admin.placement-tasks.store' );
					Route::get( '/{placement_task}', [
						\App\Http\Controllers\Admin\PlacementTaskController::class,
						'show',
					] )->name( 'admin.placement-tasks.show' );
					Route::get( '/{placement_task}/edit', [
						\App\Http\Controllers\Admin\PlacementTaskController::class,
						'edit',
					] )->name( 'admin.placement-tasks.edit' );
					Route::post( '/{placement_task}/update', [
						\App\Http\Controllers\Admin\PlacementTaskController::class,
						'update',
					] )->name( 'admin.placement-tasks.update' );
					Route::post( '/{placement_task}/destroy', [
						\App\Http\Controllers\Admin\PlacementTaskController::class,
						'destroy',
					] )->name( 'admin.placement-tasks.destroy' );
				} );

				Route::group( [ 'prefix' => 'shadow-forms' ], function () {
					Route::get( '/', [
						\App\Http\Controllers\Admin\ShadowFormController::class,
						'index',
					] )->name( 'admin.shadow-forms' );
					Route::get( '/{shadow_form}/create', [
						\App\Http\Controllers\Admin\ShadowFormController::class,
						'create',
					] )->name( 'admin.shadow-forms.create' );
					Route::get( '/{shadow_form}/edit', [
						\App\Http\Controllers\Admin\ShadowFormController::class,
						'edit',
					] )->name( 'admin.shadow-forms.edit' );
					Route::get( '{shadow_form}/show', [
						\App\Http\Controllers\Admin\ShadowFormController::class,
						'show',
					] )->name( 'admin.shadow-forms.show' );
					Route::post( '/{shadow_form}/update', [
						\App\Http\Controllers\Admin\ShadowFormController::class,
						'update',
					] )->name( 'admin.shadow-forms.update' );
					Route::post( '/store', [
						\App\Http\Controllers\Admin\ShadowFormController::class,
						'store',
					] )->name( 'admin.shadow-forms.store' );
					Route::post( '{shadow_form}/activities/store', [
						\App\Http\Controllers\Admin\ShadowFormDetailsController::class,
						'store',
					] )->name( 'admin.shadow-forms.activities.store' );

					Route::post( '{shadow_form}/destroy', [
						\App\Http\Controllers\Admin\ShadowFormController::class,
						'destroy',
					] )->name( 'admin.shadow-forms.destroy' );
				} );

				// review form
				Route::get( 'review-forms', [
					\App\Http\Controllers\Admin\ReviewsController::class,
					'index',
				] )->name( 'review-forms' );
				Route::get( 'review-forms/create', [
					\App\Http\Controllers\Admin\ReviewsController::class,
					'create',
				] )->name( 'review-forms.create' );
				Route::post( 'review-forms/store', [
					\App\Http\Controllers\Admin\ReviewsController::class,
					'store',
				] )->name( 'admin.reviews.store' );
				Route::get( 'review-forms/{id}/edit', [
					\App\Http\Controllers\Admin\ReviewsController::class,
					'edit',
				] )->name( 'admin.reviews.edit' );
				Route::get( 'review-forms/{id}/clone', [
					\App\Http\Controllers\Admin\ReviewsController::class,
					'clone',
				] )->name( 'admin.reviews.clone' );
				Route::post( 'review-forms/{id}/destroy', [
					\App\Http\Controllers\Admin\ReviewsController::class,
					'destroy',
				] )->name( 'admin.reviews.destroy' );

				Route::get( 'review-feedback/{review}/create', [
					\App\Http\Controllers\Admin\ReviewFeedbackController::class,
					'create',
				] )->name( 'admin.review-feedback.create' );
				Route::post( 'review-feedback/{review}/store', [
					\App\Http\Controllers\Admin\ReviewFeedbackController::class,
					'store',
				] )->name( 'admin.review-feedback.store' );
				Route::post( 'profile/posts/{post}/details/update', [
					\App\Http\Controllers\Admin\ProfilePostController::class,
					'update',
				] )->name( 'profile.detail.update' );
				Route::post( 'profile/posts/{post}/details/destroy', [
					\App\Http\Controllers\Admin\ProfilePostController::class,
					'destroy',
				] )->name( 'profile.detail.destroy' );
				Route::post( 'profile/{user}/details/store', [
					\App\Http\Controllers\Admin\ProfilePostController::class,
					'store',
				] )->name( 'profile.detail.store' );

				Route::get( 'profile', [
					\App\Http\Controllers\Admin\ProfileController::class,
					'show',
				] )->name( 'profile' );
				Route::post( 'profile/{user}/update', [
					\App\Http\Controllers\Admin\ProfileController::class,
					'update',
				] )->name( 'profile.update' );

				Route::post( 'ajax/updateProfileImage/{user}', [
					\App\Http\Controllers\Admin\AjaxController::class,
					'updateProfileImage',
				] )->name( 'ajax.updateProfileImage' );

				Route::get( 'slides', [
					\App\Http\Controllers\Admin\SlidesController::class,
					'index',
				] )->name( 'slides' );
				Route::post( 'slides/{user}/store', [
					\App\Http\Controllers\Admin\SlidesController::class,
					'store',
				] )->name( 'slides.store' );
				Route::post( 'slides/{slide}/update', [
					\App\Http\Controllers\Admin\SlidesController::class,
					'update',
				] )->name( 'slides.update' );
				Route::post( 'slides/{slide}/destroy', [
					\App\Http\Controllers\Admin\SlidesController::class,
					'destroy',
				] )->name( 'slides.destroy' );

				// rationale
				Route::get( 'rationale/index', [
					\App\Http\Controllers\Admin\RationaleController::class,
					'index',
				] )->name( 'rationale' );
				Route::get( 'rationale/create', [
					\App\Http\Controllers\Admin\RationaleController::class,
					'create',
				] )->name( 'rationale.create' );
				Route::get( 'rationale/{rationale}/edit', [
					\App\Http\Controllers\Admin\RationaleController::class,
					'edit',
				] )->name( 'rationale.edit' );
				Route::post( 'rationale/store', [
					\App\Http\Controllers\Admin\RationaleController::class,
					'store',
				] )->name( 'rationale.store' );
				Route::post( 'rationale/{rationale}/update', [
					\App\Http\Controllers\Admin\RationaleController::class,
					'update',
				] )->name( 'rationale.update' );
				Route::post( 'rationale/{rationale}/destroy', [
					\App\Http\Controllers\Admin\RationaleController::class,
					'destroy',
				] )->name( 'rationale.destroy' );
				// teaching hours log
				Route::get( 'teaching-hours-log', [
					\App\Http\Controllers\Admin\TeachingHoursLogController::class,
					'index',
				] )->name( 'hourslog.index' );
				Route::get( 'teaching-hours-log/create', [
					\App\Http\Controllers\Admin\TeachingHoursLogController::class,
					'create',
				] )->name( 'hourslog.create' );
				Route::get( 'teaching-hours-log/{post}/show', [
					\App\Http\Controllers\Admin\TeachingHoursLogController::class,
					'show',
				] )->name( 'hourslog.show' );
				Route::get( 'teaching-hours-log/{post}/edit', [
					\App\Http\Controllers\Admin\TeachingHoursLogController::class,
					'edit',
				] )->name( 'hourslog.edit' );
				Route::post( 'teaching-hours-log/store', [
					\App\Http\Controllers\Admin\TeachingHoursLogController::class,
					'store',
				] )->name( 'hourslog.store' );
				Route::post( 'teaching-hours-log/{post}/update', [
					\App\Http\Controllers\Admin\TeachingHoursLogController::class,
					'update',
				] )->name( 'hourslog.update' );
				Route::post( 'teaching-hours-log/{post}/destroy', [
					\App\Http\Controllers\Admin\TeachingHoursLogController::class,
					'destroy',
				] )->name( 'hourslog.destroy' );

				Route::get('ajax/shadow_form', [
					\App\Http\Controllers\Admin\AjaxController::class,
					'getShadowForm',
				])->name('ajax.shadow_form');

				Route::post( 'ajax-fetch-hours/{post}', [
					\App\Http\Controllers\Admin\AjaxController::class,
					'getPostHoursLog',
				] )->name( 'ajaxFetchHoursLog' );

				Route::get( 'logout', function () {
					\Auth::Logout();

					return redirect( route( 'login' ) );
				} )->name( 'logout' );

				Route::post( 'pages/{page}/section/store', [
					\App\Http\Controllers\PageSectionController::class,
					'store',
				] )->name( 'pages.sections.store' );
				Route::post( 'pages/{page}/section/{section}/destroy', [
					\App\Http\Controllers\PageSectionController::class,
					'destroy',
				] )->name( 'pages.sections.destroy' );
				Route::post( 'pages/{page}/section/{section}/show', [
					\App\Http\Controllers\PageSectionController::class,
					'show',
				] )->name( 'pages.sections.show' );

				Route::get( 'pages', [
					\App\Http\Controllers\PagesController::class,
					'index',
				] )->name( 'pages' );
				Route::get( 'pages/create', [
					\App\Http\Controllers\PagesController::class,
					'create',
				] )->name( 'pages.create' );
				Route::post( 'pages/store', [
					\App\Http\Controllers\PagesController::class,
					'store',
				] )->name( 'pages.store' );
				Route::post( 'pages/{id}/update', [
					\App\Http\Controllers\PagesController::class,
					'update',
				] )->name( 'pages.update' );
				Route::get( 'pages/{page}/edit', [
					\App\Http\Controllers\PagesController::class,
					'edit',
				] )->name( 'pages.edit' );
				Route::post( 'pages/{page}/destroy', [
					\App\Http\Controllers\PagesController::class,
					'destroy',
				] )->name( 'pages.destroy' );

				Route::get( 'sliders', [
					\App\Http\Controllers\SlidersController::class,
					'index',
				] )->name( 'sliders' );
				Route::post( 'sliders/store', [
					\App\Http\Controllers\SlidersController::class,
					'store',
				] )->name( 'sliders.store' );
				Route::get( 'sliders/{slider}/edit', [
					\App\Http\Controllers\SlidersController::class,
					'edit',
				] )->name( 'sliders.edit' );

				Route::post( 'sliders/{slider}/slides/store', [
					\App\Http\Controllers\SliderSlidesController::class,
					'store',
				] )->name( 'sliders.slides.store' );
				Route::post( 'sliders/slides/{slide}/update', [
					\App\Http\Controllers\SliderSlidesController::class,
					'update',
				] )->name( 'sliders.slides.update' );
				Route::get( 'sliders/slide/{slide}/edit', [
					\App\Http\Controllers\SliderSlidesController::class,
					'store',
				] )->name( 'sliders.slide.edit' );
				Route::post( 'sliders/slides/{slide}/destroy', [
					\App\Http\Controllers\SliderSlidesController::class,
					'destroy',
				] )->name( 'sliders.slides.destroy' );

				Route::get( 'carousels', [
					\App\Http\Controllers\CarouselsController::class,
					'index',
				] )->name( 'carousels' );
				Route::post( 'carousels/store', [
					\App\Http\Controllers\CarouselsController::class,
					'store',
				] )->name( 'carousels.store' );
				Route::get( 'carousels/{slider}/edit', [
					\App\Http\Controllers\CarouselsController::class,
					'edit',
				] )->name( 'carousels.edit' );

				Route::post( 'carousels/{slider}/slides/store', [
					\App\Http\Controllers\CarouselsSlidesController::class,
					'store',
				] )->name( 'carousels.slides.store' );
				Route::post( 'carousels/slides/{slide}/update', [
					\App\Http\Controllers\CarouselsSlidesController::class,
					'update',
				] )->name( 'carousels.slides.update' );
				Route::get( 'carousels/slide/{slide}/edit', [
					\App\Http\Controllers\CarouselsSlidesController::class,
					'store',
				] )->name( 'carousels.slide.edit' );
				Route::post( 'carousels/slides/{slide}/destroy', [
					\App\Http\Controllers\CarouselsSlidesController::class,
					'destroy',
				] )->name( 'carousels.slides.destroy' );

				Route::post( 'ajax/get-section-form', [
					\App\Http\Controllers\Admin\AjaxController::class,
					'getSectionForm',
				] )->name( 'ajax.get-section-form' );
				Route::post( 'ajax/update-section', [
					\App\Http\Controllers\Admin\AjaxController::class,
					'updateSectionStatus',
				] )->name( 'ajax.update-section-visibility' );

				Route::post( 'ajax/section-order-update', [
					\App\Http\Controllers\Admin\AjaxController::class,
					'updateSectionOrder',
				] )->name( 'ajax.section.order.update' );

				Route::get( 'reflections', [
					\App\Http\Controllers\Admin\ReflectionController::class,
					'index',
				] )->name( 'reflections' );
				Route::post( 'reflections/store', [
					\App\Http\Controllers\Admin\ReflectionController::class,
					'store',
				] )->name( 'reflections.store' );
				Route::post( 'reflections/{id}/update', [
					\App\Http\Controllers\Admin\ReflectionController::class,
					'update',
				] )->name( 'reflections.update' );
				Route::post( 'reflections/{id}/destroy', [
					\App\Http\Controllers\Admin\ReflectionController::class,
					'destroy',
				] )->name( 'reflections.destroy' );
				Route::get( 'reflections/{reflection}/show', [
					\App\Http\Controllers\Admin\ReflectionController::class,
					'show',
				] )->name( 'reflections.show' );

				Route::get( 'users', [
					\App\Http\Controllers\Admin\UsersController::class,
					'index',
				] )->name( 'users' );
				Route::post( 'users/store', [
					\App\Http\Controllers\Admin\UsersController::class,
					'store',
				] )->name( 'users.store' );
				Route::post( 'users/{user}/update', [
					\App\Http\Controllers\Admin\UsersController::class,
					'update',
				] )->name( 'users.update' );

				Route::group(['prefix' => 'manage'], function() {
					Route::get('mentors', [\App\Http\Controllers\Admin\ManageMentorController::class, 'index'])->name('manage.mentors');
					Route::post('mentors/{user}/update', [\App\Http\Controllers\Admin\ManageMentorController::class, 'update'])->name('manage.mentors.update');
					Route::get('link-tutors', [\App\Http\Controllers\Admin\ManageLinkTutorController::class, 'index'])->name('manage.link-tutors');
					Route::post('link-tutors/{user}/students/update', [\App\Http\Controllers\Admin\ManageLinkTutorController::class, 'updateStudents'])->name('manage.link-tutor.students.update');
					Route::post('link-tutors/{user}/update', [\App\Http\Controllers\Admin\ManageLinkTutorController::class, 'update'])->name('manage.link-tutors.update');
				});

				Route::get('teaching-students', [\App\Http\Controllers\Admin\TeachingStudentController::class, 'index'])->name('teaching-students');
				Route::get('mentors', [\App\Http\Controllers\Admin\MentorsController::class, 'index'])->name('mentors');

				Route::post('ajax/manage/mentor/students', [\App\Http\Controllers\Admin\AjaxController::class, 'getMentorStudents']);
				Route::post('ajax/manage/link-tutor/students', [\App\Http\Controllers\Admin\AjaxController::class, 'getLinkTutorStudents']);
				Route::post('ajax/manage/link-tutors/mentors', [\App\Http\Controllers\Admin\AjaxController::class, 'getLinkTutorMentors']);

				Route::group( [ 'prefix' => 'action-plans' ], function () {
					Route::get( '/', [
						\App\Http\Controllers\Admin\ActionPlanController::class,
						'index',
					] )->name( 'action-plans' );
					Route::get( '/create', [
						\App\Http\Controllers\Admin\ActionPlanController::class,
						'create',
					] )->name( 'action-plans.create' );
					Route::get( '/{action_plan}/edit', [
						\App\Http\Controllers\Admin\ActionPlanController::class,
						'edit',
					] )->name( 'action-plans.edit' );
					Route::post( '/store', [
						\App\Http\Controllers\Admin\ActionPlanController::class,
						'store',
					] )->name( 'action-plans.store' );
					Route::post( '/{action_plan}/update', [
						\App\Http\Controllers\Admin\ActionPlanController::class,
						'update',
					] )->name( 'action-plans.update' );
					Route::post( '/{action_plan}/destroy', [
						\App\Http\Controllers\Admin\ActionPlanController::class,
						'destroy',
					] )->name( 'action-plans.destroy' );
				} );

				Route::group( [ 'prefix' => 'minimum-core' ], function () {
					Route::get( '/', [
						\App\Http\Controllers\Admin\MinimumCoreController::class,
						'index',
					] )->name( 'minimum-core' );
					Route::post( 'store', [
						\App\Http\Controllers\Admin\MinimumCoreController::class,
						'store',
					] )->name( 'minimum-core.store' );
					Route::post( 'update/{post}', [
						\App\Http\Controllers\Admin\MinimumCoreController::class,
						'update',
					] )->name( 'minimum-core.update' );
					Route::post( 'destroy/{post}', [
						\App\Http\Controllers\Admin\MinimumCoreController::class,
						'destroy',
					] )->name( 'minimum-core.destroy' );
				} );

				Route::group( [ 'prefix' => 'achievements' ], function () {
					Route::get( '/', [
						\App\Http\Controllers\Admin\AchievementsController::class,
						'index',
					] )->name( 'achievements' );
					Route::post( 'store', [
						\App\Http\Controllers\Admin\AchievementsController::class,
						'store',
					] )->name( 'achievements.store' );
					Route::post( 'update/{post}', [
						\App\Http\Controllers\Admin\AchievementsController::class,
						'update',
					] )->name( 'achievements.update' );
					Route::post( 'destroy/{post}', [
						\App\Http\Controllers\Admin\AchievementsController::class,
						'destroy',
					] )->name( 'achievements.destroy' );
					Route::get( 'show/{post}', [
						\App\Http\Controllers\Admin\AchievementsController::class,
						'show',
					] )->name( 'achievements.show' );
				} );

			} );

			Route::group( [ 'prefix' => '{institute}' ], function () {
				Route::get( '/', [
					\App\Http\Controllers\Website\InstituteController::class,
					'index',
				] )->name( 'institute' );

				Route::get('about', [
					\App\Http\Controllers\Website\AboutController::class,
					'index'
				]);

				Route::get('services', [
					\App\Http\Controllers\Website\ServicesController::class,
					'index'
				]);

				Route::get( 'portfolio/{user}', [
					\App\Http\Controllers\PortfolioController::class,
					'index',
				] )->name( 'portfolio.user' );

				Route::get( 'page/{user}/observation/{id}/{type}', [
					\App\Http\Controllers\Website\ObservationsController::class,
					'show',
				] )->name( 'website.observation' );
				Route::get( 'page/{user}/observations/{type}', [
					\App\Http\Controllers\Website\ObservationsController::class,
					'index',
				] )->name( 'website.observations' );
				Route::get( 'page/{user}/hour-logs', [
					\App\Http\Controllers\Website\HourLogsController::class,
					'index',
				] )->name( 'website.hour-logs' );
				Route::get( 'page/{user}/reflections', [
					\App\Http\Controllers\Website\ReflectionsController::class,
					'index',
				] )->name( 'website.reflections' );
				Route::get( 'page/{user}/rationales', [
					\App\Http\Controllers\Website\RationaleController::class,
					'index',
				] )->name( 'website.rationales' );
				Route::get( 'page/{user}/rationale/{rationale}', [
					\App\Http\Controllers\Website\RationaleController::class,
					'show',
				] )->name( 'website.rationale' );
				Route::get( 'page/{user}/feedback/observations', [
					\App\Http\Controllers\Website\ObservationFeedbackController::class,
					'index',
				] )->name( 'website.feedback.observations' );
				Route::get( 'page/{user}/reviews', [
					\App\Http\Controllers\Website\ReviewsController::class,
					'index',
				] )->name( 'website.reviews' );
				Route::get( 'page/{user}/review/{review}', [
					\App\Http\Controllers\Website\ReviewsController::class,
					'show',
				] )->name( 'website.review' );
				Route::get( 'page/{user}/minimum-core', [
					\App\Http\Controllers\Website\MinimumCoreController::class,
					'show',
				] )->name( 'website.minimum-core' );
				Route::get( 'page/{user}/placement-tasks', [
					\App\Http\Controllers\Website\PlacementTaskController::class,
					'show',
				] )->name( 'website.placement-tasks' );
				Route::get( 'page/{user}/cpd-achievements', [
					\App\Http\Controllers\Website\AchievementsController::class,
					'show',
				] )->name( 'website.achievements' );
				Route::get( 'page/{user}/action-plan', [
					\App\Http\Controllers\Website\ActionPlanController::class,
					'show',
				] )->name( 'website.action-plan' );
				Route::get( 'page/{user}/{page}', [
					\App\Http\Controllers\Website\PagesController::class,
					'show',
				] )->name( 'page.show' );
				Route::get( 'posts', [
					\App\Http\Controllers\Website\PostsController::class,
					'instituteIndex',
				] )->name( 'institute.posts' );

				Route::get( '{user}/posts', [
					\App\Http\Controllers\Website\PostsController::class,
					'index',
				] )->name( 'institute.user.posts' );

				Route::get( '{user}/posts/{post_slug}', [
					\App\Http\Controllers\Website\PostsController::class,
					'show',
				] )->name( 'institute.posts.show' );

				Route::get('{user}/shadow-form', [\App\Http\Controllers\Website\ShadowFormController::class, 'index'])->name('institute.shadow-form');

				Route::get('{user}/xpos', [\App\Http\Controllers\Admin\ExpertObservationController::class, 'index'])->name('xpos');
			} );
		} );
	} );


	Route::get( '/', function () {
		return view( 'sales.index' );
	} );


	require __DIR__.'/superadmin.php';

