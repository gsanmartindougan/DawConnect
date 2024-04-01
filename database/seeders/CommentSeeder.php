<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener algunos IDs de usuarios y posts
        $userIds = DB::table('users')->pluck('id')->toArray();
        $postIds = DB::table('posts')->pluck('id')->toArray();

        // Crear algunos comentarios de ejemplo
        for ($i = 0; $i < 20; $i++) {
            DB::table('comments')->insert([
                'content' => 'Comentario ' . ($i + 1),
                'user_id' => $userIds[array_rand($userIds)],
                'post_id' => $postIds[array_rand($postIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
