<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStatusChallengeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `challenge` MODIFY COLUMN `status` ENUM('draft' , 'pending' , 'paid') NOT NULL DEFAULT 'draft'");
//        Schema::table("challenge" , function (Blueprint $blueprint){
//            $blueprint->enum("status" , ["pending" , "paid"])->default("draft")->change();
//        });
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
