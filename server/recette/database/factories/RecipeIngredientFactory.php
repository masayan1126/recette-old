<?php

namespace Database\Factories;

use App\Models\RecipeIngredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeIngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecipeIngredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id' => 1,
            'recipe_ingredient_name' => $this->faker->word,
            'recipe_ingredient_image_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png",
            'recipe_ingredient_category' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
