<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //disable FK Check
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(userSeeder::class);
    }
}
