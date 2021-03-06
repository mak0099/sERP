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
            $table->date('bill_of_lading_date');
            $table->integer('letter_of_credit_id')->unsigned();
            $table->foreign('letter_of_credit_id')->references('id')->on('letter_of_credits')->onDelete('cascade');
            $table->date('letter_of_credit_date');
            $table->string('container_no');
            $table->string('container_size');
            $table->string('number_of_box');
            $table->integer('shipping_agency_vendor_id')->unsigned();
            $table->foreign('shipping_agency_vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->integer('local_agency_vendor_id')->unsigned();
            $table->foreign('local_agency_vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->integer('exporter_vendor_id')->unsigned();
            $table->foreign('exporter_vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->integer('consignee_company_profile_id')->nullable();
            $table->foreign('consignee_company_profile_id')->references('id')->on('company_profiles')->onDelete('cascade');
            $table->string('acceptance');
            $table->integer('port_of_loading_port_id')->unsigned();
            $table->foreign('port_of_loading_port_id')->references('id')->on('ports')->onDelete('cascade');
            $table->integer('port_of_discharge_port_id')->unsigned();
            $table->foreign('port_of_discharge_port_id')->references('id')->on('ports')->onDelete('cascade');
            $table->string('place_of_delivery');
            $table->string('voyage_no');
            $table->string('place_of_transhipment');
            $table->integer('modes_of_transport_id')->unsigned();
            $table->foreign('modes_of_transport_id')->references('id')->on('modes_of_transports')->onDelete('cascade');
            $table->integer('move_type_id')->unsigned();
            $table->foreign('move_type_id')->references('id')->on('move_types')->onDelete('cascade');
            $table->string('issue_place');
            $table->string('number_of_mtd');
            $table->string('packaging_qty');
            $table->string('gross_weight');
            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
