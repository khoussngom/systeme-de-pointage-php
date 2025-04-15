<?php
declare(strict_types=1);
namespace App\Models;

use Chemins;

$BdD= file_get_contents(__DIR__.Chemins::DataJson->value);
$BdD= json_decode($BdD, true);

return [
    "database" =>$BdD
];