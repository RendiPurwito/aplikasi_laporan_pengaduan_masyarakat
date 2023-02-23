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
            $table->text('isi_laporan');
            $table->string('foto')->nullable();
            $table->enum('status', ['0', 'proses', 'selesai'])->default('0');
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
