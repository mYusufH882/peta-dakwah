<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDataLokasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('data_lokasi', 'pimpinan_jamaah') || Schema::hasColumn('data_lokasi', 'diresmikan')) {
            Schema::table('data_lokasi', function (Blueprint $table) {
                $table->string('pimpinan_jamaah')->after('nama_lokasi')->nullable();
                $table->date('diresmikan')->after('pimpinan_jamaah')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_lokasi', function (Blueprint $table) {
            $table->dropColumn(['pimpinan_jamaah', 'diresmikan']);
        });
    }
}
