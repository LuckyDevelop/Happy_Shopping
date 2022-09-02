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
        Schema::create('transaction ', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id',50);
            $table->string('customer_name',200);
            $table->string('customer_email',100);
            $table->string('customer_phone',45)->nullable();
            $table->decimal('sub_total', 18, 2);
            $table->decimal('total', 18, 2);
            $table->decimal('total_purchase', 18, 2);
            $table->text('additional_request');
            $table->string('payment_method',200);
            $table->tinyInteger('status')->default(2);
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
        Schema::dropIfExists('transaction ');
    }
};
