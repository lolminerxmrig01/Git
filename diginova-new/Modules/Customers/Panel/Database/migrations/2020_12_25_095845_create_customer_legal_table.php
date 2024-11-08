<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerLegalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_legal', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->bigInteger('economic_number')->nullable();
            $table->bigInteger('nationalـidentity')->nullable();
            $table->bigInteger('registration_number')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('states');
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
        Schema::dropIfExists('customer_legal');
    }
}
