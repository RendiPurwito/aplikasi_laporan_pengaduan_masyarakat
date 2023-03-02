<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     [
        //         'nama' => 'Rendi Purwito Armin',
        //         'username' => 'rendi.purwito',
        //         'level' => 'admin',
        //         'telp' => '081297096073',
        //         'email' => 'rendi@gmail.com',
        //         'password' => bcrypt('12345'),
        //     ],
        //     [
        //         'nama' => 'Saputra',
        //         'username' => 'putra',
        //         'level' => 'petugas',
        //         'telp' => '081297096073',
        //         'email' => 'putra@gmail.com',
        //         'password' => bcrypt('12345'),
        //     ],
        //     [
        //         'nama' => 'Majiid',
        //         'username' => 'mjd831',
        //         'level' => 'masyarakat',
        //         'telp' => '081297096073',
        //         'email' => 'majiid@gmail.com',
        //         'password' => bcrypt('12345'),
        //     ],
        // ]);

        DB::table('masyarakats')->insert([
            [
                'nik' => '3270012810821123',
                'nama' => 'Majiid Muhammad',
                'username' => 'mjd831',
                'password' => bcrypt('12345'),
                'telp' => '081297096073',
                'email' => 'majiid@gmail.com',
            ]
        ]);

        DB::table('petugas')->insert([
            [
                'nama' => 'Rendi Purwito Armin',
                'username' => 'rendi.purwito',
                'level' => 'admin',
                'telp' => '081297096073',
                'email' => 'rendi@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'nama' => 'Saputra',
                'username' => 'putra',
                'level' => 'petugas',
                'telp' => '081297096073',
                'email' => 'putra@gmail.com',
                'password' => bcrypt('12345'),
            ],
        ]);

        DB::table('pengaduans')->insert([
            [
                'nik_pelapor' => '3270012810821123',
                'kategori' => 'agama',
                'judul_laporan' => 'Laporan',
                'isi_laporan' => 'Laporan',
                'foto' => '1.png',
                'status' => 'selesai',
                'created_at' => '2023-02-17 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori' => 'lingkungan_hidup',
                'judul_laporan' => 'Laporan',
                'isi_laporan' => 'Kenapa kapibara disebut masbro',
                'foto' => '3.png',
                'status' => '0',
                'created_at' => '2023-02-17 03:05:01'
            ],
        ]);

        DB::table('tanggapans')->insert([
            [
                'pengaduan_id' => '1',
                'tanggapan' => 'ytta',
                'petugas_id' => '2',
                'created_at' => '2023-02-17 03:05:01'
            ]
        ]);
    }
}
