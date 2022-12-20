<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasWargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_warga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rt_rw');
            $table->integer('nominal');
            $table->date('tanggal');
            $table->string('tipe');
            $table->string('kategori');
            $table->string('catatan');

            $table->foreign('id_rt_rw')->references('id')->on('rt_rw')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kas_warga');
    }
}
