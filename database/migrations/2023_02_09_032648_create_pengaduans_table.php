<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            // $table->integer('id_pengaduan');
            // $table->date('tgl_pengaduan');
            // $table->foreignId('masyarakat_nik');
            $table->string('nik_pelapor');
            $table->foreign('nik_pelapor')->references('nik')->on('masyarakats')->onDelete('cascade');
            // $table->enum('kategori', ['agama', 'corona_virus', 'ekonomi', 'kesehatan', 'kesetaraan_gender', 'ketertiban_umum', 'lingkungan_hidup', 'pendidikan', 'pertanian', 'peternakan', 'politik', 'kekerasan', 'teknologi_informasi']);
            $table->foreignId('kategori_id')->constrained('kategoris');
            $table->string('judul_laporan');
            $table->text('isi_laporan');
            $table->string('foto')->nullable();
            $table->enum('status', ['diterima', 'diproses', 'selesai', 'ditolak'])->default('diterima');
            $table->enum('visibilitas', ['publik', 'privat'])->default('publik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
};
