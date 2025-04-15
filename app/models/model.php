<?php
declare(strict_types=1);
namespace App\Models;
$BdD= file_get_contents(__DIR__."./../data/data.json");
$BdD= json_decode($BdD, true);
        
return [
    "database" =>$BdD
];