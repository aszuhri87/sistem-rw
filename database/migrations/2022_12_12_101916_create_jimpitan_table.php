<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJimpitanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("jimpitan", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_warga");
            $table->bigInteger("nominal");
            $table->unsignedBigInteger("id_admin");
            $table->timestamp("tanggal");
            $table->string("kategori");
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign("id_warga")
                ->references("id")
                ->on("warga")
                ->onDelete("cascade");
            $table
                ->foreign("id_admin")
                ->references("id")
                ->on("admin")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("jimpitan");
    }
}
