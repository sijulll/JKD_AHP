<?php

use Illuminate\Database\Seeder;
use App\komponenkegiatan;
use Illuminate\Support\Facades\DB;
class komponenkegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('komponenkegiatans')->truncate();

        //Pendidikan
            // Kegiatan Pendidikan
        komponenkegiatan::create(['jk_id' => '1' , 'nama_kegiatan' => 'Pendidikan' , 'kegiatan_point' => '200' , 'deskripsi' => 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli']);
        komponenkegiatan::create(['jk_id' => '1' , 'nama_kegiatan' => 'Mengikuti pendidikan formal dan memperoleh gelar (Magister/Sederajat)' , 'kegiatan_point' => '150' , 'deskripsi' => 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli']);
        komponenkegiatan::create(['jk_id' => '1' , 'nama_kegiatan' => 'Mengikuti diklat prajabatan golongan III' , 'kegiatan_point' => '3' , 'deskripsi' => 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli']);
            // Pelaksanaan Pendidikan
        komponenkegiatan::create(['jk_id' => '1' , 'nama_kegiatan' => 'Asisten Ahli (Beban mengajar 10 sks pertama) ' , 'kegiatan_point' => '0.5' , 'deskripsi' => 'Pindai SK Penugasan asli dan bukti kinerja.']);
        komponenkegiatan::create(['jk_id' => '1' , 'nama_kegiatan' => 'Asisten Ahli (Beban mengajar 2 sks pertama) ' , 'kegiatan_point' => '0.25' , 'deskripsi' => 'Pindai SK Penugasan asli dan bukti kinerja.']);
        komponenkegiatan::create(['jk_id' => '1' , 'nama_kegiatan' => 'Lektor/Lektor Kepala/Profesor (Beban mengajar 10 sks pertama) ' , 'kegiatan_point' => '1' , 'deskripsi' => 'Pindai SK Penugasan asli dan bukti kinerja.']);
        komponenkegiatan::create(['jk_id' => '1' , 'nama_kegiatan' => 'Melakukan pengajaran untuk peserta pendidikan dokter melalui tindakan medik spesialitik' , 'kegiatan_point' => '4' , 'deskripsi' => 'Pindai SK Penugasan asli dan bukti kinerja.']);
        //Penelitian
            // Kegiatan Penelitian
        komponenkegiatan::create(['jk_id' => '2' , 'nama_kegiatan' => 'Hasil penelitian yang dipublikasikan dalam bentuk buku (Buku Referensi) ','kegiatan_point' => '40' , 'deskripsi' => 'Pindai SK Penugasan asli dan bukti kinerja.']);
        komponenkegiatan::create(['jk_id' => '2' , 'nama_kegiatan' => 'Hasil penelitian yang dipublikasikan dalam bentuk buku (Monograf) ','kegiatan_point' => '20' , 'deskripsi' => 'Pindai SK Penugasan asli dan bukti kinerja.']);
        //Pelaksanaan Pengabdian Kepada Masyarakat
            // Pengabdian Masyarakat
        komponenkegiatan::create(['jk_id' => '3' , 'nama_kegiatan' => 'Menduduki jabatan pimpinan pada lembaga pemerintahan/pqabat negara yang hanrs dibebaskan dari jabatan organiknya tiap semester.','kegiatan_point' => '5.5' , 'deskripsi' => 'Pindai SK Penugasan asli dan bukti kinerja.']);
        komponenkegiatan::create(['jk_id' => '3' , 'nama_kegiatan' => 'Melaksanakan pengembangan hasil pendidikan, dan penelitian yang dapat dimanfaatkan oleh masyaralat/indusrri setiap program','kegiatan_point' => '20' , 'deskripsi' => 'Pindai SK Penugasan asli dan bukti kinerja.']);
        //Pelaksanaan Pengabdian Kepada Masyarakat
            // Pengabdian Masyarakat
        komponenkegiatan::create(['jk_id' => '4' , 'nama_kegiatan' => ' Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun ','kegiatan_point' => '3' , 'deskripsi' => 'Mmjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi a Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun 3']);
        komponenkegiatan::create(['jk_id' => '4' , 'nama_kegiatan' => 'Sebagai Anggota, tiap tahun ','kegiatan_point' => '20' , 'deskripsi' => 'Mmjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi a Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun 3']);



    }
}
