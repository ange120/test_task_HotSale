<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\service\Router;

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

/**
 * Get
 */
Router::get('', 'DefaultController');

Router::get('info', 'DefaultController');
Router::get('login', 'DefaultController');
Router::get('registration', 'DefaultController');
Router::get('errorPage', 'DefaultController');

Router::get('logOut', 'SecurityController');
Router::get('afterLogin', 'BaseInfoController');



/**
 * Post
 */
Router::post('loginUser', 'SecurityController');
Router::post('registrationUser', 'SecurityController');


Router::run($path);

