<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->foreignId('people_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->tinyInteger('status')->default(0);
            $table->dateTime('payment_date')->nullable();
            $table->float('amount_paid');
            $table->string('payment_code')->nullable();
            $table->string('payment_link')->nullable();
            $table->string('conta_azul_code')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
