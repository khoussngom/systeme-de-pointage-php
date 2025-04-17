<?php
declare(strict_types=1);
namespace App\Controllers;

use Textes;

use Chemins;


$servicePromo = include __DIR__ . Chemins::ServicePromo->value;
$validator = include __DIR__ . Chemins::Validator->value;

return [
    "ajoutPromo" => function(string $nomPromo, string $dateDebut, string $dateFin, $photoPromo, string $referentiel) use($validator) :void 
    {
        $donnee = include __DIR__ . Chemins::Model->value; 
        $database = $donnee['database'];
        $databaseFile = $donnee['databaseFile'];

        session_start();
        require __DIR__ .'/../enums/messages.php';
        $message = [];
     
        if (empty($referentiel) || empty($nomPromo) || empty($dateDebut) || empty($dateFin) || empty($photoPromo['name'])) {
            $_SESSION['form_message'] = Textes::TLO->value;
            header("Location:/promotion#form-popup");
            exit;
        }
        
        if (!$validator['date_Valide']($dateDebut) || !$validator['date_Valide']($dateFin)) {
            $_SESSION['form_message'] = Textes::DatInv->value;
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
                $message = Textes::AjoutSuccess->value;
                header("Location:/promotion");
                exit;
            }
        }
    },

    "affichageAllPromo" => function() use ($servicePromo) {
        $donnee = include __DIR__ . Chemins::Model->value; 
        $database = $donnee['database'];
        $infoPromo = $servicePromo['afficherAllPromo']($database);
        $infoPromo['nbrRef']=$servicePromo['nbrFilieres'](database: $database);
        $infoPromo['nbrProm']=$servicePromo['nbrPromo'](database:$database);
        $infoPromo['nbrAppr']=$servicePromo['nbrAppr'](database:$database);
        $grillePromotion = include __DIR__ . Chemins::Promotion->value;
        $layout = include __DIR__ . Chemins::Layout->value;

        
        echo $layout($grillePromotion($infoPromo));
    }


];
