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
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('fk_product_id');
            $table->foreign('fk_product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('fk_store_id');
            $table->foreign('fk_store_id')->references('id')->on('stores')->onDelete('cascade');

            $table->unsignedBigInteger('amount');

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
        Schema::dropIfExists('store_products');
    }
};
