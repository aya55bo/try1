<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Créer la table partie_corps
     */
    public function up(): void
    {
        Schema::create('partie_corps', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('image');
            $table->string('son');
            $table->timestamps();
        });
    }

    /**
     * Supprimer la table partie_corps
     */
    public function down(): void
    {
        Schema::dropIfExists('partie_corps');
    }
};
