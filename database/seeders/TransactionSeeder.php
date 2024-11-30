<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::insert([
            [
                "id" => "ba566291-a2cc-4b4f-a1f7-dda6198feb36",
                "created_at" => "2023-10-29 10:11:11",
                "updated_at" => "2023-10-27 03:13:06",
                "user_id" => 2,
                "exam_id" => "49e1686d-0433-4d68-8040-9019ce3ef0e2",
                "code" => "INV2310270001",
                "voucher_activated" => 1,
                "voucher_used" => 1,
                "total_purchases" => 99000,
                "maximum_payment_time" => "2023-10-29 10:11:11",
                "transaction_status" => "done",
                "voucher_token" => "XXAU8UM60RK3NYB"
                ]
        ]);
    }
}
