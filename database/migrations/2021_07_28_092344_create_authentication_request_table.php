<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthenticationRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authentication_request', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained("user")->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedSmallInteger("try")->default(1);
            $table->enum("status" , ["accept" , "reject" , "pending" , "block"])->default("pending");
            $table->string("national_code" , 10)->unique();
            $table->string('nc_picture', 100);
            $table->string("description")->default("")->nullable();
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
        Schema::dropIfExists('authentication_request');
    }
}
