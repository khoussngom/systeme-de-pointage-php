<?php 
include __DIR__ ."/../layout/base.layout.php";

return function ($infoPromo) {
    ob_start();
    $urlCss = "http://" . $_SERVER["HTTP_HOST"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $urlCss . Chemins::CheminAssetCss->value . '/Promo.css' ?>">
    <title>Promotion</title>
</head>
<body>
<div class="body">
    <div class="containerProm">
        <div class="Ligne1">
            <div class="gauche1">
                <div class="Promo">Promotion</div>
                <div class="gerProm">Gérer les promotions de l'école</div>      
            </div>
            <div class="droite1">
                <a href="#form-popup"><p> + Ajouter une promotion</p></a>
            </div>
        </div>

        <div class="L2">
            <div class="stat1">
                <div class="col">
                    <div class="Cbold">0</div>
                    <div class="Ptext">Apprenant</div>
                </div>
                <div class="icNite"><i class="fa-solid fa-users"></i></div>
            </div>
            <div class="stat2">
                <div class="col">
                    <div class="Cbold">5</div>
                    <div class="Ptext">Référentiels</div>
                </div>
                <div class="icNite"><i class="fa-solid fa-book"></i></div>
            </div>
            <div class="stat3">
                <div class="col">
                    <div class="Cbold">1</div>
                    <div class="Ptext">Promotions Actives</div>
                </div>
                <div class="icNite"><i class="fa-solid fa-check"></i></div>
            </div>
            <div class="stat4">
                <div class="col">
                    <div class="Cbold">5</div>
                    <div class="Ptext">Total Promotions</div>
                </div>
                <div class="icNite"><i class="fa-solid fa-file"></i></div>
            </div>
        </div>

        <div class="Cherche">
            <div class="search1">
                <form action="" method="get">
                    <input type="text" name="recherche" placeholder="Rechercher">
                </form>
            </div>
            <div class="filtre1">
                <div>Tous</div>
                <div class="v">v</div>
            </div>
            <div class="Gril">Grille</div>
            <div class="Liste1">Liste</div>
        </div>
    <div class="listeProm">
        <?php if (!empty($infoPromo)): ?>
            <?php foreach ($infoPromo as $promo): ?>
                <div class="cadreProm">
                    <div class="onOff">
                        <div class="off"><?= htmlspecialchars($promo['etat'] ?? 'Inactive') ?></div>
                        <div class="on">
                            <img src="<?= Chemins::CheminAssetImage->value . '/power-button.png' ?>" alt="Power">
                        </div>
                    </div>
                    <div class="infProm">
                        <div class="PhotPro">
                            <img src="<?= Chemins::CheminAssetImage->value . '/' . ($promo['photoPromo'] ?? 'imagesp7.jpeg') ?>" alt="Photo Promo">
                        </div>
                        <div class="infdate">
                            <div class="infb"><?= htmlspecialchars($promo['MatriculePromo']) ?></div>
                            <div class="date1"><?= htmlspecialchars($promo['debut']) ?> - <?= htmlspecialchars($promo['fin']) ?></div>
                        </div>
                    </div>
                    <div class="nbAppr">
                        <i class="fa fa-user"></i> 
                        <span><?= htmlspecialchars($promo['nb_apprenants'] ?? '0') ?> apprenant(s)</span>
                    </div>
                    <div class="trait"></div>
                    <div class="vDet"><span>voir détails ></span></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune promotion disponible.</p>
        <?php endif; ?>
    </div>

    </div>
</div>

<a id="form-popup" class="overlay" href="#"></a>
<div class="popbi">
    <div class="popup">
        <h2>Créer une nouvelle promotion</h2>
        <form action="/promotion" method="post" enctype="multipart/form-data">
            <label for="nomPromo">Nom de la promotion</label>
            <input type="text" id="nom" name="nomPromo" placeholder="Ex: Promotion 2025">

            <label for="debut">Date de début</label>
            <input type="date" id="debut" name="date_debut">

            <label for="fin">Date de fin</label>
            <input type="date" id="fin" name="date_fin">

            <label for="photo">Photo de la promotion</label>
            <input type="file" id="photo" name="photo" accept="image/*">
            <div class="info-photo">Format JPG, PNG. Taille max 2MB</div>

            <label for="referentiel">Référentiels</label>
            <input type="search" id="referentiel" name="referentiel" placeholder="Rechercher un référentiel...">

            <div class="actions">
                <a href="#"><button type="button" class="cancel">Annuler</button></a>
                <button type="submit" class="submit">Créer la promotion</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php
    return ob_get_clean(); 
}
?>
