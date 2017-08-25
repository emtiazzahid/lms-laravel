<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id');
            $table->string('part_number');
            $table->text('question');
            $table->text('option_1');
            $table->text('option_2');
            $table->text('option_3')->nullable();
            $table->text('option_4')->nullable();
            $table->tinyInteger('right_answer');
            $table->text('description')->nullable();
            $table->double('default_mark',5,3)->default(0.00);
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
        Schema::dropIfExists('mcqs');
    }
}
