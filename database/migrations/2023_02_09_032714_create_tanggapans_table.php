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
            $table->unsignedBigInteger('pengaduan_id');
            $table->foreign('pengaduan_id')->references('id')->on('pengaduans')->onDelete('cascade');
            // $table->date('tgl_tanggapan');
            $table->text('tanggapan');
            $table->unsignedBigInteger('petugas_id');
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->timestamps();
        });

        // Schema::table('tanggapans', function (Blueprint $table) {
        //     $table->foreign('pengaduan_id')->references('id')->on('pengaduans')->onDelete('cascade');
        // });
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
