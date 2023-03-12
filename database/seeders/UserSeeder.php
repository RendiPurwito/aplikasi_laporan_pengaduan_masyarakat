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
        DB::table('masyarakats')->insert([
            [
                'nik' => '3270012810821123',
                'nama' => 'Majiid Muhammad',
                'username' => 'mjd831',
                'password' => bcrypt('12345'),
                'telp' => '081297096073',
                'email' => 'majiid@gmail.com',
            ],
            [
                'nik' => '3270012810821121',
                'nama' => 'Fattan Hibrizi',
                'username' => 'fttnhbz',
                'password' => bcrypt('12345'),
                'telp' => '081297096074',
                'email' => 'fttn@gmail.com',
            ],
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
                'judul_laporan' => 'Pelayanan Di Kantor Bpn Banyuwangi Sangat Mengecewakan',
                'isi_laporan' => 'Tolong beri penjelasan secara detail terkait ketentuan dan dasar hukum atas tanggapan dari kantor bpn banyuwangi pada laporan saya sebelumnya (terlampir). karna saya mengajukan permohonan sudah sesuai dengan syarat, ketentuan dan petunjuk dari kantor bpn banyuwangi, berkas sudah diterima dan dinyatakan lengkap. kalau memang dinilai permohonan saya tidak sesuai dengan ketentuan dan dasar hukum yang berlaku, kenapa berkas tetap diterima dan disuruh membayar biaya pendaftaran?',
                'foto' => '1.png',
                'status' => 'selesai',
                'visibilitas' => 'publik',
                'created_at' => '2023-02-17 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821121',
                'kategori' => 'pertanian',
                'judul_laporan' => 'Perbaikan Jalan',
                'isi_laporan' => 'Assalamualaikum. Bapak/ibu yang terhormat. Terdapat jalan rusak setengah jalan amblas karena longsor tepatnya di jalan selagombong, kecamatan nyalindung kabupaten sukabumi. Dikhawatirkan terjadi hal yang tidak diinginkan karena sudah satu tahun lebih jalan tidak ada perbaikan kurang lebih sejak oktober 2017.',
                'foto' => '1.png',
                'status' => 'diproses',
                'visibilitas' => 'publik',
                'created_at' => '2023-02-17 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori' => 'lingkungan_hidup',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'status' => 'diterima',
                'visibilitas' => 'privat',
                'created_at' => '2023-02-17 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821121',
                'kategori' => 'ketertiban_umum',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'status' => 'ditolak',
                'visibilitas' => 'privat',
                'created_at' => '2023-02-17 03:05:01'
            ],
        ]);

        DB::table('tanggapans')->insert([
            [
                'pengaduan_id' => '1',
                'tanggapan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'petugas_id' => '2',
                'created_at' => '2023-02-17 03:05:01'
            ]
        ]);
    }
}
