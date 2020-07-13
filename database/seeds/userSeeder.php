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
                'id' => '1',
                'username' => 'Admin',
                'role_id' => '1',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                ]);
                DB::table('users')->truncate();
                User::create([
                    'id' => '9',
                    'username' => 'Admin',
                    'role_id' => '1',
                    'email' => 'admin2@admin.com',
                    'password' => Hash::make('password'),
                    ]);

        User::create([
            'id' => '2',
            'username' => 'Penilai',
            'role_id' => '2',
            'email' => 'penilai@penilai.com',
            'password' => Hash::make('password'),
            ]);

         User::create([
            'id' => '3',
            'username' => 'Penilai',
            'role_id' => '2',
            'email' => 'penilai2@penilai.com',
            'password' => Hash::make('password'),
            ]);
            User::create([
                'id' => '4',
                'username' => 'Dosen A',
                'role_id' => '3',
                'email' => 'dosen@dosen.com',
                'password' => Hash::make('password'),
                ]);
                User::create([
                    'id' => '5',
                    'username' => 'Dosen B',
                    'role_id' => '3',
                    'email' => 'dosen2@dosen.com',
                    'password' => Hash::make('password'),
                    ]);
                    User::create([
                        'id' => '6',
                        'username' => 'Dosen C',
                        'role_id' => '3',
                        'email' => 'dosen3@dosen.com',
                        'password' => Hash::make('password'),
                        ]);
                        User::create([
                            'id' => '7',
                            'username' => 'Dosen D',
                            'role_id' => '3',
                            'email' => 'dosen4@dosen.com',
                            'password' => Hash::make('password'),
                            ]);
                            User::create([
                                'id' => '8',
                                'username' => 'Dadi Mulyadi M.Kom',
                                'role_id' => '3',
                                'email' => 'dadi@dosen.com',
                                'password' => Hash::make('dadi'),
                                ]);
    }
}
