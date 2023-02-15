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

        // DB::table('masyarakats')->insert([
        //     [
        //         'nik' => '2901921091',
        //         'user_id' => '3',
        //     ]
        // ]);

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

        // DB::table('pengaduans')->insert([
        //     [
        //         'tgl_pengaduan' => '2023-02-13',
        //         'masyarakat_id' => '1',
        //         'isi_laporan' => 'Laporan',
        //         'foto' => 'BUKTIPERMANEN_SISWA_0055968134.jpeg',
        //         'status' => 'selesai',
        //     ]
        // ]);

        // DB::table('tanggapans')->insert([
        //     [
        //         'pengaduan_id' => '1',
        //         'tgl_tanggapan' => '2023-02-14',
        //         'tanggapan' => 'ytta',
        //         'petugas_id' => '1',
        //     ]
        // ]);
    }
}
