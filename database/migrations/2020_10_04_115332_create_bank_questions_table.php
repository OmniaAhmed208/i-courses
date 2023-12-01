<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('question_number_in_group');
            $table->text('title');
            $table->string('type');
            $table->string('mark');
            $table->string('picture')->nullable();
            $table->foreignId('group_id')->references('id')->on('bank_groups')->onDelete('cascade');
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
        Schema::dropIfExists('bank_questions');
    }
}
