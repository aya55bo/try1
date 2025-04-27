<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('fruit_legumes', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('type');  // fruit ou légume
        $table->string('image_path');  // chemin de l'image
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruit_legumes');
    }
    
};
