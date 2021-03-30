<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id') // 「テーブル名の単数形」のスネークケース + '_id'
            ->comment('ユーザーテーブルへの外部キー')
            ->constrained('users') // 「複数形のテーブル名」
            ->onDelete('cascade');

            $table->string("recipe_name")->comment('レシピ名');
            $table->string("recipe_image_path")->comment('レシピ食材の画像ファイルパス');
            $table->json("recipe_procedure")->comment('レシピ作成手順');
            $table->string("recipe_category")->comment('レシピカテゴリー');
            $table->boolean("is_favorite")->comment('お気に入りレシピかどうか');

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
        Schema::dropIfExists('recipes');
    }
}
