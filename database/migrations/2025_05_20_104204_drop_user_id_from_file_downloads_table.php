<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('file_downloads', function (Blueprint $table) {
            $table->dropForeign(['user_id']);  // if there's a foreign key
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('file_downloads', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(); // Add nullable if desired
            // Optionally re-add foreign key
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
