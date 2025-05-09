<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouleursTable extends Migration
{
    public function up()
    {
        Schema::create('couleurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('image');
            $table->string('audio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('couleurs');
    }
}