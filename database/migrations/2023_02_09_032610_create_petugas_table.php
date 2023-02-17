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
        Schema::create('petugas', function (Blueprint $table) {
            $table->id();
            // $table->integer('id_petugas');
            $table->string('nama', 35);
            $table->string('username', 25)->unique();
            $table->enum('level', ['admin', 'petugas']);
            $table->string('password');
            $table->string('telp', 13);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // $table->foreignId('user_id');
            $table->rememberToken();
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
        Schema::dropIfExists('petugas');
    }
};
