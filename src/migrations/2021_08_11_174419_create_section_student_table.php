<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('section_id');
            $table->integer('first')->unsigned()->nullable(true);
            $table->integer('mid')->unsigned()->nullable(true);
            $table->integer('final')->unsigned()->nullable(true);
            $table->foreign('student_id')->references('id')->on('students')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_student');
    }
}
