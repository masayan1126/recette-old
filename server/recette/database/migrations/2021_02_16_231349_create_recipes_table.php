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
            ->nullable()
            ->comment('ユーザーテーブルへの外部キー')
            ->constrained('users') // 「複数形のテーブル名」
            ->onDelete('cascade');
            $table->string("recipe_name");
            $table->string("recipe_image")->nullable();
            $table->string("recipe_image_path")->nullable();
            // $table->string("inquiry_source_type")->nullable()->comment('問い合わせ元(購入者 or 写真館)');
            // $table->integer("progress_flag")->nullable()->comment('進捗(0：継続中 1：完了)');
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
