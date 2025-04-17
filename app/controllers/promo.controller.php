<?php
declare(strict_types=1);
namespace App\Controllers;

use Chemins;

$servicePromo = include __DIR__ . Chemins::ServicePromo->value;

return [
    "ajoutPromo" => function(string $nomPromo, string $dateDebut, string $dateFin, $photoPromo, string $referentiel): void 
    {
        $donnee = include __DIR__ . Chemins::Model->value; 
        $database = $donnee['database'];
        $databaseFile = $donnee['databaseFile'];

        $message = [];
        if (empty($referentiel) || empty($nomPromo) || empty($dateDebut) || empty($dateFin) || empty($photoPromo['name'])) {
            $message = "Tous les champs sont obligatoires";
            header("Location:/promotion#form-popup");
            exit; 
        }
       
        $rootPath = dirname(__DIR__, 2);


        $uploadDir = $rootPath . '/public'.Chemins::CheminAssetImage->value;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); 
        }
        
            $filename = basename($photoPromo['name']);
            move_uploaded_file($photoPromo['tmp_name'], $uploadDir .'/'. $filename);
            
            
            $photoPromoPath = '/' . $filename;
        
        $servicePromo = include __DIR__ . Chemins::ServicePromo->value; 
        if ($servicePromo['unicite'](database: $database, nomPromo: $nomPromo)) {
            if ($servicePromo['ajouterPromo']($database, $nomPromo, $dateDebut, $dateFin, $referentiel, $photoPromoPath)) {
                file_put_contents($databaseFile, json_encode($database, JSON_PRETTY_PRINT));
                $message = "Ajouté avec succès";
                header("Location:/promotion");
                exit;
            }
        }
    },

    "affichageAllPromo" => function() use ($servicePromo) {
        $donnee = include __DIR__ . Chemins::Model->value; 
        $database = $donnee['database'];
        $infoPromo = $servicePromo['afficherAllPromo']($database);

        $grillePromotion = include __DIR__ . Chemins::Promotion->value;
        $layout = include __DIR__ . Chemins::Layout->value;

        
        echo $layout($grillePromotion($infoPromo));
    }


];
