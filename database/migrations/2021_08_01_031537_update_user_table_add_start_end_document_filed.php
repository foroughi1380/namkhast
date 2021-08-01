<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTableAddStartEndDocumentFiled extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("challenge", function (Blueprint $table) {
            $table->dropColumn("extras");
            $table->string("document")->nullable();
            $table->timestamp('started_at')->nullable()->default(null);


            $table->foreignId('transaction_id')->nullable()->change()->constrained("transaction");
            $table->foreignId('winner_user')->nullable()->change()->constrained("user");
            $table->integer('maximum_user')->default(0)->change();
        });

        \Illuminate\Support\Facades\DB::statement("alter table challenge modify column ended_at timestamp");
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
