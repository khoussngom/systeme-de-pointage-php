<?php
declare(strict_types=1);
namespace App\Controllers;

use Chemins;
use Textes;

$donnee = include __DIR__ . Chemins::Model->value;
$con=include __DIR__ . Chemins::Service->value;


$requete = $_SERVER["REQUEST_METHOD"];

return [
    "login" => function(string $id,string $password) use($con,$donnee): void  {
      
        if ($con["connexion"](matricule:$id,email:$id,password:$password,database:$donnee["database"])) {
            $_SESSION['user'] = [
                'id' => $id,
                'password' => $password,
            ];
            header("Location:/promotion");
            exit;
        } else {
            $message =[];
            $errors = [
                'msgId' => empty($id) ? Textes::LogObli->value : null,
                'msgP'  => empty($password) ? Textes::PasObli->value: null,
            ];
            
            $message = array_filter($errors) ?: ['mes' => Textes::LogPasInv->value];
            
            extract($message);
            
            include __DIR__ . Chemins::ViewLogin->value;
        }
    },

];