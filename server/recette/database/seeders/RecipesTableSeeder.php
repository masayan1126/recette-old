<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->insert([
            [
                'user_id' => 1,
                'recipe_name' => '菜の花＋ガーリックのスパゲティ',
                'recipe_image_path' => 'masa19931126',
                'recipe_procedure' => '1.弱火で・・・',
                'is_favorite' => 0,
              ],
        ]);
    }
}
