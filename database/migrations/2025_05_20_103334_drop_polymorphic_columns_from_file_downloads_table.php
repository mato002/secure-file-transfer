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
        Schema::table('file_downloads', function (Blueprint $table) {
            $table->dropColumn(['downloadable_id', 'downloadable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_downloads', function (Blueprint $table) {
            $table->unsignedBigInteger('downloadable_id');
            $table->string('downloadable_type');
        });
    }
};
