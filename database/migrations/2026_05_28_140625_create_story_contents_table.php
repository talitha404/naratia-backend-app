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
        Schema::create('story_contents', function (Blueprint $table) {
            $table->id();
            // Sambungkan ke tabel stories
            $table->foreignId('story_id')->constrained('stories')->onDelete('cascade');
            $table->integer('chapter_number');
            $table->string('title');
            $table->longText('content'); // longText supaya muat cerita panjang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_contents');
    }
};
