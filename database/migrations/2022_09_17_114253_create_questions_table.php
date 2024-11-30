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
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->uuid('question_title_id');
            $table->integer('type')->default(1); // 1 question, 2 direction
            $table->text('direction')->nullable();
            $table->uuid('value_category_id')->nullable();
            $table->tinyInteger('audio_input')->nullable()->default(0);
            $table->string('audio')->nullable();
            $table->tinyInteger('audio_played')->nullable();
            $table->tinyInteger('audio_played_limit')->nullable();
            $table->integer('audio_answer_time')->nullable();
            $table->integer('audio_played_finish')->default(0);
            $table->text('question')->nullable();
            $table->text('option_1')->nullable();
            $table->text('option_2')->nullable();
            $table->text('option_3')->nullable();
            $table->text('option_4')->nullable();
            $table->text('option_5')->nullable();
            
            $table->integer('answer')->nullable()->default(0);
            $table->integer('section')->default(1);

            $table->foreign('question_title_id')
                  ->references('id')
                  ->on('question_titles')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('value_category_id')
                  ->references('id')
                  ->on('value_categories')
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
        Schema::dropIfExists('questions');
    }
};
