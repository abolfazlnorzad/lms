<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_payment', function (Blueprint $table) {
            $table->foreignId("discount_id")->constrained()->onDelete("cascade");
            $table->foreignId("payment_id")->constrained()->onDelete("cascade");
            $table->primary(['discount_id', 'payment_id']);
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
        Schema::dropIfExists('discount_payment');
    }
}
