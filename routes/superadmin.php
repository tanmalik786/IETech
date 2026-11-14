<?php

	/*
	|--------------------------------------------------------------------------
	| Superadmin Routes
	|--------------------------------------------------------------------------
	|
	| Routes related to superadmin user.
	|
	*/


	Route::group( [
		'middleware' => 'auth',
		'prefix'     => 'superadmin',
		'as'         => 'superadmin.',
	], function () {

		Route::group(['prefix' => 'topics'], function() {
			Route::get('/', [\App\Http\Controllers\SuperAdmin\TopicController::class, 'index'])->name('topics');
			Route::post('store', [\App\Http\Controllers\SuperAdmin\TopicController::class, 'store'])->name('topics.store');
			Route::post('/{topic}/update', [\App\Http\Controllers\SuperAdmin\TopicController::class, 'update'])->name('topics.update');
			Route::post('/{topic}/destroy', [\App\Http\Controllers\SuperAdmin\TopicController::class, 'destroy'])->name('topics.destroy');
		});

	} );