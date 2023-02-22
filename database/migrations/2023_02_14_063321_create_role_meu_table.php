<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMeuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('t_role_menu', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_role")->unsigned()->index()->nullable();
            $table->bigInteger("id_menu")->unsigned()->index()->nullable();
            $table->enum("status_tambah",['0','1'])->default("0");
            $table->enum("status_edit",['0','1'])->default("0");
            $table->enum("status_hapus",['0','1'])->default("0");
            $table->enum("status_tampil",['user_id','all'])->default("all");
            $table->enum("status",['0','1'])->default("1");
            $table->integer("user_id")->default("1");
            $table->timestamps();
        });

        Schema::table('t_role_menu', function($table) {
            $table->foreign('id_role')->references('id')->on('m_role')->onDelete('cascade');
            $table->foreign('id_menu')->references('id')->on('m_menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_role_menu');
    }
}
