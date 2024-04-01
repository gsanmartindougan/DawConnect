<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userIds = DB::table('users')->pluck('id')->toArray();
        $subjectIds = DB::table('subjects')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('posts')->insert([
                'student_id' => $userIds[array_rand($userIds)],
                'subject_id' => $subjectIds[array_rand($subjectIds)],
                'title' => 'Post ' . ($i + 1),
                'content' => 'Contenido del post ' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
