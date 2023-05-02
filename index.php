<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */
use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ":");

/**
 * WEB ROUTES
 */
$route->namespace("Source\App");
$route->get("/", "Web:home");
$route->get("/sobre", "Web:about");

//blog
$route->group("/blog");
$route->get("/", "Web:blog");
$route->get("/p/{page}", "Web:blog");
$route->get("/{uri}", "Web:blogPost");
$route->post("/buscar", "Web:blogSearch");
$route->post("/buscar/{terms}/{page}", "Web:blogSearch");

//auth
$route->group(null);
$route->get("/entrar", "Web:login");
$route->get("/recuperar", "Web:forget");
$route->get("/cadastrar", "Web:register");

//optin
$route->get("/confirma", "Web:confirm");
$route->get("/obrigado", "Web:success");

//services
$route->get("/termos", "Web:terms");

/**
 * ERROR ROUTES
 */
$route->namespace("Source\App")->group("/ops");
$route->get("/{errcode}","Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()){
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();