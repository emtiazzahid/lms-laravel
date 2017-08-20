<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('exam_title');
            $table->integer('course_id');
            $table->integer('teacher_id');
            $table->integer('question_file_id');
            $table->text('syllabus')->nullable();
            $table->double('passing_score',5,2);
            $table->time('duration')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('exams');
    }
}
