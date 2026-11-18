
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('author', 150);
            $table->integer('total_pages');
            $table->timestamps();
        });

        DB::statement(
            'ALTER TABLE books ADD CONSTRAINT chk_books_total_pages CHECK (total_pages > 0)'
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
