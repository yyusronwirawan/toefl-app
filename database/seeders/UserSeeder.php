<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MasterData\Student;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "id" => 1,
                "name" => "Admin MyEnglish",
                "email" => "administrator@myenglish.com",
                "username" => 'admin',
                "email_verified_at" => null,
                "password" => bcrypt('12345678'),
                "member_type" => 2,
                "level" => 1,
                "is_active" => 1,
                "created_at" => "2023-10-27 13:35:22",
                "updated_at" => "2023-10-27 13:35:43"
            ],
            [
                "id" => 2,
                "name" => "Dede Rusliandi Taruna",
                "email" => "dede@mail.com",
                "username" => "dede",
                "email_verified_at" => null,
                "password" => bcrypt('12345678'),
                "member_type" => 1,
                "level" => 2,
                "is_active" => 1,
                "created_at" => "2023-10-27 13:35:22",
                "updated_at" => "2023-10-27 13:35:22"
            ]
        ]);

        Student::insert([
            [
                
                "id" => "046b84ec-54ff-46a5-af53-5b6d6872a5c9",
                "created_at" => "2023-10-27 03:10:36",
                "updated_at" => "2023-10-27 03:10:36",
                "user_id" => 2,
                "province_id" => 18,
                "city_id" => 1810,
                "district_id" => 181002,
                "village_id" => 24015,
                "address" => "Jl Cigebar No 4",
                "date_of_birth" => "2023-10-21",
                "phone_number" => "6281223230946",
                "gender" => "M",
                "is_member" => 1
            ]
        ]);
    }
}
