<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("admin", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_rt_rw")->nullable();
            $table->string("nama");
            $table->string("email");
            $table->string("password");
            $table->string("level");

            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign("id_rt_rw")
                ->references("id")
                ->on("rt_rw")
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
        Schema::dropIfExists("admin");
    }
}
