<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanosTable extends Migration
{
   
    public function up()
    {
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->string('slug');
            $table->integer('preco');
            $table->string('referencia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('planos');
    }
}
