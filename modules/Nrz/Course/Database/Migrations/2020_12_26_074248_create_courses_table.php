<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')->constrained('users','id')->onDelete('CASCADE');
            $table->foreignId('category_id')->nullable()->constrained('categories','id')->onDelete('SET NULL');
            $table->string('title');
            $table->string('slug');
            $table->float('priority')->nullable();
            $table->string('price', 15);
            $table->string('percent', 5);
            $table->enum('type', \Nrz\Course\Model\Course::$types);
            $table->enum('status',\Nrz\Course\Model\Course::$statuses) ;
            $table->enum('confirmation_status',\Nrz\Course\Model\Course::$confirmationStatuses);
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
        Schema::dropIfExists('courses');
    }
}
