<?php 
include __DIR__ ."/../layout/base.layout.php";

return function ($data) {
    ob_start();
    $urlCss = "http://" . $_SERVER["HTTP_HOST"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= $urlCss . Chemins::CheminAssetCss->value ."/referentiel.css" ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Référentiels</title>

</head>
<div class="body">
    <div class="Container">
        <div class="Li1">
            <div class="titre-principal">Réferentiels</div>
            <div><p>Gérer les réferentiels de la promotion</p></div>
        </div>


        <div class="Cherche">
            <div class="search1">
                <form action="" method="get">
                    <input type="text" name="recherche" placeholder="Rechercher un referentiel">
                </form>
            </div>
            <div class="filtre1">
                <div class="icNite"><i class="fa-solid fa-book"></i></div>
                <div class="ai">Tous les réferentiels</div>
                
            </div>

            <div class="Gril">+ Ajouter à la promotion</div>
            
        </div>

        <div class="separateur"></div>

        <div class="liste-refs">
            <?php if(isset($data)): ?>
                
                <?php foreach ($data as $datas): ?>

                    <div class="item-ref">
                        <div class="containImage"><img src="<?= Chemins::CheminAssetImage->value . '/' . ($datas['PhotoRef'] ?? 'logo_odc.png') ?>" alt=""></div>
                        <div class="titre-ref"><?= htmlspecialchars($datas['Nom'])?></div>
                        <div class="nb-modeles"><?= htmlspecialchars($datas['NombresModule']).' '.'Module(s)'?></div>
                        <div class="desc-ref"><?= htmlspecialchars($datas['Description'])?></div>
                        <div class="Lvert"></div>
                        <div class="derL">
                            <div class="poin">
                                <span class="points1"></span>
                                <span class="points2"></span>
                                <span class="points3"></span>
                            </div>
                            <div class="nbrAp"><p><?= htmlspecialchars($datas['NombresApprenant']).' '.'Apprenants'?></p></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune promotion disponible.</p>
            <?php endif; ?>

            <!-- <div class="item-ref">
                <div class="containImage"><img src="" alt=""></div>
                <div class="titre-ref">Réferent digital</div>
                <div class="nb-modules">4 modules.</div>
                <div class="desc-ref">Contre-indices de synthétique, le référence digital pathique...</div>
                <div class="Lvert"></div>
                <div class="derL">
                    <div class="poin">
                        <span class="points1"></span>
                        <span class="points2"></span>
                        <span class="points3"></span>
                    </div>
                    <div class="nbrAp"><p>2 Apprenants</p></div>
                </div>

            </div>

            <div class="item-ref">
                <div class="containImage"><img src="" alt=""></div>
                <div class="titre-ref">Développement data</div>
                <div class="nb-modules">5 modules.</div>
                <div class="desc-ref">De manière de tracer à la date visualisateur, en passant par No...</div>
                <div class="Lvert"></div>
                <div class="derL">
                    <div class="poin">
                        <span class="points1"></span>
                        <span class="points2"></span>
                        <span class="points3"></span>
                    </div>
                    <div class="nbrAp"><p>2 Apprenants</p></div>
                </div>

            </div>

            <div class="item-ref">
                <div class="containImage"><img src="" alt=""></div>
                <div class="titre-ref">Référent Digital</div>
                <div class="nb-modules">1 module</div>
                <div class="desc-ref">La formation d'autonomie digitale résumée est garante que...</div>
                <div class="Lvert"></div>
                <div class="derL">
                    <div class="poin">
                        <span class="points1"></span>
                        <span class="points2"></span>
                        <span class="points3"></span>
                    </div>
                    <div class="nbrAp"><p>2 Apprenants</p></div>
                </div>

            </div>

            <div class="item-ref">
                <div class="containImage"><img src="" alt=""></div>
                <div class="titre-ref">AWS & DevOps</div>
                <div class="nb-modules">8 modules.</div>
                <div class="desc-ref">De l'énergie des besoins et monitoring de l'informatique, e...</div>
                <div class="Lvert"></div>
                <div class="derL">
                    <div class="poin">
                        <span class="points1"></span>
                        <span class="points2"></span>
                        <span class="points3"></span>
                    </div>
                    <div class="nbrAp"><p>2 Apprenants</p></div>
                </div>

            </div> -->
        </div>

        <div class="pied-page">
        
        </div>
    </div>
</div>
</html>
<?php
    return ob_get_clean(); 
}
?>
