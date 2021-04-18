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
                'id' => 1,
                'user_id' => 1,
                'recipe_name' => "なすのモッツァレラトマトパスタ",
                'recipe_image_path' => "https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/30WtbmIc9kQ5eKGJizcrDLm6Ozjq4aWlge2Omfiu.jpg",
                'recipe_procedure' => '[
                    "なすは1cm厚さの輪切り、にんにくはみじん切り、モッツァレラチーズは1cm角、ベーコンは1cm幅に切る。",
                    "鍋に湯を沸かし、スパゲッティを袋の表示通りに茹で湯を切る。",
                    "フライパンにオリーブオイルを入れて熱し、にんにくを加え、香りがたつまで弱火で炒める、なすを加えトロトロになるまで中火で炒め皿に取り出す",
                    "同じフライパンでベーコンを入れ1分程炒め、☆、なすを加え3分ほど中火で炒める。",
                    "スパゲティ、モッツァレラチーズを加えて絡め、器に盛り付け、バジルをちらす。"
                ]',
                'recipe_category' => "麺類",
                'recipe_category_sub' => "noodle",
                'recipe_category_image' => "/images/category_noodle.jpeg",
                'is_favorite' => 1,
                'recipe_url' => null,
                'recipe_genre_index' => 2,
                'cooking_time_index' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'recipe_name' => "ニンニク香るガーリックライス",
                'recipe_image_path' => "https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/2wsYmEgZQ6jrPTusd8tMbwhQdZiFI4mIgVOuH8Vk.jpg",
                'recipe_procedure' => '[
                    "にんにくは薄切りにし、芯を取り除く。",
                    "牛肉は塩こしょうをふる。",
                    "フライパンにオリーブオイル、にんにくを入れて弱火で熱し、にんにくがきつね色になるまで加熱し、取り出す。",
                    "同じフライパンに牛肉を入れて熱し、肉の色が変わるまで中火で炒める。",
                    "ごはん、白いりごまを加えて全体がパラッとするまで炒め、☆を加えて炒め合わせる。",
                    "器に盛り、細ねぎをちらしてにんにくをのせる。"
                ]',
                'recipe_category' => "ご飯もの",
                'recipe_category_sub' => "rice",
                'recipe_category_image' => "/images/category_rice.jpeg",
                'is_favorite' => 1,
                'recipe_url' => null,
                'recipe_genre_index' => 2,
                'cooking_time_index' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'recipe_name' => "レタスとベーコンのペペロンチーノ",
                'recipe_image_path' => "https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/L54KfXCMXJcNSWdTF4r9RF3W5WorY5pbSOBwjOWJ.jpg",
                'recipe_procedure' => '[
                    "レタスは食べやすい大きさに切る。にんにくは縦半分に切って芯を取り除き、みじん切りにする。",
                    "ベーコンは1cm幅に切る。",
                    "鍋に湯をわかし、塩(分量外:適量)、スパゲティを入れて袋の表示時間より1分短くゆでる。レタスを加えてさらに30秒ゆでる。ゆで汁(大さじ2)を取り分け、水気を切る。",
                    "フライパンにオリーブオイル、ベーコン、にんにく、唐辛子を入れてベーコンが薄く色づくまで弱めの中火で炒める。ゆで汁を加えて白っぽくなるまで炒め合わせる。3のスパゲティ、レタスを加えて炒め、塩、こしょうを加えて炒め合わせる。"
                ]',
                'recipe_category' => "麺類",
                'recipe_category_sub' => "noodle",
                'recipe_category_image' => "/images/category_noodle.jpeg",
                'is_favorite' => 1,
                'recipe_url' => null,
                'recipe_genre_index' => 2,
                'cooking_time_index' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'recipe_name' => "和風ミートソース丼",
                'recipe_image_path' => "https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/x6c5aUgE6DpoARkLuaQ1yMiSg0qTGnF2GBUjHf94.jpg",
                'recipe_procedure' => '[
                    "玉ねぎはみじん切りにする。しいたけは根元を切り落とし、粗みじん切りにする。",
                    "半熟ゆで卵は横半分に切る。",
                    "耐熱容器に豚ひき肉、1、☆を入れて混ぜる。ふんわりとラップをし、600Wのレンジで3分加熱する。取り出して混ぜ、ラップをせずに600Wのレンジで3分加熱し、混ぜる。",
                    "器にごはんを盛り、3をかけ、半熟ゆで卵をのせる。"
                ]',
                'recipe_category' => "ご飯もの",
                'recipe_category_sub' => "rice",
                'recipe_category_image' => "/images/category_rice.jpeg",
                'is_favorite' => 1,
                'recipe_url' => null,
                'recipe_genre_index' => 1,
                'cooking_time_index' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'recipe_name' => "菜の花のガーリックスパゲティ",
                'recipe_image_path' => "https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/PSpzFkDytr4j0ffPywcjp3gNHbNkjUB9BecTCKXQ.jpg",
                'recipe_procedure' => '[
                    "大きめ鍋にスパゲティをゆでる湯を沸かしはじめる。菜の花は根元を切り、長さ3～4cmに切る。トマトはへたを取って4等分のくし形に切り、さらに横半分に切る。にんにくは横に薄切りにする。赤唐辛子はへたと種を取り除く。湯が沸いたらスパゲティを入れ、ゆではじめる。",
                    "フライパンにオリーブオイル大さじ2とにんにく、唐辛子を入れて中火にかけ、にんにくがかるく色づくまで炒める。菜の花を加えて炒め、油が回ったらトマトを入れて、しょうゆ小さじ1をふる。",
                    "スパゲティがゆで上がったら、ざるに上げて水けをきる。2のフライパンに入れて全体を手早く混ぜ、昆布茶、塩、こしょう各少々を加えて全体にからめる。（1人分532kcal、塩分2.0g）"
                ]',
                'recipe_category' => "麺類",
                'recipe_category_sub' => "noodle",
                'recipe_category_image' => "/images/category_noodle.jpeg",
                'is_favorite' => 1,
                'recipe_url' => null,
                'recipe_genre_index' => 2,
                'cooking_time_index' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'recipe_name' => "和風シーフードパスタ",
                'recipe_image_path' => "https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/6vlLOtvIrKWoynEKhjbFREggSD7zWyC7ZewvSQ05.jpg",
                'recipe_procedure' => '[
                    "大葉は軸を切り落とし、千切りにする。",
                    "シーフードミックスは解凍して水気を切る。",
                    "☆を入れて混ぜて煮立たせ、スパゲティを半分に折り入れて混ぜ、ふたする。時々混ぜながら弱火で袋の表示時間通りゆでる。ふたをとってさっと混ぜ、3、バターを加えて水分をとばしながら炒め合わせる。",
                    "器に盛り、大葉をのせる。"
                ]',
                'recipe_category' => "麺類",
                'recipe_category_sub' => "noodle",
                'recipe_category_image' => "/images/category_noodle.jpeg",
                'is_favorite' => 1,
                'recipe_url' => null,
                'recipe_genre_index' => 1,
                'cooking_time_index' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'recipe_name' => "新じゃがと豚肉のバターしょうゆソテー",
                'recipe_image_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/X7Bje4Bvp0alqXhmnROOFTaBhdorRmnWMzpmzlG7.jpg",
                'recipe_procedure' => '[
                    "豚肉は赤身と脂身の境目に、1～2cm間隔で包丁の刃先で切り目を入れ、筋を切る。塩小さじ1/4を全体にまぶし、手で表面を押さえてなじませ、一枚を4つに切る。じゃがいもはよく洗い、1つずつラップに包んで、電子レンジ（600W使用）で4分ほど加熱する。",
                    "取り出してそのままおき、粗熱が取れたら、皮つきのまま横に幅1cmに切る。スナップえんどうはへたと筋を取り、手で縦半分に割る。にんにくは横に薄切りにする。",
                    "フライパンにバター大さじ1、にんにくを入れて弱火で熱し、バターが溶けて、香りが立ってきたら中火にする。豚肉、じゃがいも、スナップえんどうを加え、ときどき返しながら、4～5分焼きつける",
                    "豚肉とじゃがいもにこんがりと焼き色がついたら、しょうゆ小さじ2、みりん小さじ1を加えてさっと混ぜ合わせ、器に盛る。"
                ]',
                'recipe_category' => "肉料理",
                'recipe_category_sub' => "meat",
                'recipe_category_image' => "/images/category_meat.jpeg",
                'is_favorite' => 1,
                'recipe_url' => null,
                'recipe_genre_index' => 4,
                'cooking_time_index' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'user_id' => 1,
                'recipe_name' => "新じゃがのポテトサラダ",
                'recipe_image_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/KW4ukdSUxBEDH1PbV4TOe0ambVMGjdXvVBFRXWZ0.jpg",
                'recipe_procedure' => '[
                    "じゃがいもはしっかり洗い、皮付きのまま鍋に入れ、かぶるくらいの水を注ぎ、中火にかける。",
                    "ゆでたじゃがいもは熱いうちに皮をむき、木べらを用いて固形感が残る程度にマッシュしたのち、粗熱をとる",
                    "玉ねぎは縦に薄く切り、にんじんはいちょう切りにする。耐熱皿にのせてラップをかけ、レンジ（500W）で約2分加熱する。加熱後玉ねぎは水気をしぼっておく。",
                    "きゅうりは輪切りにし、ハムは短冊切りにする",
                    "マッシュしたじゃがいもの粗熱がとれたら、玉ねぎ、にんじん、きゅうり、ハム、マヨネーズを加えて全体をよく和える。最後に塩・こしょうで味をととのえる"
                ]',
                'recipe_category' => "野菜料理",
                'recipe_category_sub' => "veg",
                'recipe_category_image' => "/images/category_veg.jpeg",
                'is_favorite' => 1,
                'recipe_url' => null,
                'recipe_genre_index' => 1,
                'cooking_time_index' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);




    }
}
