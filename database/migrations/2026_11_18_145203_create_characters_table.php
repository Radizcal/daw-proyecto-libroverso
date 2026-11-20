<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->integer('level')->default(1);

            $table->integer('experience')->default(0);

            $table->integer('coins')->default(0);

            $table->timestamps();
        });

        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement(
                'ALTER TABLE characters ADD CONSTRAINT chk_characters_level CHECK (level >= 1)'
            );

            DB::statement(
                'ALTER TABLE characters ADD CONSTRAINT chk_characters_experience CHECK (experience >= 0)'
            );

            DB::statement(
                'ALTER TABLE characters ADD CONSTRAINT chk_characters_coins CHECK (coins >= 0)'
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
