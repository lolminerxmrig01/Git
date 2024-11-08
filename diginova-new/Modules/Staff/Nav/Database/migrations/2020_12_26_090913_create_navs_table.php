<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link')->nullable();
            $table->string('style')->nullable();
            $table->string('position')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->default('active');
            $table->boolean('has_ads')->default(0);
            $table->integer('parent_id')->nullable();
            $table->foreignId('location_id')->nullable();
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('nav_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navs');
    }
}
