<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
          $table->id();
          $table->bigInteger('mobile')->nullable();
          $table->string('email')->nullable();
          $table->string('password')->nullable();
          $table->string('verify_token')->nullable();
          $table->string('first_name')->nullable();
          $table->string('last_name')->nullable();
          $table->string('national_code')->nullable();
          $table->timestamp('birthdate')->nullable();
          $table->bigInteger('bank_card_number')->nullable();
          $table->integer('job_id')->nullable();
          $table->boolean('newsletters')->nullable();
          $table->string('return_money_method')->nullable();
          $table->string('status')->default('active');
          $table->text('remember_token')->nullable();
          $table->nullableMorphs('address');
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
        Schema::dropIfExists('customers');
    }
}
