<?php
declare(strict_types=1);

use App\Controllers;

$promotionController = require __DIR__ . Chemins::PromoController->value;
$referentielController = require __DIR__ . Chemins::RefController->value;
$authController = require __DIR__ . Chemins::Controller->value;

$routes = [
    '/promotion' => function() use ($promotionController) {
        
        $recherche = $_GET['recherche'] ?? '';

        if (!empty($recherche)) {
            $promotionController['trouverPromo']($recherche);
        } else {
            $promotionController['affichageAllPromo']();
        }
    },


    '/promotion/liste' => function() use ($promotionController) {
        
        $promotionController['affichageListe']();
    },




    '/promotion/ajout' => function() use ($promotionController) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $promotionController['ajoutPromo'](
                $_POST['nomPromo'] ?? '',
                $_POST['dateDebut'] ?? '',
                $_POST['dateFin'] ?? '',
                $_FILES['photoPromo'] ?? [],
                $_POST['referentiel'] ?? ''
            );
        }
    },




    '/referentiels' => $referentielController['affichageRef'],

    '/referentiels/ajout' => function() use ($referentielController) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $referentielController['ajoutReferentiel'](
                $_POST['nomReferentiel'] ?? '',
                $_POST['description'] ?? '',
                $_FILES['photoReferentiel'] ?? []
            );
        }
    },

    '/login' => function() use ($authController) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
            $authController['login']($_POST);
        } else {
            include __DIR__ . Chemins::ViewLogin->value;
        }
    },

    '/logout' => function() use ($authController) {
        $authController['logout']();
    },

    '/MDP' => function() use ($authController) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController['changerPassword']($_POST);
        } else {
            include __DIR__ . Chemins::ChangePass->value;
        }
    },
];



$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (isset($routes[$path])) {
    $handler = $routes[$path];
    $handler();
} else {
    http_response_code(404);
    echo "Page non trouvée.";
}
