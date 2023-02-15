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
        Schema::create('masyarakats', function (Blueprint $table) {
            $table->id();
            // $table->char('nik', 16);
            $table->string('nama', 35);
            $table->string('username', 25);
            $table->string('password');
            $table->string('telp', 13);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // $table->foreignId('user_id');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('masyarakats', function (Blueprint $table) {
            $table->char('nik', 16)->after('id')->primary();
            $table->dropColumn('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masyarakats');
    }
};
