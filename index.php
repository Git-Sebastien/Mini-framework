<?php
// header( 'content-type: text/html; charset=utf-8' );
require './vendor/autoload.php';

require './app/config/config.php';
use Http\Router;
use Core\Database\Database;

$database = new Database();
$database->db_connect();
$router = new Router();
$router->get('home','HomeController','index')->name('home');
$router->get('posts','PostsController','index')->name('posts');
$router->get('comments','CommentsController','index')->name('comments');
$router->run();