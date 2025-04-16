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
}
]
?>