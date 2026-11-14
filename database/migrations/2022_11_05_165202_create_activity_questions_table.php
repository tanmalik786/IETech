<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class CreateActivityQuestionsTable extends Migration {

		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create( 'activity_questions', function ( Blueprint $table ) {
				$table->id();
				$table->text( 'label' )->nullable();
				$table->string( 'input_type' )->nullable();
				$table->string( 'placeholder' )->nullable();
				$table->text( 'options' )->nullable();
				$table->text( 'value' )->nullable();

				$table->unsignedBigInteger( 'observation_step_id' );
				$table->foreign( 'observation_step_id' )
				      ->references( 'id' )
				      ->on( 'observation_steps' );

				$table->unsignedBigInteger( 'user_id' );
				$table->foreign( 'user_id' )->references( 'id' )->on( 'users' );

				$table->timestamps();
			} );
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists( 'activity_questions' );
		}
	}
