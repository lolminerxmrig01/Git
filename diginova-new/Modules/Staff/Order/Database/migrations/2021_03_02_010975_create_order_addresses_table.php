<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->text('lan')->nullable();
            $table->text('len')->nullable();
            $table->text('address')->nullable();
            $table->integer('plaque')->nullable();
            $table->integer('unit')->nullable();
            $table->bigInteger('postal_code')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->bigInteger('national_code')->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->foreignId('order_id')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
}
