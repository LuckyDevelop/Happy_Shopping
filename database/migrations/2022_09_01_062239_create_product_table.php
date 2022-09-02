<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->string('code',50);
            $table->unsignedInteger('product_category_id');
            $table->decimal('price', 18, 2);
            $table->decimal('purchase_price', 18, 2);
            $table->string('short_description',250)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('new_product')->default(1);
            $table->tinyInteger('best_seller')->default(1);
            $table->tinyInteger('featured')->default(1);
            $table->timestamps();

            $table->foreign('product_category_id')->references('id')->on('product_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product ');
    }
};
