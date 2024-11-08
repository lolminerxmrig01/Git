
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title_fa');
            $table->string('title_en')->nullable();
            $table->string('nature');
            $table->string('model');
            $table->integer('is_iranian')->nullable();
            $table->integer('status');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('brand_id');
            $table->integer('product_code')->unique();
            $table->string('slug');
            $table->json('advantages')->nullable();
            $table->json('disadvantages')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('has_stock')->default(0);
            $table->integer('sales_count')->default(0);
            $table->integer('min_price')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
