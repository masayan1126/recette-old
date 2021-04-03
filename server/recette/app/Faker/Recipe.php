<?php

namespace App\Faker;

use Illuminate\Support\Arr;

class Product extends \Faker\Provider\Base
{
    private $_recipes = [];

    public function recipe($parameters) {

        // if(empty($this->_recipes)) {

        //     $this->_recipes = $this->getRecipes($parameters);

        // }

        $data = [
            'user_id' => 1,
            'recipe_name' => '菜の花＋ガーリックのスパゲティ',
            'recipe_image_path' => 'masa19931126',
            'recipe_procedure' => '1.弱火で・・・',
            'is_favorite' => 0,
        ];

        return $data;

    }

    // private function getProducts($parameters) {

    //     $parameters['appid'] = env('YAHOO_APPID');
    //     $url = 'https://shopping.yahooapis.jp/ShoppingWebService/V1/json/itemSearch?'. http_build_query($parameters);
    //     $json = file_get_contents($url);
    //     $data = json_decode($json, true);

    //     $products = [];
    //     $total = intval($data['ResultSet']['totalResultsReturned']);

    //     for($i = 0 ; $i < $total ; $i++) {

    //         $product = $data['ResultSet'][0]['Result'][$i];

    //         $products[] = [
    //             'name' => $product['Name'],
    //             'code' => $product['Code'],
    //             'price' => $product['Price']['_value'],
    //         ];

    //     }

    //     return $products;

    // }
}