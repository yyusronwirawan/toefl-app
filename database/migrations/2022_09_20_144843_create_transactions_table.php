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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->uuid('exam_id');
            $table->string('code');
            $table->tinyInteger('voucher_activated')->default(0);
            $table->tinyInteger('voucher_used')->default(0);
            $table->double('total_purchases');
            $table->datetime('maximum_payment_time');
            $table->enum('transaction_status', ['pending', 'paid', 'failed', 'done']);
            $table->string('voucher_token')->nullable();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('exam_id')
                  ->references('id')
                  ->on('exams')
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
        Schema::dropIfExists('transactions');
    }
};
