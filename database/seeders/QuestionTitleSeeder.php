<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson\QuestionTitle;

class QuestionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionTitle::insert([
            [
                "id" => "7c050e8e-20dd-4538-8d51-2eb51ff303c9",
                "created_at" => "2023-05-24 15:45:13",
                "updated_at" => "2023-05-24 15:47:22",
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "name" => "Try Out TOEFL 1",
                "total_choices" => 4,
                "total_section" => 3,
                "add_value_category" => 1,
                "assessment_type" => 1,
            ],
        ]);
    }
}
