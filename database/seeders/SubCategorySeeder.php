<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryNames = Category::all();
        foreach ($categoryNames as $categoryName) {
            if ($categoryName->name == 'Buffalo') {
                $category = Category::whereName('Buffalo')->pluck('id');
                foreach ($category as $i => $item) {
                    $categories = [
                        [
                            'name'        => 'Murrah',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Surti',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Jaffrabadi',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Bhadawari',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Nili Ravi',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                    ];
                    SubCategory::insert($categories);
                }
            }
            else if ($categoryName->name == 'Sheep') {
                $category = Category::whereName('Sheep')->pluck('id');
                foreach ($category as $i => $item) {
                    $categories = [
                        [
                            'name'        => 'Mecheri',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Chennai red',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Ramanadhapuram white',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Keezhakaraisal',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Vembur',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                    ];
                    SubCategory::insert($categories);
                }
            }
            else if ($categoryName->name == 'Chicken') {
                $category = Category::whereName('Chicken')->pluck('id');
                foreach ($category as $i => $item) {
                    $categories = [
                        [
                            'name'        => 'Deshi',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Sonali',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                    ];
                    SubCategory::insert($categories);
                }
            }
            else if ($categoryName->name == 'Cow') {
                $category = Category::whereName('Cow')->pluck('id');
                foreach ($category as $i => $item) {
                    $categories = [
                        [
                            'name'        => 'Aberdeen Angus',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                        [
                            'name'        => 'Abondance',
                            'user_id'     => 1,
                            'category_id' => $item,
                            'created_at'  => now(),
                            'updated_at'  => now(),
                        ],
                    ];
                    SubCategory::insert($categories);
                }
            }
        }
    }
}
