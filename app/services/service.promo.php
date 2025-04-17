<?php
return [
    'unicite' => function(array $database, string $nomPromo) {
        $unique = true;
        array_walk($database['Promotion'], function($promo) use ($nomPromo, &$unique) {
            if (isset($promo['MatriculePromo']) && $promo['MatriculePromo'] === $nomPromo) {
                $unique = false;
            }
        });
        return $unique;
    },
    'ajouterPromo' => function(array &$database, string $nomPromo, string $dateDebut, string $dateFin, string $referentiel, $photoPromo) {
        $database['Promotion'][] = [
            'MatriculePromo' => $nomPromo,
            'filiere' => $referentiel,
            'photoPromo' => $photoPromo,
            'debut' => $dateDebut,
            'fin' => $dateFin,
        ];
        return true;
    },
    'afficherAllPromo' => fn($database) => $database['Promotion'],

];
?>
