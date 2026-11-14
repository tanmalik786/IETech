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
        Schema::table('observations', function (Blueprint $table) {

			$table->dropColumn('year_group');
			$table->dropColumn('time');
			$table->dropColumn('ability');
			$table->dropColumn('number_of_students');
			$table->dropColumn('course_title');
			$table->dropColumn('topic');
			$table->dropColumn('pre_req');
			$table->dropColumn('outcome');
			$table->dropColumn('number_of_staff');

	        $table->unsignedBigInteger('observer_id')->nullable();
	        $table->unsignedBigInteger('observed_id')->nullable();
	        $table->unsignedBigInteger('observation_id')->nullable();
	        $table->string('course_year')->nullable();
	        $table->string('observed_course')->nullable();
	        $table->string('strength')->nullable();

	        $table->foreign( 'observation_id' )->references( 'id' )->on( 'observations' )->onDelete('SET NULL');
	        $table->foreign( 'observer_id' )->references( 'id' )->on( 'users' )->onDelete('SET NULL');
	        $table->foreign( 'observed_id' )->references( 'id' )->on( 'users' )->onDelete('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observations', function (Blueprint $table) {
            //
        });
    }
};
