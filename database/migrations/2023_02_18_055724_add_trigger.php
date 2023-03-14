<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER set_status_pengaduan AFTER DELETE ON tanggapans FOR EACH ROW UPDATE pengaduans SET status = "0" WHERE id = OLD.pengaduan_id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::unprepared('DROP TRIGGER IF EXISTS set_status_pengaduan');
    }
};
