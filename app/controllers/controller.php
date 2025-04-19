<?php
declare(strict_types=1);
namespace App\Controllers;
require_once __DIR__ ."/../enums/Textes.php";
use App\MESS\Enums\Textes;
use Chemins;

$donnee = include __DIR__ . Chemins::Model->value;
$con = include __DIR__ . Chemins::Service->value;

function redirection(string $routes): void {
    header("Location:/" . $routes);
    exit;
}

function login(array $params, array $con, array &$donnee): void {
    $id = $params['login'] ?? '';   
    $password = $params['password'] ?? '';  

    if ($con["connexion"](matricule: $id, email: $id, password: $password, database: $donnee["database"])) {
        $_SESSION['user'] = [
            'id' => $id,
            'password' => $password,
        ];
        redirection("promotion");
    } else {
        $errors = [
            'msgId' => Textes::LogObli->value,
            'msgP'  => Textes::PasObli->value,
        ];
        include __DIR__ . Chemins::ViewLogin->value;
    }
}


function changerPassword(array $params, array &$donnee, array $con): void {
    $email = $params['email'] ?? '';
    $newPassword = $params['newPassword'] ?? '';

    if (empty($email) || empty($newPassword)) {
        $_SESSION['error'] = Textes::TLO->value;
        redirection("MDP");
    }

    if (!$con["TrouverMail"]($email, $donnee["database"])) {
        $_SESSION['error'] = Textes::EMAILINT->value;
        redirection("MDP");
    }

    if ($con["ChangerPassword"]($email, $newPassword, $donnee["database"])) {
        $_SESSION['success'] = Textes::ChangePassSUC->value;
        file_put_contents(
            $donnee["databaseFile"],
            json_encode($donnee["database"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
        redirection("login");
    } else {
        $_SESSION['error'] = Textes::ChangePassEr->value;;
        redirection("MDP");
    }
}


return [
    'login' => function(array $params) use ($con, &$donnee) {
        login($params, $con, $donnee);
    },
    'changerPassword' => function(array $params) use (&$donnee, $con) {
        changerPassword($params, $donnee, $con);
    },
];
