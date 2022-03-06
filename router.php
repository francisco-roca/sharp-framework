<?php

// Documentation: https://github.com/bramus/router#before-route-middlewares

use Symfony\Contracts\Cache\ItemInterface;
use Core\Cache;
use Core\Validator;
use App\Models\User;

route("/", function() {

    $validation = Validator::validate(User::rules);

    $value = Cache::db()->get('my_cache_key', function (ItemInterface $item) {
        $item->expiresAfter(3600);
    
        $adjusted_close = "2.5938";

        $prices = db("SELECT * FROM price", [compact("adjusted_close")])->paginate(1)->first(); 
    
        return $prices;
    });

    echo "<pre>";
    // var_dump($prices);
    // var_dump($value);
    echo "</pre>";

});

// route("/home", fn() => redirect("/"));

// route("/cart", "CartController@cartView");
// route("/user/{id}/asd", "CartController@cartView");


