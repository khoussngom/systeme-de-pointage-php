<?php
declare(strict_types=1);
namespace App\Controllers;

use Chemins;

$donnee = include __DIR__ . Chemins::Model->value;
$con = include __DIR__ . Chemins::Service->value;

function redirection(string $routes): void {
    header("Location:/" . $routes);
    exit;
}

function login(array $params, array $con, array &$donnee): void {
    $id = $params['id'] ?? '';
    $password = $params['password'] ?? '';

    if ($con["connexion"](matricule: $id, email: $id, password: $password, database: $donnee["database"])) {
        $_SESSION['user'] = [
            'id' => $id,
            'password' => $password,
        ];
        redirection("promotion");
    } else {
        $errors = [
            'msgId' => 'Login Obligatoires',
            'msgP'  => 'Password Obligatoires',
        ];

        // $message = array_filter($errors) ?: ['mes' => 'Login et Password obligatoires'];

        // extract($message);
        include __DIR__ . Chemins::ViewLogin->value;
    }
}

function changerPassword(array $params, array &$donnee, array $con): void {
    $email = $params['email'] ?? '';
    $newPassword = $params['newPassword'] ?? '';

    if (empty($email) || empty($newPassword)) {
        $_SESSION['error'] = "Tous les champs doivent être remplis.";
        redirection("MDP");
    }

    if (!$con["TrouverMail"]($email, $donnee["database"])) {
        $_SESSION['error'] = "Email introuvable.";
        redirection("MDP");
    }

    if ($con["ChangerPassword"]($email, $newPassword, $donnee["database"])) {
        $_SESSION['success'] = "Mot de passe changé avec succès.";
        file_put_contents(
            $donnee["databaseFile"],
            json_encode($donnee["database"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
        redirection("login");
    } else {
        $_SESSION['error'] = "Erreur lors du changement du mot de passe.";
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
