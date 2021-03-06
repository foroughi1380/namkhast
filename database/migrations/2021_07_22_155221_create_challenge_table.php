<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title' , 255);
            $table->text('description');
            $table->json('extras');
            $table->foreignId('transaction_id');
            $table->foreignId('winner_user');
            $table->enum('status' , ['pending', 'paid'])->default('pending');
            $table->timestamp('ended_at');
            $table->timestamp('expiration_at')->nullable()->default(null);
            $table->string('budget');
            $table->integer('maximum_user');
            $table->enum('type' , ['free', 'nonfree']);
            $table->integer('contributors_count');
            $table->softDeletes();
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
        Schema::dropIfExists('challenge');
    }
}
