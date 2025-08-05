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
        Schema::create('file_downloads', function (Blueprint $table) {
            $table->id();

            // Polymorphic relation fields
            $table->unsignedBigInteger('downloadable_id');
            $table->string('downloadable_type');

            // File being downloaded
            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');

            // Additional metadata
            $table->integer('download_count')->default(1);
            $table->ipAddress('ip_address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_downloads');
    }
};
