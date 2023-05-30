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
        Schema::create('s_i_p__details', function (Blueprint $table) {
            $table->id();
            $table->string('nama_satpam')->nullable();
            $table->string('hari_jaga')->nullable();
            $table->string('tempat_jaga')->nullable();
            $table->string('waktu_jaga')->nullable();
            $table->date('tanggal_jaga')->nullable();
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
        Schema::dropIfExists('s_i_p__details');
    }
};
