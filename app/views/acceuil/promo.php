<?php 
include __DIR__ ."/../layout/base.layout.php";

$grillePromotion= function (){
    ob_start();
    $urlCss="http://".$_SERVER["HTTP_HOST"];
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $urlCss.Chemins::CheminAssetCss->value.'/Promo.css' ?>">

    <title>Promotion</title>
</head>
<div class="body">
    <div class="containerProm">
            <div class="Ligne1">
                <div class="gauche1">
                    <div class="Promo">Promotion</div>
                    <div class="gerProm">Gerer les promotions de l'école</div>      
                </div>
                <div class="droite1"><p> + Ajouter une promotions</p></div>
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
                <div class="cadreProm">
                        <div class="onOff">
                            <div class="off">Inactive</div>
                            <div class="on"><img src="<?=Chemins::CheminAssetImage->value.'/power-button.png'?>" alt=""></div>
                        </div>
                        <div class="infProm">
                            <div class="PhotPro"><img src="<?=Chemins::CheminAssetImage->value.'/imagesp7.jpeg'?>" alt=""></div>
                            <div class="infdate">
                                <div class="infb">Promotion 2025</div>
                                <div class="date1">04/02/2025 - 04/12/2025</div>
                            </div>
                        </div>
                        <div class="nbAppr"><i class="fa fa-user"></i> <span>2 apprenants</span></div>
                        <div class="trait"></div>
                        <div class="vDet"><span>voir details ></span></div>
                </div>
                <div class="cadreProm">
                        <div class="onOff">
                            <div class="off">Inactive</div>
                            <div class="on"><img src="<?=Chemins::CheminAssetImage->value.'/power-button.png'?>" alt=""></div>
                        </div>
                        <div class="infProm">
                            <div class="PhotPro"><img src="<?=Chemins::CheminAssetImage->value.'/imagesp7.jpeg'?>" alt=""></div>
                            <div class="infdate">
                                <div class="infb">Promotion 2025</div>
                                <div class="date1">04/02/2025 - 04/12/2025</div>
                            </div>
                        </div>
                        <div class="nbAppr"><i class="fa fa-user"></i> <span>2 apprenants</span></div>
                        <div class="trait"></div>
                        <div class="vDet"><span>voir details ></span></div>
                </div>
                <div class="cadreProm">
                        <div class="onOff">
                            <div class="off">Inactive</div>
                            <div class="on"><img src="<?=Chemins::CheminAssetImage->value.'/power-button.png'?>" alt=""></div>
                        </div>
                        <div class="infProm">
                            <div class="PhotPro"><img src="<?=Chemins::CheminAssetImage->value.'/imagesp7.jpeg'?>" alt=""></div>
                            <div class="infdate">
                                <div class="infb">Promotion 2025</div>
                                <div class="date1">04/02/2025 - 04/12/2025</div>
                            </div>
                        </div>
                        <div class="nbAppr"><i class="fa fa-user"></i> <span>2 apprenants</span></div>
                        <div class="trait"></div>
                        <div class="vDet"><span>voir details ></span></div>
                </div>
                <div class="cadreProm">
                        <div class="onOff">
                            <div class="off">Inactive</div>
                            <div class="on"><img src="<?=Chemins::CheminAssetImage->value.'/power-button.png'?>" alt=""></div>
                        </div>
                        <div class="infProm">
                            <div class="PhotPro"><img src="<?=Chemins::CheminAssetImage->value.'/imagesp7.jpeg'?>" alt=""></div>
                            <div class="infdate">
                                <div class="infb">Promotion 2025</div>
                                <div class="date1">04/02/2025 - 04/12/2025</div>
                            </div>
                        </div>
                        <div class="nbAppr"><i class="fa fa-user"></i> <span>2 apprenants</span></div>
                        <div class="trait"></div>
                        <div class="vDet"><span>voir details ></span></div>
                </div>
                <div class="cadreProm">
                        <div class="onOff">
                            <div class="off">Inactive</div>
                            <div class="on"><img src="<?=Chemins::CheminAssetImage->value.'/power-button.png'?>" alt=""></div>
                        </div>
                        <div class="infProm">
                            <div class="PhotPro"><img src="<?=Chemins::CheminAssetImage->value.'/imagesp7.jpeg'?>" alt=""></div>
                            <div class="infdate">
                                <div class="infb">Promotion 2025</div>
                                <div class="date1">04/02/2025 - 04/12/2025</div>
                            </div>
                        </div>
                        <div class="nbAppr"><i class="fa fa-user"></i> <span>2 apprenants</span></div>
                        <div class="trait"></div>
                        <div class="vDet"><span>voir details ></span></div>
                </div>
            </div>
    </div>
</div>
</html>
<?php
    return ob_get_clean(); 
}
?>

<?php echo $layout($grillePromotion()); ?>