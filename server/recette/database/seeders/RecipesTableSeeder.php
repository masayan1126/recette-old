<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Recipe;
use App\Models\RecipeIngredient;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ↓モデルファクトリーを使用する場合
        // Recipe::factory()->count(1)->create()->each(function($recipe) {
        //     RecipeIngredient::factory()->count(3)->create(['recipe_id' => $recipe->id]);
        // });

        DB::table('recipes')->insert([
            [
                'id' => 1000,
                'user_id' => 1,
                'recipe_name' => "ガーリックライス",
                'recipe_image_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png",
                'recipe_procedure' => '["a"]',
                'recipe_category' => "麺類",
                'recipe_category_sub' => "noodlle",
                'recipe_category_image' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png",
                'is_favorite' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 1001,
                'user_id' => 1,
                'recipe_name' => "オムライス",
                'recipe_image_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png",
                'recipe_procedure' => '["a"]',
                'recipe_category' => "麺類",
                'recipe_category_sub' => "noodlle",
                'recipe_category_image' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png",
                'is_favorite' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        
        ]);




    }
}
