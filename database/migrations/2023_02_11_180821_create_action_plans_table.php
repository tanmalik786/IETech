<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_plans', function (Blueprint $table) {
            $table->id();
			$table->date('date');
			$table->string('date_description');
			$table->string('ps' )->nullable();
			$table->text('review' )->nullable();
			$table->text('actions' )->nullable();
			$table->text('development_point' );
			$table->string('rating' )->nullable();
	        $table->unsignedBigInteger( 'created_by' );
	        $table->foreign( 'created_by' )->references( 'id' )->on( 'users' );
	        $table->unsignedBigInteger( 'user_id' );
	        $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_plans');
    }
};
