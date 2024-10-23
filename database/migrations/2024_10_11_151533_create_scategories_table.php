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
    if (!Schema::hasTable('scategories')) {
        Schema::create('scategories', function (Blueprint $table) {
            $table->id();
            $table->string('nomscategorie', 100);
            $table->string('imagescategorie', 250);
            $table->unsignedBigInteger('categorieID');
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scategories');
    }
};
