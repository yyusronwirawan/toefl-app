<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'created_at' => '2023-10-23 10:09:06',
            'updated_at' => '2023-10-23 10:09:06',
            'app_name' => 'Toefl Pelajarin',
            'app_url' => 'toefl.pelajarin.com',
            'whatsapp_number' => '6281212126043',
            'whatsapp_token' => 'CYRo@j_sw2LnZ0aBc9og',
            'address' => 'Cigebar RT02/RW02 Desa Bojongsari Kec Bojongsoang Kab Bandung, 40288',
            'logo' => '2310271016_pelajarin.png',
            'add_activation_user' => 1,
            'add_voucher_purchase' => 1,
            'display_purchase_category' => 0,
            'login_type' => 3,
            'theme' => 1
        ]);
    }
}
