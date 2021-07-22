<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique()->primary();
            $table->string('name', 30);
            $table->string('family', 35);
            $table->string('email')->unique()->nullable();
            $table->string('phone', 11);
            $table->string('cc', 9);
            $table->string('national_code', 10)->unique()->nullable();
            $table->string('iban', 24)->unique()->nullable();
            $table->string('picture', 100)->nullable();
            $table->enum('status', ['active', 'suspend'])->nullable();
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
        Schema::dropIfExists('user');
    }
}
