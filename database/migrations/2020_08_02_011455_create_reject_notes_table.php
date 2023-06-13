<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rejected_by');
            $table->foreign('rejected_by')->references('id')->on('users');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->text('note');
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
        Schema::dropIfExists('cancel_notes');
    }
}
