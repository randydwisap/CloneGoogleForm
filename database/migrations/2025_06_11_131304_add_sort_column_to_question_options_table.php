<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('question_options', function (Blueprint $table) {
            // Tambahkan kolom ini
            $table->integer('sort')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('question_options', function (Blueprint $table) {
            // Untuk keperluan rollback
            $table->dropColumn('sort');
        });
    }
};
