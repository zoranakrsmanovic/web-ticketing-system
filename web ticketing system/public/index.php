<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AccessController;
use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\PostController;
use app\controllers\TicketingController;
use app\controllers\UserController;
use app\core\Application;

$app = new Application();

$app->router->get("/accessDenied", [AccessController::class, 'accessDenied']);
$app->router->get("/", [HomeController::class, 'dashboard']);
$app->router->get("/index", [HomeController::class, 'dashboard']);
$app->router->get("/home", [HomeController::class, 'dashboard']);
$app->router->get("/ticketEdit", [TicketingController::class, 'edit']);
$app->router->get("/ticketing", [TicketingController::class, 'home']);
$app->router->get("/ticketingJSON", [TicketingController::class, 'ticketingJSON']);
$app->router->get("/reports", [TicketingController::class, 'reports']);
$app->router->get("/ticketsByCategory", [TicketingController::class, 'ticketsByCategory']);
$app->router->get("/ticketCreate", [PostController::class, 'create']);
$app->router->get("/myTickets", [PostController::class, 'myTickets']);
$app->router->get("/postJSON", [PostController::class, 'postJSON']);
$app->router->get("/ticketDetails", [PostController::class, 'details']);
$app->router->get("/login", [AuthController::class, 'login']);
$app->router->get("/logout", [AuthController::class, 'logout']);
$app->router->get("/userCreate", [UserController::class, 'create']);
$app->router->post("/loginProcess", [AuthController::class, 'loginProcess']);
$app->router->post("/userCreateProcess", [UserController::class, 'userCreateProcess']);
$app->router->post("/ticketCreateProcess", [PostController::class, 'ticketCreateProcess']);
$app->router->post("/editProcess", [TicketingController::class, 'editProcess']);

$app->run();