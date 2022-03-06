<?php

function get($name = null, $default = null) {
    if(!$name) return (object)$_GET;
    return $_GET[$name] ?? $default;
}

function post($name = null, $default = null) {
    if(!$name) return (object)$_POST;
    return $_POST[$name] ?? $default;
}

function view($path, $params = []) {
    echo $GLOBALS["twig"]->render($path . ".html.twig", $params);
}

function router(): \Bramus\Router\Router {
    return $GLOBALS["router"];
}

function route(...$params) {
    $type = GET;

    switch($params[0]) {
        case GET:
        case POST:
        case PATCH:
        case DELETE:
            $type = array_shift($params);
    }

    return router()->{$type}(...$params);
}

function redirect($url = "/", $code = null) {
    ob_clean();

    if($code) http_response_code($code);
    header("Location: $url");
}

function notFound() {
    ob_clean();
    
    return router()->trigger404();
}

function session(): Core\Session {
    return new Core\Session();
}

function db(string $sql, array $where = []): Core\SQL {
    return new Core\SQL(Core\DB::class, $sql, $where);
}

function config($key = null) {
    if(empty($key)) return (object)$GLOBALS["config"];
    return $GLOBALS["config"][$key] ?? null;

}
