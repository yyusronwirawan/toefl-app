<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'app_name',
        'app_url',
        'whatsapp_number',
        'whatsapp_token',
        'logo',
        'address',
        'add_activation_user',
        'add_voucher_purchase',
        'display_purchase_category',
        'login_type',
        'theme',
        'registration_member_type',
        'add_user_registration',
        'timezone',
        'block_system_type',
        'tinymce_api_key',
    ];
}
