<?php
declare(strict_types=1);
namespace App\Services;

return [
'connexion' => function(string $matricule, string $password, string $email, array $database): bool {
    $trouve = false;

    array_walk($database, function($users) use ($matricule, $password, $email, &$trouve) {
        array_walk($users, function($user) use ($matricule, $password, $email, &$trouve) {
            if (
                (
                    (isset($user['matricule']) && $user['matricule'] === $matricule) ||
                    (isset($user['gmail']) && $user['gmail'] === $email)
                ) &&
                (isset($user['password']) && $user['password'] === $password)
            ) {
                $trouve = true;
            }
        });
    });

    return $trouve;
},
'TrouverMail'=>function(string $email ,array $database ){
    $trouve = false;

    array_walk($database, function($users) use ($email, &$trouve) {
        array_walk($users, function($user) use ($email, &$trouve) {
            if (
                (
                    (isset($user['matricule']) && $user['matricule'] === $email) ||
                    (isset($user['gmail']) && $user['gmail'] === $email)
                )
            ) {
                $trouve = true;
            }
        });
    });

    return $trouve;
},

'ChangerPassword' => function(string $email, string $newPassword, array &$database): bool {
    $trouve = false;

    array_walk($database, function (&$users) use ($email, $newPassword, &$trouve) {
        array_walk($users, function (&$user) use ($email, $newPassword, &$trouve) {
            if (
                (isset($user['matricule']) && $user['matricule'] === $email) ||
                (isset($user['gmail']) && $user['gmail'] === $email)
            ) {
                $user['password'] = $newPassword;
                $trouve = true;
            }
        });
    });

    return $trouve;
},


]
?>