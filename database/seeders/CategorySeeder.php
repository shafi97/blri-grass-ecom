<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $categories = [
            [
                'user_id'       => 1,
                'name'       => 'Buffalo',
                'created_at' => $now
            ],
            [
                'user_id'       => 1,
                'name'       => 'Sheep',
                'created_at' => $now
            ],
            [
                'user_id'       => 1,
                'name'       => 'Cow',
                'created_at' => $now
            ],
            [
                'user_id'       => 1,
                'name'       => 'Goat',
                'created_at' => $now
            ],
            [
                'user_id'       => 1,
                'name'       => 'Chicken',
                'created_at' => $now
            ],
            [
                'user_id'       => 1,
                'name'       => 'Duck',
                'created_at' => $now
            ],
        ];
        Category::insert($categories);
    }
}
