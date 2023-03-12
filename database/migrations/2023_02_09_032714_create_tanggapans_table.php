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
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();
            // $table->integer('id_tanggapan');
            // $table->unsignedBigInteger('pengaduan_id');
            // $table->foreign('pengaduan_id')->references('id')->on('pengaduans')->onDelete('cascade');
            $table->foreignId('pengaduan_id')->constrained('pengaduans');

            // $table->date('tgl_tanggapan');
            $table->text('tanggapan');
            // $table->unsignedBigInteger('petugas_id');
            // $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('petugas');
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
        Schema::dropIfExists('tanggapans');
    }
};
