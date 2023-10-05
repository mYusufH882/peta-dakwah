<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_lokasi')->nullable();
            $table->string('tipe_anggota')->nullable(); //persis, persistri, pemuda, pemudi & simpatisan
            $table->string('jabatan_anggota')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('status')->nullable(); //Menikah atau Belum
            $table->text('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->date('pendaftaran_anggota')->nullable();
            $table->date('masa_aktif_kta')->nullable();
            $table->string('pimpinan_wilayah')->nullable();
            $table->string('pimpinan_daerah')->nullable();
            $table->string('pimpinan_cabang')->nullable();
            $table->string('pimpinan_jamaah')->nullable();
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
        Schema::dropIfExists('user_detail');
    }
}
