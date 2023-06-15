<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('available_balance')->default(0);
            $table->integer('frozen_balance')->default(0);
            $table->string('code')->nullable()->unique();
            $table->string('login_type')->default('website')->comment = 'website / mobile';
            $table->string('mac_address')->nullable();
            $table->string('browser_token')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->boolean('is_banned')->default(false);
            $table->string('unique_token')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedBigInteger('course_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
