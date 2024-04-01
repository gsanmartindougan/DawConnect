<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => 'User' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // La contraseña es 'password'
                'student' => $i % 3 == 0, // Asigna 1 de cada 3 usuarios como estudiante
                'teacher' => $i % 4 == 0, // Asigna 1 de cada 4 usuarios como profesor
                'mod' => $i % 5 == 0, // Asigna 1 de cada 5 usuarios como moderador
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
