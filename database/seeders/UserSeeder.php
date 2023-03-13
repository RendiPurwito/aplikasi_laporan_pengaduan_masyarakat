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

        DB::table('kategoris')->insert([
            [
                'nama_kategori' => 'Agama'
            ],
            [
                'nama_kategori' => 'Corona Virus'
            ],
            [
                'nama_kategori' => 'Ekonomi'
            ],
            [
                'nama_kategori' => 'Kesehatan'
            ],
            [
                'nama_kategori' => 'Kesetaraan Gender'
            ],
            [
                'nama_kategori' => 'Ketertiban Umum'
            ],
            [
                'nama_kategori' => 'Lingkungan Hidup'
            ],
            [
                'nama_kategori' => 'Pendidikan'
            ],
            [
                'nama_kategori' => 'Pertanian'
            ],
            [
                'nama_kategori' => 'Peternakan'
            ],
            [
                'nama_kategori' => 'Politik'
            ],
            [
                'nama_kategori' => 'Kekerasan'
            ],
            [
                'nama_kategori' => 'Teknologi Informasi'
            ],
        ]);

        DB::table('pengaduans')->insert([
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '1',
                'judul_laporan' => 'Pelayanan Di Kantor Bpn Banyuwangi Sangat Mengecewakan',
                'isi_laporan' => 'Tolong beri penjelasan secara detail terkait ketentuan dan dasar hukum atas tanggapan dari kantor bpn banyuwangi pada laporan saya sebelumnya (terlampir). karna saya mengajukan permohonan sudah sesuai dengan syarat, ketentuan dan petunjuk dari kantor bpn banyuwangi, berkas sudah diterima dan dinyatakan lengkap. kalau memang dinilai permohonan saya tidak sesuai dengan ketentuan dan dasar hukum yang berlaku, kenapa berkas tetap diterima dan disuruh membayar biaya pendaftaran?',
                'foto' => '1.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'selesai',
                'created_at' => '2023-02-17 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821121',
                'kategori_id' => '2',
                'judul_laporan' => 'Perbaikan Jalan',
                'isi_laporan' => 'Assalamualaikum. Bapak/ibu yang terhormat. Terdapat jalan rusak setengah jalan amblas karena longsor tepatnya di jalan selagombong, kecamatan nyalindung kabupaten sukabumi. Dikhawatirkan terjadi hal yang tidak diinginkan karena sudah satu tahun lebih jalan tidak ada perbaikan kurang lebih sejak oktober 2017.',
                'foto' => '1.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diproses',
                'created_at' => '2023-02-18 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '3',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-02-19 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821121',
                'kategori_id' => '4',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'ditolak',
                'created_at' => '2023-02-20 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '5',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-01 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '6',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-03 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '7',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-05 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '8',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-10 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '9',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-13 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '10',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-17 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '11',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-19 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '12',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-20 03:05:01'
            ],
            [
                'nik_pelapor' => '3270012810821123',
                'kategori_id' => '13',
                'judul_laporan' => 'Pelayanan Lambat Di Kantor Bpn Banyuwangi Tidak Profesional Dan Melanggar Peraturan',
                'isi_laporan' => 'Permohonan sertifikat pengganti karena hilang nomor berkas 204585/2022 tanggal 7 november 2022 sampai saat ini belum selesai. padahal pada lampiran ii peraturan kepala bpn no. 1 tahun 2010 harusnya selesai dalam waktu 40 hari. tapi faktanya sampai hari ini tidak ada informasi apapun terkait penyelesaian permohonan tersebut',
                'foto' => '3.png',
                'lokasi' => '-6.4048264,106.8803546',
                'status' => 'diterima',
                'created_at' => '2023-03-22 03:05:01'
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
