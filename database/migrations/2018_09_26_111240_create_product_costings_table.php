<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_costings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_lading_id');
            $table->foreign('bill_of_lading_id')->references('id')->on('bill_of_ladings')->onDelete('cascade');
            $table->double('retirement');
            $table->double('remittance');
            $table->double('dh_charge');
            $table->double('transport_charge');
            $table->integer('creator_user_id')->unsigned()->nullable();
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('updator_user_id')->unsigned()->nullable();
            $table->foreign('updator_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('product_costings');
    }
}
