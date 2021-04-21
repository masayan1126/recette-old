<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->comment('ユーザーテーブルへの外部キー')
            ->constrained('users')
            ->onDelete('cascade');

            $table->string("ingredient_name")->comment('食材名');
            $table->string("ingredient_category")->comment('食材のカテゴリー')->nullable();
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
        Schema::dropIfExists('ingredients');
    }
}
