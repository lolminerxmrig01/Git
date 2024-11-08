<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
          $table->id();
          $table->foreignId('customer_id');
          $table->foreignId('product_variant_id');
          $table->string('type');
          $table->integer('count');
          $table->bigInteger('old_sale_price')->nullable();
          $table->bigInteger('new_sale_price')->nullable();
          $table->bigInteger('old_promotion_price')->nullable();
          $table->bigInteger('new_promotion_price')->nullable();
          $table->timestamps();

          $table->foreign('customer_id')->references('id')->on('customers');
          $table->foreign('product_variant_id')->references('id')->on('product_has_variants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
