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
        Schema::table('shadow_forms', function (Blueprint $table) {
	        $table->unsignedBigInteger( 'observed_id' )->nullable();
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
        Schema::table('shadow_forms', function (Blueprint $table) {
            $table->dropColumn('observed_id');
			$table->dropForeign('observed_id');
        });
    }
};
