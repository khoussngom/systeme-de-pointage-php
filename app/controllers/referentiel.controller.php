<?php
declare(strict_types=1);
namespace App\Controllers;

use Textes;

use Chemins;


$serviceRef= include __DIR__ . Chemins::ServiceRef->value;
$validator = include __DIR__ . Chemins::Validator->value;

return [
"affichageRef" => function() use($serviceRef)  {
   
    $donnee = include __DIR__ . Chemins::Model->value; 
    $database = $donnee['database'];
    
    $infoRef= $serviceRef['afficherAllRef']($database);


    $ref = include __DIR__ . Chemins::Referentiel->value;
  
    $layout = include __DIR__ . Chemins::Layout->value;

    echo $layout($ref($infoRef));
}

];
