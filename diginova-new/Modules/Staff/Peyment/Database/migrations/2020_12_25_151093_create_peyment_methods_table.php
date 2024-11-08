<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peyment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('en_name');
            $table->string('status')->default('active');
            $table->text('description')->nullable();
            $table->longText('username')->nullable();
            $table->longText('password')->nullable();
            $table->longText('merchantId')->nullable();
            $table->longText('terminalId')->nullable();
            $table->longText('key')->nullable();
            $table->longText('paymentIdentity')->nullable();
            $table->longText('iv')->nullable();
            $table->longText('certificate')->nullable();
            $table->string('options')->nullable();
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
        Schema::dropIfExists('peyment_methods');
    }

}
