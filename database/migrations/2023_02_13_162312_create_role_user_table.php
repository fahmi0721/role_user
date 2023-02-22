<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_role_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_role")->unsigned()->index()->nullable();
            $table->bigInteger("id_user")->unsigned()->index()->nullable();
            $table->enum("status",['0','1'])->default("1");
            $table->integer("user_id")->default("1");
            
            $table->timestamps();
        });

        Schema::table('t_role_user', function($table) {
            $table->foreign('id_role')->references('id')->on('m_role')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('m_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_role_user');
    }
}
