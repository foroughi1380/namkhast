<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFiledRequestCodeAddTransactionCodeTableTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("transaction" , function (Blueprint $table){
           $table->dropColumn("request_code");
            $table->string("transaction_code")->nullable();
            $table->json("extras")->nullable();

            $table->integer('response_code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
