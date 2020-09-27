<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAppRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userAppRoles', function (Blueprint $table) {
            // $table->increments('id');
            $table->primary(['userId', 'appId','appRoleId']);
            $table->unsignedInteger('userId');
            $table->unsignedInteger('appId');
            $table->unsignedInteger('appRoleId');

            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('appId')->references('id')->on('apps')->onDelete('cascade');
            $table->foreign('appRoleId')->references('id')->on('appRoles')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userAppRoles');
    }
}
