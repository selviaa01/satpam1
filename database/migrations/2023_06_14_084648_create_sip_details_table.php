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
        Schema::create('sip_details', function (Blueprint $table) {
            $table->id();
            $table->string('kd_satpam')->nullable();
            $table->integer('kd_sip')->nullable();
            $table->string('tempat_jaga')->nullable();
            $table->string('seragam_jaga')->nullable();
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
        Schema::dropIfExists('sip_details');
    }
};
