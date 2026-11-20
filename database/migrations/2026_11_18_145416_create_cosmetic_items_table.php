<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cosmetic_items', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->string('category', 50);

            $table->integer('price');

            $table->timestamps();
        });

        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement(
                'ALTER TABLE cosmetic_items ADD CONSTRAINT chk_cosmetic_items_price CHECK (price >= 0)'
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cosmetic_items');
    }
};
