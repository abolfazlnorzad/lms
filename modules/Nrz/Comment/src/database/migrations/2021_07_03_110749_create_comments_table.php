<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('parent_id')->nullable()->constrained('comments','id')->onDelete('CASCADE');
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            $table->enum('status',[\Nrz\Comment\Model\Comment::$statuses])
                ->default(\Nrz\Comment\Model\Comment::STATUS_NEW);
            $table->text('body');
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
        Schema::dropIfExists('comments');
    }
}
