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
        Schema::create('t_r_a_n_s__details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_trans')->nullable();
            $table->integer('id_obat')->nullable();
            $table->string('nama_obat')->nullable();
            $table->string('jenis_obat')->nullable();
            
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
        Schema::dropIfExists('t_r_a_n_s__details');
    }
};
