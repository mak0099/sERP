<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillOfLadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_of_ladings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bill_of_lading_no');
            $table->string('bill_of_lading_date');
            $table->string('container_no');
            $table->string('container_size');
            $table->string('number_of_box');
            $table->integer('shipping_agency_id')->unsigned();
            $table->foreign('shipping_agency_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->integer('letter_of_credit_id')->unsigned();
            $table->foreign('letter_of_credit_id')->references('id')->on('letter_of_credits')->onDelete('cascade');
            $table->integer('local_agency_id');
            $table->foreign('local_agency_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->integer('exproter_id')->unsigned();
            $table->foreign('exproter_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->string('consignee');
            $table->string('acceptance');
            $table->integer('port_of_loading_id')->unsigned();
            $table->foreign('port_of_loading_id')->references('id')->on('ports')->onDelete('cascade');
            $table->integer('port_of_dischare_id')->unsigned();
            $table->foreign('port_of_dischare_id')->references('id')->on('ports')->onDelete('cascade');
            $table->string('place_of_delivery');
            $table->string('voyage_no');
            $table->string('place_of_transhipment');
            $table->string('modes_of_transport');
            $table->string('move_type');
            $table->string('issue_place');
            $table->string('number_of_mtd');
            $table->integer('creator_user_id')->unsigned()->nullable();
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('updator_user_id')->unsigned()->nullable();
            $table->foreign('updator_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('bill_of_ladings');
    }
}
