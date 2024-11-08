<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeymentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peyment_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tracking_code')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('invoiceـnumber')->nullable();
            $table->foreignId('order_id')->nullable()->constrained();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->nullableMorphs('method');
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
        Schema::dropIfExists('peyment_records');
    }
}
