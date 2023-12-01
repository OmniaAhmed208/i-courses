<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('requirements');
            $table->string('slug')->unique();
            $table->double('price');
            $table->string('image')->nullable();
            $table->string('small_image')->nullable();
            $table->string('status')->default('pending');
            $table->string('step')->nullable();
            $table->double('total_rate')->default(0);
            $table->string('level');
            $table->string('language');
            $table->unsignedBigInteger('total_duration')->default(0);
            $table->integer('number_of_sells')->default(0);
            $table->integer('expire_after_days')->nullable();
            $table->timestamps();


            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
