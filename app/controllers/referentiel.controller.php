<?php
declare(strict_types=1);

namespace App\Controllers;


use Chemins;

$serviceRef = include __DIR__ . Chemins::ServiceRef->value;



function affichageRef(): void
{
    $donnee = include __DIR__ . Chemins::Model->value;
    $database = $donnee['database'];

    $serviceRef = include __DIR__ . Chemins::ServiceRef->value;
    $infoRef = $serviceRef['afficherAllRef']($database);

    $ref = include __DIR__ . Chemins::Referentiel->value;
    $layout = include __DIR__ . Chemins::Layout->value;

    echo $layout($ref($infoRef));
}


return [
    'affichageRef' => 'App\Controllers\affichageRef',
];
