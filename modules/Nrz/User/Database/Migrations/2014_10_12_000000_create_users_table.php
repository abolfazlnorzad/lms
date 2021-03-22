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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('username', 40)->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_staff')->default(0);
            $table->bigInteger("balance")->default(0);
            $table->string('headline')->nullable();
            $table->text('bio')->nullable();
            $table->string('ip')->nullable();
            $table->string('card_number', 16)->nullable();
            $table->string('shaba', 24)->nullable();
            $table->string('telegram')->nullable();
            $table->enum('status', \Nrz\User\Model\User::$statuses)->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
