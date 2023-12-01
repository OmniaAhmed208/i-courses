<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_section_id');
            $table->foreign('assignment_section_id')->references('id')->on('assignment_sections')->onDelete('cascade');
            $table->text('title');
            $table->string('type');
            $table->string('mark');
            $table->json('choices')->nullable();
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
        Schema::dropIfExists('assignment_questions');
    }
}
