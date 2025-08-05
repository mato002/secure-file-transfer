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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // The user performing the action
            $table->string('action'); // Description of the action (e.g., "file uploaded")
            $table->string('file_name')->nullable(); // Name of the affected file (if applicable)
            $table->ipAddress('ip_address')->nullable(); // Store IP address
            $table->timestamps(); // Created at & Updated at

            // Foreign key to users table (Optional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
