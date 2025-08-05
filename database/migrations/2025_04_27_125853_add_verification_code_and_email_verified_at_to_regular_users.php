<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerificationCodeAndEmailVerifiedAtToRegularUsers extends Migration
{
    public function up()
    {
        Schema::table('regular_users', function (Blueprint $table) {
            $table->string('verification_code')->nullable();
        });
    }

    public function down()
    {
        Schema::table('regular_users', function (Blueprint $table) {
            $table->dropColumn(['verification_code', ]);
        });
    }
}
