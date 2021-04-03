<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecipeIngredient;
use Illuminate\Support\Facades\DB;

class RecipeIngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipe_ingredients')->insert([
            [
                'recipe_id' => 1000,
                'user_id' => 1,
                'recipe_ingredient_name' => "食材名1", 
                'recipe_ingredient_image_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png", 
                'recipe_ingredient_category' => "麺類",
            ],
            [
                'recipe_id' => 1000,
                'user_id' => 1,
                'recipe_ingredient_name' => "食材名2", 
                'recipe_ingredient_image_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png", 
                'recipe_ingredient_category' => "麺類",
            ],
        ]);
    }
}
