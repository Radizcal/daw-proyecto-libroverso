<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CosmeticItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Sombrero de mago'],
            [
                'description' => 'Un sombrero mágico para los amantes de la lectura.',
                'category' => 'hat',
                'price' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Gafas redondas'],
            [
                'description' => 'Unas gafas clásicas con un toque intelectual.',
                'category' => 'accessory',
                'price' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Capa de aventurero'],
            [
                'description' => 'Una capa para explorar mundos literarios.',
                'category' => 'clothing',
                'price' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Corona dorada'],
            [
                'description' => 'Una corona digna de un auténtico rey.',
                'category' => 'hat',
                'price' => 250,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Bufanda roja'],
            [
                'description' => 'Una bufanda cálida de color rojo.',
                'category' => 'clothing',
                'price' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Mochila exploradora'],
            [
                'description' => 'Una mochila para llevar todo lo necesario en tus aventuras.',
                'category' => 'accessory',
                'price' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Alas de hada'],
            [
                'description' => 'Unas pequeñas alas mágicas.',
                'category' => 'accessory',
                'price' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Botas de explorador'],
            [
                'description' => 'Unas botas resistentes para recorrer cualquier camino.',
                'category' => 'clothing',
                'price' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Diadema de flores'],
            [
                'description' => 'Una diadema decorada con pequeñas flores.',
                'category' => 'hat',
                'price' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('cosmetic_items')->updateOrInsert(
            ['name' => 'Mascota dragón'],
            [
                'description' => 'Un pequeño dragón que acompaña a tu personaje.',
                'category' => 'companion',
                'price' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
