<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeighborProvinceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neighbor_province', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id');
            $table->foreignId('state_neighbor_id');
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('state_neighbor_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('neighbor_province');
    }
}
