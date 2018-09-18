<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalPurchaseOrderItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('local_purchase_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->double('price', 8, 2);
            $table->double('discount_rate', 8, 2);
            $table->double('discount', 8, 2);
            $table->double('vat_rate', 8, 2);
            $table->double('total_discount', 8, 2);
            $table->double('total_vat', 8, 2);
            $table->integer('local_purchase_order_id')->unsigned();
            $table->foreign('local_purchase_order_id')->references('id')->on('local_purchase_orders')->onDelete('restrict');
            $table->integer('creator_user_id')->unsigned()->nullable();
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('updator_user_id')->unsigned()->nullable();
            $table->foreign('updator_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('local_purchase_order_items');
    }

}