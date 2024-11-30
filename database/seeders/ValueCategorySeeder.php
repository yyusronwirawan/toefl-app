<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson\ValueCategory;

class ValueCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ValueCategory::insert([
            [
                "id" => "03598a55-7910-48b1-8adf-ccf2e33b332e",
                "created_at" => "2023-05-23 21:59:12",
                "updated_at" => "2023-10-28 08:42:27",
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "name" => "Reading Comprehension",
                "assessment_type" => 2,
                "section" => 3,
                "variable" => "{reading_comprehension}"
            ],
            [
                "id" => "3b7af3ee-eadd-4e83-8804-a4b5293b2822",
                "created_at" => "2023-05-27 21:58:58",
                "updated_at" => "2023-10-28 08:42:48",
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "name" => "Reading Comprehension",
                "assessment_type" => 2,
                "section" => 2,
                "variable" => "{reading_comprehension}"
            ],
            [
                "id" => "4519447b-6cd1-4d88-b072-5068662be0b0",
                "created_at" => "2023-05-23 21:58:23",
                "updated_at" => "2023-10-28 08:41:45",
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "name" => "Listening Comprehension",
                "assessment_type" => 2,
                "section" => 1,
                "variable" => "{listening_comprehension}"
            ],
            [
                "id" => "89e3775f-e252-4f78-9046-9dc1b9f61bba",
                "created_at" => "2023-05-23 21:58:55",
                "updated_at" => "2023-10-28 08:42:06",
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "name" => "Structure and Written Expression",
                "assessment_type" => 2,
                "section" => 2,
                "variable" => "{structure_and_written_expression}"
            ],
            [
                "id" => "96ffbadf-a3b5-4353-b9ce-3e3a1ad44aaf",
                "created_at" => "2023-05-27 21:58:48",
                "updated_at" => "2023-10-28 08:42:38",
                "category_id" => "ab1e771a-0037-40a4-be89-527224a6d4cc",
                "name" => "Listening Comprehension",
                "assessment_type" => 2,
                "section" => 1,
                "variable" => "{listening_comprehension}"
            ]
        ]);
    }
}
