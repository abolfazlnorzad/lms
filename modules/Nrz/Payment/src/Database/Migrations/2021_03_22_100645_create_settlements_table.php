<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->string("transaction_id")->nullable();
            $table->foreignId("user_id")->nullable()->constrained()->onDelete("set null");
            $table->json("from")->nullable();
            $table->json("to")->nullable();
            $table->timestamp("settled_at")->nullable();
            $table->enum("status", \Nrz\Payment\Models\Settlement::$statuses)
                ->default(\Nrz\Payment\Models\Settlement::STATUS_PENDING);
            $table->float("amount")->unsigned();

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
        Schema::dropIfExists('settlements');
    }
}
