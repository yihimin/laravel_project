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
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id'); // 주문 ID
        $table->unsignedBigInteger('product_id'); // 상품 ID
        $table->integer('quantity'); // 수량
        $table->decimal('price', 10, 2); // 단가
        $table->timestamps();

        // 외래 키 설정
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
