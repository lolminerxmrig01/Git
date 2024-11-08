<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type')->default(1);
            $table->boolean('is_required')->default(0);
            $table->boolean('is_filterable')->default(0);
            $table->boolean('is_favorite')->default(0);
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->integer('position')->nullable();
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')
                ->on('attribute_groups')
                ->onDelete('cascade');

            $table->foreign('unit_id')
                ->references('id')
                ->on('units');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
