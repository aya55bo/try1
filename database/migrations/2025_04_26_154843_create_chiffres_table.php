<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiffresTable extends Migration
{
    public function up()
    {
        Schema::create('chiffres', function (Blueprint $table) {
            $table->id();
            $table->integer('valeur');
            $table->string('nom', 50);
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('son_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chiffres');
    }
}