<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->uuid('category_id');
            $table->uuid('exam_id');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('duration')->nullable();
            $table->integer('section')->default(1);
            $table->integer('total_section');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->time('work_duration')->nullable();
            $table->integer('total_correct')->default(0);
            $table->json('total_correct_per_section')->nullable();
            $table->double('percentage_grade')->nullable();
            $table->decimal('grade', 5, 2)->nullable();
            $table->double('final_grade')->nullable();
            $table->json('answers')->nullable();
            $table->json('grade_details')->nullable();
            $table->integer('is_finished')->default(0)->nullable();
            $table->integer('grade_calculate')->default(0);
            $table->integer('total_tolerance')->default(0)->nullable();
            $table->tinyInteger('is_blocked')->default(0)->nullable();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('exam_id')
                  ->references('id')
                  ->on('exams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
