<?php
declare(strict_types=1);
namespace App\Controllers;

use Chemins;

$servicePromo = include __DIR__ . Chemins::ServicePromo->value;
$validator = include __DIR__ . Chemins::Validator->value;

function redirectionPromo(string $path): void {
 

    header("Location:/" . $path);
    exit;
}

function ajoutPromo(array $params, array $validator, array $servicePromo): void {
    $donnee = include __DIR__ . Chemins::Model->value;
    $database = &$donnee['database'];
    $databaseFile = $donnee['databaseFile'];

    session_start();
    require_once __DIR__ . '/../enums/messages.php';

    $nomPromo = $params['nomPromo'] ?? '';
    $dateDebut = $params['dateDebut'] ?? '';
    $dateFin = $params['dateFin'] ?? '';
    $referentiel = $params['referentiel'] ?? '';
    $photoPromo = $params['photoPromo'] ?? null;

    $erreurs = [
        (empty($referentiel) || empty($nomPromo) || empty($dateDebut) || empty($dateFin) || empty($photoPromo['name'])) => "Tous les champs sont obligatoire",
        (!$validator['date_Valide']($dateDebut) || !$validator['date_Valide']($dateFin)) => "Date invalide",
        (!$servicePromo['unicite']($database, $nomPromo)) => "Promo Existe",
    ];

    array_walk($erreurs, function($message, $condition) {
        if ($condition) {
            $_SESSION['form_message'] = $message;
            redirectionPromo("promotion#form-popup");
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
        $_SESSION['form_message'] = "ajouter avec success";
        redirectionPromo("promotion");
    }
}

function affichageAllPromo(array $servicePromo): void {
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
        'nbrRef' => $servicePromo['nbrFilieres']($database),
        'nbrProm' => $servicePromo['nbrPromo']($database),
        'nbrAppr' => $servicePromo['nbrAppr']($database),
    ];

    $grillePromotion = include __DIR__ . Chemins::Promotion->value;
    $layout = include __DIR__ . Chemins::Layout->value;

    echo $layout($grillePromotion($data));
}


return [
    'ajoutPromo' => function(array $params) use ($validator, $servicePromo) {
        ajoutPromo($params, $validator, $servicePromo);
    },
    'affichageAllPromo' => function() use ($servicePromo) {
        affichageAllPromo($servicePromo);
    },
];
