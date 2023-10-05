<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('user_detail', 'npa') || !Schema::hasColumn('user_detail', 'profesi')) {
            Schema::table('user_detail', function (Blueprint $table) {
                $table->string('npa')->after('longitude')->nullable();
                $table->string('profesi')->after('npa')->nullable();
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
        Schema::table('user_detail', function (Blueprint $table) {
            $table->dropColumn(['npa', 'profesi']);
        });
    }
}
