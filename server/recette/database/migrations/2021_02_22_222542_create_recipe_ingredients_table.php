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
            $table->foreignId('user_id') // 「テーブル名の単数形」のスネークケース + '_id'
            ->nullable()
            ->comment('ユーザーテーブルへの外部キー')
            ->constrained('users') // 「複数形のテーブル名」
            ->onDelete('cascade');
            $table->foreignId('recipe_id') // 「テーブル名の単数形」のスネークケース + '_id'
            ->nullable()
            ->comment('レシピテーブルへの外部キー')
            ->constrained('recipes') // 「複数形のテーブル名」
            ->onDelete('cascade');
            $table->string("recipe_ingredient_name");
            $table->string("recipe_ingredient_image")->nullable();
            $table->string("recipe_ingredient_type")->nullable();
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
