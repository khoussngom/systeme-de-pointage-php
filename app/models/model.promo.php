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
            "etat"=>"inactive"
        ];
        return true;
    },
    'afficherAllPromo' => fn($database) => $database['Promotion'],

'chercherPromo' => function($database, $nomPromo) {
            $nomPromo = trim(strtolower($nomPromo));
            $promos = array_filter($database['Promotion'], function($promo) use ($nomPromo) {
                $matricule = trim(strtolower($promo['MatriculePromo']));
                return $matricule === $nomPromo;
            });
;
            return !empty($promos) ? array_values($promos)[0] : null;
        },



    'nbrFilieres' => function(array $database) {
    $filieres = array_map(function($promo) {
        return strtolower(trim($promo['filiere']));
    }, $database['Promotion']);

    $filieres = array_unique($filieres);

    return count($filieres);
},

    'nbrPromo'=>function(array $database) {
        $Promo = array_map(function($promo) {
            return $promo['MatriculePromo'];
    }, $database['Promotion']);

        return count($Promo);
    },

    'nbrAppr'=>function(array $database) {
       $appr= array_map(function($promo) {
            return $promo['matricule'];
        }, $database['Apprenant']);
        return count($appr);
    },
        


];
?>
