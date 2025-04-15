<?php
declare(strict_types=1);

$model = include __DIR__.'/../models/model.php';
$controller = include __DIR__.'/../controllers/controller.php';


$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

match (true) {
    $request === '/login' && $method === 'GET' => include __DIR__.'/../views/login/connexion.html.php',

    $request === '/login' && $method === 'POST' => $controller['login'](
        id: $_POST['login'] ?? '',
        password: $_POST['password'] ?? ''
    ),

    $request === '/dashboard' && isset($_SESSION['user']) => include __DIR__.'/../views/acceuil/dashboard.html.php',

    default => include __DIR__.'/../views/login/connexion.html.php',
};
