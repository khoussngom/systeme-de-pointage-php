<?php
declare(strict_types=1);
namespace App\Controllers;

use Chemins;


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
                'msgId' => empty($id) ? "login obligatoire" : null,
                'msgP'  => empty($password) ? "password obligatoire" : null,
            ];
            
            $message = array_filter($errors) ?: ['mes' => 'login ou mot de passe invalide'];
            
            extract($message);
            
            include __DIR__ . Chemins::ViewLogin->value;
        }
    },

];