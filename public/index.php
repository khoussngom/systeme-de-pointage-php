<?php

session_start();
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST']);


require __DIR__.'/../app/route/route.web.php';