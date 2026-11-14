<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRationaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rationale_details', function (Blueprint $table) {
            $table->id();
			$table->text('statement');
			$table->text('response')->nullable();
			$table->unsignedBigInteger('rationale_id');
	        $table->foreign( 'rationale_id' )->references( 'id' )->on( 'rationales' );
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
        Schema::dropIfExists('rationale_details');
    }
}
