<?php
if (!isset($_SESSION['user'])) {
    header("Location: /login"); 
    exit();
}
?>

<?php 
$layout = function($contenu){
    ob_start();
include __DIR__ ."/../../enums/messages.php"; 

?>

<!DOCTYPE html>
<html lang="fr">
<?php
$path = "http://" . $_SERVER["HTTP_HOST"]
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $path .Chemins::CheminAssetCss->value."/layout.css"?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="logPRO">
                <div class="log">
                    <img src="<?= $url .Chemins::CheminAssetImage->value."/logo_odc.png"?>" alt="logo sonatel">
                </div>
                <div class="Prom">
                <h5>Promotion - 2025</h5>
                </div>
            </div>
        <div class="menu">
                <div class="trait"></div>
                <div class="Tb">
                        <div><i class="fa-solid fa-house"></i></div>
                <div>Tableau de bord</div>
                </div>
                <div class="Pr">
                    <div><i class="fa-regular fa-folder"></i></div>
                    <div>Promotions</div>
            </div>
            <div class="Ref">
                        <div><i class="fa-solid fa-book"></i></i></div>
                <div>Référentiels</div>
            </div>
            <div class="Ap">
                        <div><i class="fa-regular fa-user"></i></div>
                <div>Apprenants</div>
            </div>
            <div class="Ges">
                <div><i class="fa-solid fa-file"></i></div>
                <div>Gestion des présences</div>
            </div>
            <div class="ki">
                <div><i class="fa-solid fa-laptop"></i></div>
                <div>Kits & Laptops</div>
            </div>
            <div class="Ra">
                <div><i class="fa-solid fa-signal"></i></div>
                <div>Rapports & stats</div>
            </div>
        </div>
        <div class="saysay"></div>
        <div class="form">
            <form action="/logout" method="post">
                <button type="submit" class="decon"> <i class="fa-solid fa-right-from-bracket"></i>  Déconnexion</button>
            </form>
        </div>
    </div>

    <div class="droite">
        <div class="nav">
            <div class="cherche">
                <form action="">
                    <input type="search" placeholder="Rechercher">
                </form>
            </div>
            <div class="infUser">
                <div class="cloche"><i class="fa-regular fa-bell"></i></div>
                <div class="icPrenom">A</div>
                <div class="loginfo">
                    <div class="mail">admin@sonatel-academy.sn</div>
                    <div class="Admi">Administrateur</div>
                </div>
            </div>
        </div>
        <div class="variant">
             <?=  $contenu ?>
        </div>
    </div>
    </div>
</body>

</html>

<?php 
 return ob_get_clean();
};
?>