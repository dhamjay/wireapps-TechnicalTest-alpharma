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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by')->unsigned();
            $table->integer('order_by')->unsigned();
            $table->timestamp('ordered')->useCurrent();
            $table->timestamp('delivered')->useCurrent();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();      
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('order_by')->references('id')->on('customers');

            // $table->foreign('created_by')
            // ->references('id')
            // ->on('users')
            // ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
