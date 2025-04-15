<?php
declare(strict_types=1);
namespace App\Services;

return [
'connexion' => function(string $matricule, string $password, string $email, array $database): bool {
    $found = false;

    array_walk($database, function($users) use ($matricule, $password, $email, &$found) {
        array_walk($users, function($user) use ($matricule, $password, $email, &$found) {
            if (
                (
                    (isset($user['matricule']) && $user['matricule'] === $matricule) ||
                    (isset($user['gmail']) && $user['gmail'] === $email)
                ) &&
                (isset($user['password']) && $user['password'] === $password)
            ) {
                $found = true;
            }
        });
    });

    return $found;
}
]
?>