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

    $servicePromo = include __DIR__ . Chemins::ServicePromo->value;

    $erreurs = [
        (empty($referentiel) || empty($nomPromo) || empty($dateDebut) || empty($dateFin) || empty($photoPromo['name'])) => Textes::TLO->value,
        (!$validator['date_Valide']($dateDebut) || !$validator['date_Valide']($dateFin)) => Textes::DatInv->value,
        (!$servicePromo['unicite'](database: $database, nomPromo: $nomPromo)) => Textes::PromoExiste->value,
    ];

    array_walk($erreurs, function($message, $condition) {
        if ($condition) {
            $_SESSION['form_message'] = $message;
            header("Location:/promotion#form-popup");
            session_unset();
            exit;
        }
    });


    $rootPath = dirname(__DIR__, 2);
    $uploadDir = $rootPath . '/public' . Chemins::CheminAssetImage->value;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); 
    }

    $filename = basename($photoPromo['name']);
    move_uploaded_file($photoPromo['tmp_name'], $uploadDir . '/' . $filename);
    $photoPromoPath = '/' . $filename;

   
    if ($servicePromo['ajouterPromo']($database, $nomPromo, $dateDebut, $dateFin, $referentiel, $photoPromoPath)) {
        file_put_contents($databaseFile, json_encode($database, JSON_PRETTY_PRINT));
        $_SESSION['form_message'] = Textes::AjoutSuccess->value;
        header("Location:/promotion");
        session_unset();
        exit;
    }
},

"affichageAllPromo" => function() use ($servicePromo) {
    $donnee = include __DIR__ . Chemins::Model->value; 
    $database = $donnee['database'];
    
    $infoPromo = $servicePromo['afficherAllPromo']($database);

  
    $promotions = array_filter($infoPromo, function($promo) {
        return 
            isset($promo['MatriculePromo'], $promo['filiere'], $promo['photoPromo'], $promo['debut'], $promo['fin']) &&
            !empty($promo['MatriculePromo']) && !empty($promo['filiere']) && !empty($promo['photoPromo']) && !empty($promo['debut']) && !empty($promo['fin']);
    });


    $data = [
        'Promotion' => array_values($promotions),       
        'nbrRef' => $servicePromo['nbrFilieres'](database: $database),
        'nbrProm' => $servicePromo['nbrPromo'](database: $database),
        'nbrAppr' => $servicePromo['nbrAppr'](database: $database),
    ];

    $grillePromotion = include __DIR__ . Chemins::Promotion->value;
    $layout = include __DIR__ . Chemins::Layout->value;

    echo $layout($grillePromotion($data));
}




];
