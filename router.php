<?php

// Documentation: https://github.com/bramus/router#before-route-middlewares

route("/", function() {
    return view("index");
});

route("/cart", "CartController@view");