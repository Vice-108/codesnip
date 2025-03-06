<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('snippet_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('snippet_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Ensure a user can't favorite the same snippet multiple times
            $table->unique(['user_id', 'snippet_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('snippet_favorites');
    }
};
