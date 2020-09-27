<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appRoles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('appId');
            $table->string('roleCode');
            $table->string('roleName');
            $table->boolean('isActive')->default(true);
            $table->timestamps();

            $table->foreign('appId')->references('id')->on('apps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appRoles');
    }
}
