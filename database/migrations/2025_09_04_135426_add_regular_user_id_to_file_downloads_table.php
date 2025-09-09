<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('file_downloads', function (Blueprint $table) {
            $table->unsignedBigInteger('regular_user_id')->nullable()->after('id');
            $table->foreign('regular_user_id')
                  ->references('id')
                  ->on('regular_users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('file_downloads', function (Blueprint $table) {
            $table->dropForeign(['regular_user_id']);
            $table->dropColumn('regular_user_id');
        });
    }
};
