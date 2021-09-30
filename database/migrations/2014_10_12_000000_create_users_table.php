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
            $table->bigIncrements('id');
            $table->enum('type', ['superadmin', 'admin', 'client'])->default('client');
            $table->string('username')->unique()->nullable();
            $table->string('fullname')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('identitity_number')->unique()->nullable();

            $table->boolean('is_active')->default(0);
            $table->boolean('is_banned')->default(0);
            $table->text('ban_reason')->nullable();
            $table->string('code')->nullable();

            $table->date('date_of_birth')->nullable();

            $table->softDeletes();

            $table->rememberToken();
            $table->timestamps();
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
