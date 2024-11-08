<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStaticDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_static_details', function (Blueprint $table) {
            $table->id();
            $table->text('product_title_fa')->nullable();
            $table->string('variant_name')->nullable();
            $table->string('warranty_name')->nullable();
            $table->string('seller')->default('site');
            $table->foreignId('consignment_product_variant_id')->nullable();
            $table->timestamps();

            $table->foreign('consignment_product_variant_id')->references('id')->on('consignment_has_product_variants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_static_details');
    }
}
