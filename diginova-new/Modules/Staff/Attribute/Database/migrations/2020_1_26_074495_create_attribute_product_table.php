<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id');
            $table->foreignId('product_id');
            $table->foreignId('value_id')->nullable();
            $table->foreignId('unit_id')->nullable();
            $table->foreignId('unit_value_id')->nullable();
            $table->longText('value')->nullable();
            $table->timestamps();

            $table->foreign('attribute_id')->references('id')->on('attributes')
              ->onDelete('cascade');

            $table->foreign('product_id')->references('id')->on('products')
              ->onDelete('cascade');

            $table->foreign('value_id')->references('id')->on('attribute_values')
                ->onDelete('cascade');

            $table->foreign('unit_id')->references('id')->on('units')
                ->onDelete('cascade');

            $table->foreign('unit_value_id')->references('id')->on('unit_values')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_product');
    }
}
