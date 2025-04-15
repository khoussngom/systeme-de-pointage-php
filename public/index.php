<?php
include __DIR__ ."/../app/enums/chemin.php";
session_start();
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST']);


require __DIR__ . Chemins::Routes->value;