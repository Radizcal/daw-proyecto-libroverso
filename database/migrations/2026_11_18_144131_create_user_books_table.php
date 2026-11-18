
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_books', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('book_id')
                ->constrained('books')
                ->restrictOnDelete();

            $table->date('started_at')->nullable();

            $table->string('status', 20)->default('reading');

            $table->date('completed_at')->nullable();

            $table->unique(['user_id', 'book_id']);

            $table->timestamps();
        });

        DB::statement(
            "ALTER TABLE user_books ADD CONSTRAINT chk_user_books_status CHECK (status IN ('reading', 'paused', 'completed'))"
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('user_books');
    }
};
