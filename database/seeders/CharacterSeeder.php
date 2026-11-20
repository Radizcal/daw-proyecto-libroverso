<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('characters')->updateOrInsert(
            ['user_id' => 1],
            [
                'level' => 1,
                'experience' => 0,
                'coins' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 2],
            [
                'level' => 2,
                'experience' => 50,
                'coins' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 3],
            [
                'level' => 3,
                'experience' => 100,
                'coins' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 4],
            [
                'level' => 1,
                'experience' => 25,
                'coins' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 5],
            [
                'level' => 2,
                'experience' => 75,
                'coins' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 6],
            [
                'level' => 1,
                'experience' => 10,
                'coins' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 7],
            [
                'level' => 4,
                'experience' => 200,
                'coins' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 8],
            [
                'level' => 2,
                'experience' => 60,
                'coins' => 160,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 9],
            [
                'level' => 1,
                'experience' => 30,
                'coins' => 110,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('characters')->updateOrInsert(
            ['user_id' => 10],
            [
                'level' => 3,
                'experience' => 120,
                'coins' => 250,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
