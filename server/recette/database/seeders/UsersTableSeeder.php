<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ↓モデルファクトリーを使用する場合
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'remember_token' => Str::random(10),
        //     'profile_photo_path' => "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/user.jpeg",
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);  
        
        DB::table('users')->insert([
            [
                'name' => 'まさやん',
                'email' => 'masa199311266@gmail.com',
                'email_verified_at' => now(),
                'password' => password_hash('masa19931126',PASSWORD_DEFAULT),
                'remember_token' => Str::random(10),
                'profile_photo_path' => 'https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/tCmMiif40rtHN43PY1D4j5QSzqOMzAHMqR791ktK.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
            'name' => 'おおさかたろう',
            'email' => 'matsushin@gmail.com',
            'email_verified_at' => now(),
            'password' => password_hash('mastsushin1126',PASSWORD_DEFAULT),
            'remember_token' => Str::random(10),
            'profile_photo_path' => 'https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/tCmMiif40rtHN43PY1D4j5QSzqOMzAHMqR791ktK.jpg',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        ]);  
    }
}
