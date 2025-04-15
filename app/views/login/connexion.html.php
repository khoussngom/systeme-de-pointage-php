<!DOCTYPE html>
<html lang="fr">
<?php
$url="http://".$_SERVER["HTTP_HOST"];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $url."/assets/css/login.css" ?>">
    <title>Document</title>
</head>
<body>
    <div class="container">

        <div class="entSonatel">
           <img src="<?= $url."/assets/images/logo_odc.png"?>" alt="logo sonatel">
         </div>
       
        <div class="mBienvenue">
            <h5>Bienvenue sur</h5>
            <h5 class="ECSA">Ecole du code Sonatel Academy</h5>
        </div>
        <div class="seConnecter">Se Connecter</div>
        <?php if(!empty($message["mes"])): ?>
          <div class="alert"><?= $message["mes"] ?></div>
        <?php endif; ?> 
            <form action="/login" method="post">
                <div class="login">
                    <label for="login">Login</label>
                   
                    <input type="text" class=" <?php if(empty($message["msgId"])): ?> entrer <?php else: ?>entrer alert<?php endif; ?>  " id="login" name="login" placeholder="<?php if(empty($message["msgId"])): ?>matricule ou email<?php else: ?><?= $message["msgId"] ?><?php endif; ?> ">
            
                </div>
                <div class="mdp">
                    <label for="password">Mot de passe</label>
               
                        <input type="password" class="<?php if(empty($message["msgP"])):?>entrer<?php else: ?>entrer alert<?php endif; ?>" id="password" name="password" placeholder="<?php if(empty($message["msgP"])): ?>mot de passe<?php else: ?><?= $message["msgP"] ?><?php endif; ?>" >
                </div>
                <div class="mdpOublie">
                    <a href="#">Mot de passe oublié ?</a>
                </div>
                <div class="bc">
                    <input class="btnSeConnecter" type="submit" value="Se connecter">
                </div>
            </form>
      
    </div>
</body>
</html>