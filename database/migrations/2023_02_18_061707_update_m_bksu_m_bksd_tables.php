<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMBksuMBksdTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_bksu', function (Blueprint $table) {
            $table->integer("user_id")->after("penjelasan_bentuk_kerjasam_umum");
        });

        Schema::table('m_bksd', function (Blueprint $table) {
            $table->integer("user_id")->after("rincian_bentuk_kerjasam_detail");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_bksu', function (Blueprint $table) {
            //
        });
    }
}
