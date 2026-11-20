<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_book_id')
                ->constrained('user_books')
                ->cascadeOnDelete();

            $table->integer('pages_read');

            $table->dateTime('read_at');

            $table->timestamps();
        });

        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement(
                'ALTER TABLE reading_sessions ADD CONSTRAINT chk_reading_sessions_pages_read CHECK (pages_read > 0)'
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_sessions');
    }
};
