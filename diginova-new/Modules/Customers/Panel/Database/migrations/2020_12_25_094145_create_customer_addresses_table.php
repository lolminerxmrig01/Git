<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->text('lan')->nullable();
            $table->text('len')->nullable();
            $table->text('address')->nullable();
            $table->integer('plaque')->nullable();
            $table->integer('unit')->nullable();
            $table->bigInteger('postal_code')->nullable();
            $table->string('recipient_firstname')->nullable();
            $table->string('recipient_lastname')->nullable();
            $table->bigInteger('recipient_national_code')->nullable();
            $table->integer('recipient_mobile')->nullable();
            $table->boolean('is_main')->nullable();
            $table->boolean('is_recipient_self')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_addresses');
    }
}
