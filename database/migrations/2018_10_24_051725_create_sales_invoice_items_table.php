<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoiceItemsTable extends Migration{

    public function up(){

        Schema::create('sales_invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_invoice_id')->unsigned();
            $table->integer('sales_challan_id')->unsigned();
            $table->integer('sales_order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('unit_price', 12, 2)->default(0.00)->nullable();
            $table->integer('bonus_quantity')->default(0)->nullable();
            $table->integer('invoice_quantity')->default(0)->nullable();
            $table->decimal('discount_amount', 12, 2)->default(0.00)->nullable();
            $table->timestamps();

            $table->foreign('sales_invoice_id')->references('id')->on('sales_invoices')->onDelete('cascade');
            $table->foreign('sales_challan_id')->references('id')->on('sales_challans')->onDelete('cascade');
            $table->foreign('sales_order_id')->references('id')->on('sales_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

    }

    public function down(){

        Schema::dropIfExists('sales_invoice_items');

    }
}
