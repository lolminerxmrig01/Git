<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsignmentHasProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignment_has_product_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('count')->nullable();
            $table->bigInteger('variant_price')->nullable();
            $table->string('promotion_type')->nullable();
            $table->bigInteger('promotion_price')->nullable();
            $table->integer('promotion_percent')->nullable();
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('consignment_id')->nullable()->constrained('order_has_consignments')->cascadeOnDelete();
            $table->foreignId('product_variant_id')->nullable()->constrained('product_has_variants')->nullOnDelete();
            $table->foreignId('order_status_id')->nullable()->constrained('order_status')->restrictOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('consignment_has_product_variants');
    }
}
