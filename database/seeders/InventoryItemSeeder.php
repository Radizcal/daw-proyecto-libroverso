<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoryItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'admin@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Sombrero de mago')->value('id'),
            ],
            [
                'acquired_at' => '2026-01-10 12:00:00',
                'is_equipped' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user1@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Gafas redondas')->value('id'),
            ],
            [
                'acquired_at' => '2026-01-12 15:00:00',
                'is_equipped' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user1@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Capa de aventurero')->value('id'),
            ],
            [
                'acquired_at' => '2026-02-05 16:00:00',
                'is_equipped' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user2@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Corona dorada')->value('id'),
            ],
            [
                'acquired_at' => '2026-02-10 18:00:00',
                'is_equipped' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user2@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Bufanda roja')->value('id'),
            ],
            [
                'acquired_at' => '2026-03-01 12:00:00',
                'is_equipped' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user3@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Mochila exploradora')->value('id'),
            ],
            [
                'acquired_at' => '2026-03-15 14:00:00',
                'is_equipped' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user4@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Alas de hada')->value('id'),
            ],
            [
                'acquired_at' => '2026-04-02 17:00:00',
                'is_equipped' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user5@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Botas de explorador')->value('id'),
            ],
            [
                'acquired_at' => '2026-04-20 13:00:00',
                'is_equipped' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user6@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Diadema de flores')->value('id'),
            ],
            [
                'acquired_at' => '2026-05-05 16:00:00',
                'is_equipped' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('inventory_items')->updateOrInsert(
            [
                'character_id' => DB::table('characters')
                    ->where('user_id', DB::table('users')->where('email', 'user7@cifpaviles.es')->value('id'))
                    ->value('id'),
                'cosmetic_item_id' => DB::table('cosmetic_items')->where('name', 'Mascota dragón')->value('id'),
            ],
            [
                'acquired_at' => '2026-06-10 18:00:00',
                'is_equipped' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
