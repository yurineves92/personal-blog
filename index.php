<?php
session_start();
require_once 'config/database.php';
require_once 'app/Router.php';
require_once 'app/Controllers/HomeController.php';
require_once 'app/Controllers/AuthController.php';
require_once 'app/Controllers/PostController.php';
require_once 'app/Controllers/UserController.php';

$router = new Router();

// Rotas públicas
$router->get('/', 'HomeController@index');
$router->get('/post/{id}', 'PostController@show');
$router->get('/subscribe', 'HomeController@showSubscribe');
$router->post('/subscribe', 'HomeController@subscribe');

// Autenticação
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@showRegister');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

// Rotas protegidas
$router->get('/profile', 'UserController@profile');
$router->get('/add-post', 'PostController@create');
$router->post('/add-post', 'PostController@store');
$router->get('/edit-post/{id}', 'PostController@edit');
$router->post('/edit-post/{id}', 'PostController@update');
$router->post('/delete-post/{id}', 'PostController@delete');
$router->get('/subscribers', 'HomeController@subscribers');

// Executar rota
$router->run();
