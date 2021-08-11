<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfigurasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfigurasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_dashboard')->nullable();
            $table->string('nama_dashboard_singkatan')->nullable();
            $table->string('nama_portal')->nullable();
            $table->string('metatext')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('nohp')->nullable();
            $table->string('icon')->nullable();
            $table->string('auth_image')->nullable();
            $table->text('alamat')->nullable();
            $table->text('map')->nullable();
            $table->string('fb')->nullable();
            $table->string('ig')->nullable();
            $table->string('tw')->nullable();
            $table->string('website')->nullable();
            $table->string('default_password')->nullable();
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
        Schema::dropIfExists('konfigurasis');
    }
}
