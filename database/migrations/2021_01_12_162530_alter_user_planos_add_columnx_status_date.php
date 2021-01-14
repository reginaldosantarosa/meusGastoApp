<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserPlanosAddColumnxStatusDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_plano', function (Blueprint $table) {
            $table->string('status')->default('INITIATED');
            $table->dateTime('data_inscricao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_plano', function (Blueprint $table) {
            //
        });
    }
}
