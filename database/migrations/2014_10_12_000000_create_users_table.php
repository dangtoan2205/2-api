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
            $table->string('password');
            $table->string('title')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('avatar_url')->nullable();
            $table->text('education')->nullable();
            $table->string('location')->nullable();
            $table->text('skills')->nullable();
            $table->text('note')->nullable();
            $table->date('birthday')->nullable();
            $table->string('roles')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
