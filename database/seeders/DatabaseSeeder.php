<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin Data User (Gunakan updateOrInsert biar gak duplikat user)
        DB::table('users')->updateOrInsert(
            ['email' => 'test@naratia.com'],
            [
                'username' => 'UserTes', 
                'password' => Hash::make('password123'), 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $userId = DB::table('users')->where('email', 'test@naratia.com')->value('id');

        // =========================================================================
        // INI KODINGAN TAKDIR TERINDAH (AMAN: TIDAK DUPLIKAT)
        // =========================================================================
        
        DB::table('stories')->updateOrInsert(
            ['title' => 'TAKDIR TERINDAH'],
            [
                'user_id' => $userId, 
                'description' => 'Sebuah kisah tentang keajaiban dan takdir yang tak terduga. Semuanya bermula ketika senja turun di ujung kota, membawa rahasia yang sudah lama terpendam.',
                'is_published' => 1, 
                'is_trending' => 1, 
                'updated_at' => now(),
            ]
        );
        $storyId = DB::table('stories')->where('title', 'TAKDIR TERINDAH')->value('id');

        // Bersihkan konten lama biar gak ganda sebelum di-insert ulang
        DB::table('story_contents')->where('story_id', $storyId)->delete();

        $chaptersData = [
            ['title' => 'Misteri', 'content' => 'Malam itu, rintik hujan turun...'], 
            ['title' => 'Pertemuan', 'content' => 'Setelah berhasil meloloskan diri...'],
            ['title' => 'Rahasia', 'content' => 'Perjalanan menggunakan kereta kuno...'],
            ['title' => 'Pengkhianatan', 'content' => 'Satu bulan berlalu...'],
            ['title' => 'Kebenaran', 'content' => 'Kuil terbengkalai itu kini...'],
        ];

        foreach ($chaptersData as $index => $chapter) {
            DB::table('story_contents')->insert([
                'story_id' => $storyId,
                'chapter_number' => $index + 1,
                'title' => $chapter['title'],
                'content' => $chapter['content'], 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // =========================================================================
        // MULAI PENAMBAHAN 4 NOVEL BARU (AMAN: TIDAK DUPLIKAT)
        // =========================================================================
        
        $novelBaru = [
            ['title' => 'A THEORY DREAMING', 'description' => 'Mimpi yang menjadi kenyataan...', 'chapters' => [['title' => 'Dunia Kaca', 'content' => '...'], ['title' => 'Penjaga Tidur', 'content' => '...']]],
            ['title' => 'WHAT SHOULD BE WILD', 'description' => 'Alam liar memanggil...', 'chapters' => [['title' => 'Panggilan Hutan', 'content' => '...'], ['title' => 'Kutukan Alam', 'content' => '...']]],
            ['title' => 'REWRITING MEMORIES', 'description' => 'Memori yang terhapus...', 'chapters' => [['title' => 'Kepingan Kosong', 'content' => '...'], ['title' => 'Menyusun Ulang', 'content' => '...']]],
            ['title' => 'AFTERLIFE', 'description' => 'Apa yang sebenarnya terjadi...', 'chapters' => [['title' => 'Padang Sabana Terang', 'content' => '...'], ['title' => 'Sang Penuntun', 'content' => '...']]],
        ];

        foreach ($novelBaru as $novel) {
            DB::table('stories')->updateOrInsert(
                ['title' => $novel['title']],
                [
                    'user_id' => $userId, 
                    'description' => $novel['description'],
                    'is_published' => 1,
                    'is_trending' => 0, 
                    'updated_at' => now(),
                ]
            );
            
            $newStoryId = DB::table('stories')->where('title', $novel['title'])->value('id');
            
            // Bersihkan konten lama biar gak ganda
            DB::table('story_contents')->where('story_id', $newStoryId)->delete();

            foreach ($novel['chapters'] as $index => $chapter) {
                DB::table('story_contents')->insert([
                    'story_id' => $newStoryId,
                    'chapter_number' => $index + 1,
                    'title' => $chapter['title'],
                    'content' => $chapter['content'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}