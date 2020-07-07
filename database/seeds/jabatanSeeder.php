<?php

use App\jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->truncate();

        jabatan::create(['nama_jabatan' => 'Asisten Ahli' , 'kum' => '100']);
        jabatan::create(['nama_jabatan' => 'Lektor (Penata Gol III/C)' , 'kum' => '200']);
        jabatan::create(['nama_jabatan' => 'Lektor (Penata Tingkat I Gol III/D)' , 'kum' => '300']);
        jabatan::create(['nama_jabatan' => 'Lektor Kepala (Pembina Gol IV/A)' , 'kum' => '400']);
        jabatan::create(['nama_jabatan' => 'Lektor Kepala (Pembina Tingkat 1 Gol IV/B)' , 'kum' => '550']);
        jabatan::create(['nama_jabatan' => 'Lektor Kepala (Pembina Utama Muda Gol IV/C)' , 'kum' => '700']);
        jabatan::create(['nama_jabatan' => 'Guru Besar / Prof. (Pembina Utama Muda Gol IV/D)' , 'kum' => '800']);
        jabatan::create(['nama_jabatan' => 'Guru Besar / Prof. (Pembina Utama Gol IV/E)' , 'kum' => '950']);

    }
}
