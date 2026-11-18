
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('character_id')
                ->constrained('characters')
                ->cascadeOnDelete();

            $table->foreignId('cosmetic_item_id')
                ->constrained('cosmetic_items')
                ->restrictOnDelete();

            $table->dateTime('acquired_at');

            $table->boolean('is_equipped')->default(false);

            $table->unique(['character_id', 'cosmetic_item_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
