<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam\ValueCategoryExam;

class ValueCategoryExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ValueCategoryExam::insert([
            [
                "value_category_id" => "4519447b-6cd1-4d88-b072-5068662be0b0",
                "exam_id" => "49e1686d-0433-4d68-8040-9019ce3ef0e2",
                "section" => 1,
                "index" => 0,
                "duration" => 30,
                "created_at" => "2023-06-04 09:01:16",
                "updated_at" => "2023-06-04 09:01:16"
            ],
            [
                "value_category_id" => "89e3775f-e252-4f78-9046-9dc1b9f61bba",
                "exam_id" => "49e1686d-0433-4d68-8040-9019ce3ef0e2",
                "section" => 2,
                "index" => 1,
                "duration" => 25,
                "created_at" => "2023-06-04 09:01:16",
                "updated_at" => "2023-06-04 09:01:16"
            ],
            [
                "value_category_id" => "03598a55-7910-48b1-8adf-ccf2e33b332e",
                "exam_id" => "49e1686d-0433-4d68-8040-9019ce3ef0e2",
                "section" => 3,
                "index" => 2,
                "duration" => 55,
                "created_at" => "2023-06-04 09:01:16",
                "updated_at" => "2023-06-04 09:01:16"
            ],
            [
                "value_category_id" => "4519447b-6cd1-4d88-b072-5068662be0b0",
                "exam_id" => "779c5aae-fef1-4aa6-8f4c-4f3f100b3947",
                "section" => 1,
                "index" => 0,
                "duration" => 30,
                "created_at" => "2023-06-04 09:01:29",
                "updated_at" => "2023-06-04 09:01:29"
            ],
            [
                "value_category_id" => "89e3775f-e252-4f78-9046-9dc1b9f61bba",
                "exam_id" => "779c5aae-fef1-4aa6-8f4c-4f3f100b3947",
                "section" => 2,
                "index" => 1,
                "duration" => 25,
                "created_at" => "2023-06-04 09:01:29",
                "updated_at" => "2023-06-04 09:01:29"
            ],
            [
                "value_category_id" => "03598a55-7910-48b1-8adf-ccf2e33b332e",
                "exam_id" => "779c5aae-fef1-4aa6-8f4c-4f3f100b3947",
                "section" => 3,
                "index" => 2,
                "duration" => 55,
                "created_at" => "2023-06-04 09:01:29",
                "updated_at" => "2023-06-04 09:01:29"
            ],
            [
                "value_category_id" => "4519447b-6cd1-4d88-b072-5068662be0b0",
                "exam_id" => "e88a77af-b26c-4939-8ce3-3e0d9b5f62ec",
                "section" => 1,
                "index" => 0,
                "duration" => 30,
                "created_at" => "2023-06-04 09:01:42",
                "updated_at" => "2023-06-04 09:01:42"
            ],
            [
                "value_category_id" => "89e3775f-e252-4f78-9046-9dc1b9f61bba",
                "exam_id" => "e88a77af-b26c-4939-8ce3-3e0d9b5f62ec",
                "section" => 2,
                "index" => 1,
                "duration" => 25,
                "created_at" => "2023-06-04 09:01:42",
                "updated_at" => "2023-06-04 09:01:42"
            ],
            [
                "value_category_id" => "03598a55-7910-48b1-8adf-ccf2e33b332e",
                "exam_id" => "e88a77af-b26c-4939-8ce3-3e0d9b5f62ec",
                "section" => 3,
                "index" => 2,
                "duration" => 55,
                "created_at" => "2023-06-04 09:01:42",
                "updated_at" => "2023-06-04 09:01:42"
            ],
            [
                "value_category_id" => "4519447b-6cd1-4d88-b072-5068662be0b0",
                "exam_id" => "a532aeb8-33d6-4f44-97cb-e7a4f4248467",
                "section" => 1,
                "index" => 0,
                "duration" => 30,
                "created_at" => "2023-06-04 09:02:04",
                "updated_at" => "2023-06-04 09:02:04"
            ],
            [
                "value_category_id" => "89e3775f-e252-4f78-9046-9dc1b9f61bba",
                "exam_id" => "a532aeb8-33d6-4f44-97cb-e7a4f4248467",
                "section" => 2,
                "index" => 1,
                "duration" => 25,
                "created_at" => "2023-06-04 09:02:04",
                "updated_at" => "2023-06-04 09:02:04"
            ],
            [
                "value_category_id" => "03598a55-7910-48b1-8adf-ccf2e33b332e",
                "exam_id" => "a532aeb8-33d6-4f44-97cb-e7a4f4248467",
                "section" => 3,
                "index" => 2,
                "duration" => 55,
                "created_at" => "2023-06-04 09:02:04",
                "updated_at" => "2023-06-04 09:02:04"
            ]
        ]);
    }
}
