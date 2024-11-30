<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::insert([
            [
                "id" => "80f683ec-e0df-4752-8b00-142eb8b7b052",
                "created_at" => "2022-09-19 11:17:52",
                "updated_at" => "2022-10-16 14:59:56",
                "bank_name" => "Bank Mandiri",
                "rekening_number" => "1300021581072",
                "rekening_name" => "Della Fadila Rahmawati",
                "image" => "2310250710_no-image.jpg",
            ],
            [
                "id" => "e62da6ed-1e18-46d5-ae71-1ece93dc68c1",
                "created_at" => "2022-09-19 11:18:31",
                "updated_at" => "2022-11-03 19:35:25",
                "bank_name" => "Bank Syariah Indonesia",
                "rekening_number" => "7164565771",
                "rekening_name" => "Rifki Adha Darmawan",
                "image" => "2310250722_no-image.jpg",
            ],
            [
                "id" => "5281a36b-0cc4-4562-8583-6e8df2a74f76",
                "created_at" => "2023-05-28 07:39:41",
                "updated_at" => "2023-05-28 07:42:33",
                "bank_name" => "Bank Central Asia",
                "rekening_number" => "3202912012",
                "rekening_name" => "Dede Rusliandi Taruna",
                "image" => "2310250756_no-image.jpg",
            ]
        ]);
    }
}
