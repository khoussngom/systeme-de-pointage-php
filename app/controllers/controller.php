<?php
//factorise les fonctions communes a plusieurs controller
//il veut ici redirection ,render,savePhoto
declare(strict_types=1);

namespace App\Controllers;

require_once __DIR__ . "/../enums/Textes.php";
use App\MESS\Enums\Textes;
use Chemins;


function redirection(string $routes): void {
    header("Location:/" . $routes);
    exit;
}
function handleError(string $message): void {
    $_SESSION['error'] = $message;
    redirection("login");
}

return [
    'redirection' => 'App\Controllers\redirection',
    'handleError' => 'App\Controllers\handleError',
    'validateFields' => 'App\Controllers\validateFields',
    'login' => 'App\Controllers\login',
];