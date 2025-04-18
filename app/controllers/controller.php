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

                'msgId' => 'Login Obligatoires',
                'msgP'  => 'Password Obligatoires',
            ];

            $message = array_filter($errors) ?: ['mes' => 'Login et Password obligatoires'];

            
            extract($message);
            
            include __DIR__ . Chemins::ViewLogin->value;
        }
    },
"changerPassword" => function(string $email, string $newPassword) use ($con, &$donnee): void {
    if (empty($email) || empty($newPassword)) {
        $_SESSION['error'] = "Tous les champs doivent être remplis.";
        header("Location:/MDP");
        exit;
    }

    if (!$con["TrouverMail"]($email, $donnee["database"])) {
        $_SESSION['error'] = "Email introuvable.";
        header("Location:/MDP");
        exit;
    }

    if ($con["ChangerPassword"]($email, $newPassword, $donnee["database"])) {
        $_SESSION['success'] = "Mot de passe changé avec succès.";
        file_put_contents(
            $donnee["databaseFile"],
            json_encode($donnee["database"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
        
        header("Location:/login"); 
        exit;
    } else {
        $_SESSION['error'] = "Erreur lors du changement du mot de passe.";
        header("Location:/MDP");
        exit;
    }
},


];