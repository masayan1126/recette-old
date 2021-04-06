<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // return [
    
        //     'recipe_name' => $this->faker->word,
        //     'recipe_image_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png",
        //     'recipe_procedure' => $this->faker->word,
        //     'recipe_category' => $this->faker->word,
        //     'recipe_category_sub' => $this->faker->word,
        //     'recipe_category_image' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png",
        //     'user_id' => 1,
        //     'is_favorite' => $this->faker->boolean,
        //     'created_at' => now(),
        //     'updated_at' => now(),
    
        // ];
  
    }
}
