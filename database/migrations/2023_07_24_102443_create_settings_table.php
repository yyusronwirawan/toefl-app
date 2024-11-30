<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('app_name');
            $table->string('app_url');
            $table->string('whatsapp_number');
            $table->string('whatsapp_token');
            $table->text('address');
            $table->string('logo')->nullable();
            $table->tinyInteger('add_activation_user')->default(0);
            $table->tinyInteger('add_voucher_purchase')->default(0);    
            $table->tinyInteger('display_purchase_category')->default(0);
            $table->tinyInteger('login_type')->default(1); // 1 email, 2 username, 3 email / username
            $table->integer('theme')->default(1);
            $table->tinyInteger('registration_member_type')->default(2);
            $table->integer('add_user_registration')->default(1);
            $table->string('timezone')->default('Asia/Jakarta');
            $table->tinyInteger('block_system_type')->nullable();    
            $table->text('tinymce_api_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
