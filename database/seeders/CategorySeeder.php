<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterData\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'id' => 'ab1e771a-0037-40a4-be89-527224a6d4cc',
                'created_at' => '2022-09-16 18:59:06',
                'updated_at' => '2022-12-05 07:40:05',
                'name' => 'TOEIC',
                'thumbnail' => '2310250730_no-image.jpg',
                'development_status' => 'production'
            ],
            [
                'id' => 'f968e7a3-74ed-4090-b9bc-99e7c36f2a69',
                'created_at' => '2022-09-16 18:59:12',
                'updated_at' => '2022-10-24 00:41:01',
                'name' => 'TOEFL',
                'thumbnail' => '2310250746_no-image.jpg',
                'development_status' => 'production'
            ],
        ]);
    }
}
