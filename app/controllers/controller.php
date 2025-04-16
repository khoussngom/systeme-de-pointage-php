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
            include __DIR__ . Chemins::Promotion->value;
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
            
            include __DIR__ . Chemins::ViewLogin->value;
        }
    },
];