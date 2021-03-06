<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryRequisitionsTable extends Migration{

    public function up(){

        Schema::create('inventory_requisitions', function (Blueprint $table){
            $table->increments('id');
            $table->string('inventory_requisition_no')->unique();
            $table->date('date')->nullable();

            $table->integer('inventory_requisition_type_id')->unsigned();
            $table->integer('sender_working_unit_id')->unsigned();
            $table->integer('requested_working_unit_id')->unsigned();
            $table->integer('product_status_id')->unsigned()->nullable();
            $table->integer('product_type_id')->unsigned()->nullable();
            $table->integer('initial_approver_id')->unsigned()->nullable();
            $table->integer('final_approver_id')->unsigned()->nullable();
            $table->integer('inventory_requisition_status_id')->unsigned()->nullable();
            $table->integer('creator_user_id')->unsigned()->nullable();
            $table->integer('updator_user_id')->unsigned()->nullable();
            $table->text('remarks')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('inventory_requisition_type_id')->references('id')->on('inventory_requisition_types')->onDelete('cascade');
            $table->foreign('sender_working_unit_id')->references('id')->on('working_units')->onDelete('cascade');
            $table->foreign('requested_working_unit_id')->references('id')->on('working_units')->onDelete('cascade');
            $table->foreign('product_status_id')->references('id')->on('product_statuses')->onDelete('cascade');
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
            $table->foreign('initial_approver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('final_approver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updator_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('inventory_requisition_status_id')->references('id')->on('inventory_requisition_statuses')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::dropIfExists('inventory_requisitions');

    }
}
