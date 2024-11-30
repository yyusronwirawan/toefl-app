<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(SettingSeeder::class);
        $this->call(TemplateSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(VillageSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ValueCategorySeeder::class);
        $this->call(DetailValueCategorySeeder::class);
        $this->call(QuestionTitleSeeder::class);

        $this->call(QuestionSeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(ValueCategoryExamSeeder::class);
        $this->call(TransactionSeeder::class);
    }
}
