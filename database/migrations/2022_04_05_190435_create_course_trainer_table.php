<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTrainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_trainer', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('trainer_id');
            // $table->bigInteger('course_id');
            $table->foreignId('trainer_id')->constrained()->references('id')->on('trainers')
            ->nullable();
            $table->foreignId('course_id')->constrained()->references('id')->on('courses')
            ->nullable();
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
        Schema::dropIfExists('course_trainer');
    }
}
