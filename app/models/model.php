<?php
declare(strict_types=1);
namespace App\Models;

use Chemins;

$databaseFile = __DIR__ . Chemins::DataJson->value;

$database = json_decode(file_get_contents($databaseFile), true);

return [
    "database" => $database,
    "databaseFile" => $databaseFile  
];
//il veut ici json to array et array to json aussi file get content ,file put content