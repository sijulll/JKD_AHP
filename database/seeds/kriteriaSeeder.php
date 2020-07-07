<?php

use App\kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kriterias')->truncate();

        kriteria::create(['nama_kriteria' => 'Pendidikan & Pengjaran' , 'bobot' => '60']);
        kriteria::create(['nama_kriteria' => 'Penelitian' , 'bobot' => '30']);
        kriteria::create(['nama_kriteria' => 'Pengabdian' , 'bobot' => '10']);
    }
}
