<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHasConsignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_has_consignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('consignment_code')->nullable();
            $table->bigInteger('shiping_cost')->nullable();
            $table->bigInteger('delivery_code')->nullable();
            $table->bigInteger('tracking_code')->nullable();
            $table->timestamp('delivery_at')->nullable();
            $table->foreignId('order_status_id')->nullable();
            $table->foreignId('delivery_method_id')->nullable();
            $table->foreignId('order_id')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('delivery_method_id')->references('id')->on('delivery_methods');
            $table->foreign('order_status_id')->references('id')->on('order_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_has_consignments');
    }
}
