<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('course_id')->constrained()->onDelete('CASCADE');
            $table->string('title');
            $table->tinyInteger('number')->unsigned();
            $table->enum('confirmation_status', \Nrz\Course\Model\Season::$confirmationStatuses)
                ->default( \Nrz\Course\Model\Season::CONFIRMATION_STATUS_PENDING);
            $table->enum('status',  \Nrz\Course\Model\Season::$statuses)
                ->default( \Nrz\Course\Model\Season::STATUS_OPENED);
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
        Schema::dropIfExists('seasons');
    }
}
