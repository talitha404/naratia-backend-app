<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Bikin Data User
        $userId = DB::table('users')->insertGetId([
            'username' => 'UserTes', 
            'email' => 'test@naratia.com',
            'password' => Hash::make('password123'), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Bikin Data Cerita (Sekarang sudah ada user_id-nya!)
        $storyId = DB::table('stories')->insertGetId([
            'user_id' => $userId, // <--- INI YG DITUNGGU SATPAMNYA
            'title' => 'TAKDIR TERINDAH',
            'description' => 'Sebuah kisah tentang keajaiban dan takdir yang tak terduga.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Bikin Data Bab Cerita
        DB::table('story_contents')->insert([
            'story_id' => $storyId, 
            'chapter_number' => 1,
            'title' => 'BAB 1: Awal Mula',
            'content' => 'Pertemuan tak terduga hari itu membuat [NAMA_USER] terdiam. "Apakah ini takdir?" batin [NAMA_USER].',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}