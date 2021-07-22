<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class defaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("insert into `admin`(name , family , phone , email , password) values ('Mohammad' , 'FOKH' , '09101234567' , 'superuser@namkhast.ir' , '$2y$10$1afahAkwA.Ls6WYDeAwxZuyk1cIXhl4q/170xKC66RP/mUgYuyfK.')");
    }
}
