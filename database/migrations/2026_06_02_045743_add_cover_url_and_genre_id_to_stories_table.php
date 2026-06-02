<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->string('cover_url')->nullable()->after('title');
            $table->unsignedBigInteger('genre_id')->nullable()->after('cover_url');
            $table->foreign('genre_id')
                  ->references('genre_id')
                  ->on('genres')
                  ->nullOnDelete(); 
        });
    }

    public function down(): void
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropColumn(['cover_url', 'genre_id']);
        });
    }
};