<?php
declare(strict_types=1);
namespace App\Controllers;

$donnee= include(__DIR__ . "/../models/model.php");
$con=include(__DIR__ . "/../services/connexion.service.php");
$requete = $_SERVER["REQUEST_METHOD"];

return [
    "login" => function(string $id,string $password) use($con,$donnee): void  {
      
        if ($con["connexion"](matricule:$id,email:$id,password:$password,database:$donnee["database"])) {
            include __DIR__ . "/../views/acceuil/dashboard.php";
        } else {
            $message =[];
            if(empty($id))
            {
                $msgId="login obligatoire";
                $message["msgId"] = $msgId;
            }elseif(empty($password))
            {
                $msgP= "password obligatoire";
                $message["msgP"] = $msgP;
            }elseif (empty($id) && empty($password)) {
                $message = [
                    "msgId" => "login obligatoire",
                    "msgP" => "password obligatoire"
                ];

            }
            else{
                
            $msg="login ou mot de passe invalide";
            $message["mes"]=$msg;
            }
            extract($message);
            include __DIR__ . "/../views/login/connexion.html.php";
        }
    },
];