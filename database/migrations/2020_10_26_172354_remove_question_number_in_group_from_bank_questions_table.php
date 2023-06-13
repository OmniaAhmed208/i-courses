<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveQuestionNumberInGroupFromBankQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_questions', function (Blueprint $table) {
            $table->dropColumn('question_number_in_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_from_bank_questions', function (Blueprint $table) {
            //
        });
    }
}
