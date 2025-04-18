<?php
return [
    'ajouterRef' => function(array &$database, string $nomModule, int $nbrModule, string $desRef, int $nbrApr, $photoRef) {
        $database['Module'][] = [
            'Nom' => $nomModule,
            'NombresModule' => $nbrModule,
            'Description' => $desRef,
            'NombresApprenant' => $nbrApr,
            'photoRef' => $photoRef,
        ];
        return true;
    },
    'afficherAllRef' => fn($database) => $database['Referentiels'],

];
?>
