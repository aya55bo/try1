<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDessinsTable extends Migration
{
    public function up()
    {
        Schema::create('dessins', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('chemin_fichier');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('est_partage')->default(false);
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dessins');
    }
}   