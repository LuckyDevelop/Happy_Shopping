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
        Schema::create('authorizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('roles_id');
            $table->unsignedInteger('menus_id');
            $table->unsignedInteger('authorization_types_id');

            $table->foreign('roles_id')->references('id')->on('roles');
            $table->foreign('menus_id')->references('id')->on('menus');
            $table->foreign('authorization_types_id')->references('id')->on('authorization_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorizations');
    }
};
