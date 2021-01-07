<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('season_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('media_id')->nullable()->constrained('media','id')->onDelete('SET NULL');
            $table->string('title');
            $table->string('slug')->unique();
            $table->tinyInteger('time')->unsigned()->nullable();
            $table->integer('priority')->unsigned()->nullable();
            $table->boolean('free')->default(0);
            $table->enum('confirmation_status', \Nrz\Course\Model\Lesson::$confirmationStatuses)
                ->default( \Nrz\Course\Model\Lesson::CONFIRMATION_STATUS_PENDING);
            $table->enum('status',  \Nrz\Course\Model\Lesson::$statuses)
                ->default( \Nrz\Course\Model\Lesson::STATUS_OPENED);
            $table->longText('body')->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
