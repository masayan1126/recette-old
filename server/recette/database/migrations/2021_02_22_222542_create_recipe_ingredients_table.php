<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->comment('ユーザーテーブルへの外部キー')
            ->constrained('users')
            ->onDelete('cascade');

            $table->foreignId('recipe_id')
            ->comment('レシピテーブルへの外部キー')
            ->constrained('recipes')
            ->onDelete('cascade');
            
            $table->string("ingredient_name")->comment('レシピ食材の名前')->nullable();
            $table->string("ingredient_category")->comment('レシピ食材のカテゴリー')->nullable();
            $table->string("ingredient_quantity")->comment('レシピ食材の数量')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_ingredients');
    }
}
