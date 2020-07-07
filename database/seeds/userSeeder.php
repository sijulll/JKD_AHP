<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\facades\Hash;
// use App\Role;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

            DB::table('users')->truncate();
            User::create([
                'username' => 'admin Dua',
                'role_id' => '1',
                'email' => 'admin2@admin.com',
                'password' => Hash::make('password'),
                ]);

        User::create([
            'username' => 'penilai01',
            'role_id' => '2',
            'email' => 'penilai@penilai.com',
            'password' => Hash::make('password'),
            ]);

         User::create([
            'username' => 'Dosen Ku',
            'role_id' => '3',
            'email' => 'dosen@dosen.com',
            'password' => Hash::make('password'),
            ]);
    }
}
