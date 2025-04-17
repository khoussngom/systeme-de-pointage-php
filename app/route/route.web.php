<?php
declare(strict_types=1);
namespace App\Route;
use Chemins;

$model = include __DIR__.Chemins::Model->value;
$controller = include __DIR__.Chemins::Controller->value;
$controllerPromo= include __DIR__.Chemins::PromoController->value;

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

match (true) {

    $request === '/login' && $method === 'GET' => include __DIR__.Chemins::ViewLogin->value,

    $request === '/layout' && $method === 'GET' => include __DIR__.Chemins::Layout->value,

    $request === '/promotion' && $method === 'GET' => 
    $controllerPromo['affichageAllPromo'](),

    $request === '/promotion' && $method === 'POST' =>
        $controllerPromo['ajoutPromo'](
            nomPromo:$_POST['nomPromo'] ?? '',
            dateDebut:$_POST['date_debut'] ?? '',
            dateFin:$_POST['date_fin'] ?? '',
            referentiel:$_POST['referentiel'] ??'',
            photoPromo: $_FILES['photo'] ?? null,
            ),

    
    $request === '/logout' && $method === 'POST'=> include __DIR__.Chemins::Logout->value,

    $request === '/login' && $method === 'POST' => $controller['login'](
        id: $_POST['login'] ?? '',
        password: $_POST['password'] ?? ''
    ),

    $request === '/dashboard' && isset($_SESSION['user']) => include __DIR__.Chemins::Dashboard->value,

    default => include __DIR__.Chemins::ViewLogin->value,
};
