<?php
declare(strict_types=1);

namespace App\Models;

use Chemins;

$databaseFile = __DIR__ . Chemins::DataJson->value;

$chargerDatabase = function (string $file): array {
    if (!file_exists($file)) {
        return [];
    }
    $json = file_get_contents($file);
    return json_decode($json, true) ?? [];
};

$saveDatabase = function (string $file, array $data): void {
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($file, $json);
};

$database = $loadDatabase($databaseFile);

return [
    "database" => $database,
    "databaseFile" => $databaseFile,
    "loadDatabase" => $chargerDatabase,
    "saveDatabase" => $saveDatabase,
];
