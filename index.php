<?php

// Load
spl_autoload_register();
require "vendor/autoload.php";
session_start();

// Settings
$config = include "config.php";

// Constants
define("GET", "get");
define("POST", "post");
define("PATCH", "patch");
define("DELETE", "delete");

// Helpers
include "core/Helpers.php";
include "helpers.php";

// Init templates
$loader = new \Twig\Loader\FilesystemLoader('app/Views');
$twig = new \Twig\Environment($loader, [
    'cache' => 'storage/cache/views',
    "auto_reload" => true
]);

// Routing
$router = new \Bramus\Router\Router();
router()->setNamespace('\App\Controllers');

// Hook our routes
require "router.php";

// Set 404 page
router()->set404(function() {
    header('HTTP/1.1 404 Not Found');
    return view("static/404");
});

// Set static pages
route("/{path}", function($path) {
    if(empty($path)) $path = "index";
    if(!file_exists("app/Views/static/$path.html.twig")) return notFound();
    return view("static/$path");
});

// Init routing
router()->run();