<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRationalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rationales', function (Blueprint $table) {
            $table->id();
			$table->string('observed');
			$table->unsignedBigInteger('observed_id')->nullable();
			$table->string('course_year')->nullable();
			$table->string('observed_course')->nullable();
			$table->unsignedBigInteger('user_id')->nullable(); // creater_id
			$table->string('strength')->nullable();
			$table->string('organization');

	        $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete('SET NULL');

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
        Schema::dropIfExists('rationales');
    }
}
