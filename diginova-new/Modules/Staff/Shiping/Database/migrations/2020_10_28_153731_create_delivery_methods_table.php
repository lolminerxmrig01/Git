<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default('active');
            $table->bigInteger('free_shipping_min_cost')->nullable();
            $table->bigInteger('delivery_cost')->nullable();
            $table->foreignId('cost_det_type_id')->comment('cost determination type');
            $table->timestamps();

            $table->foreign('cost_det_type_id')
                ->references('id')
                ->on('delivery_cost_det_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_methods');
    }

}
