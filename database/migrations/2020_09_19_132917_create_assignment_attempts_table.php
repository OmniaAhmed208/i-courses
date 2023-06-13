<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('assignment_id');
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
            $table->json('answers');
            $table->integer('mark');
            $table->boolean('is_final_mark');
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
        Schema::dropIfExists('assignment_attempts');
    }
}
