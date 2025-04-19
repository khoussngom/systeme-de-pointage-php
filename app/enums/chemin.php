<?php
enum Chemins: string {
    case Dashboard = '/../views/acceuil/dashboard.php';
    case PopupAjouter= '/../views/acceuil/popup.ajouter.php';
    case ViewLogin = '/../views/login/connexion.html.php';
    case ChangePass = '/../views/login/mdpOublie.html.php';

    case Layout = '/../views/layout/base.layout.php';
    case Promotion = '/../views/acceuil/promo.php';
    case PromotionListe= '/../views/acceuil/affichage_list.php';
    case Referentiel = '/../views/acceuil/referentiels.php';
    case Logout = '/../views/login/logout.php';
    case Model     = '/../models/model.php';
    case Service  =  '/../models/connexion.model.php';
    case ServicePromo  = '/../models/model.promo.php';
    case ServiceRef  =  '/../models/model.referentiel.php';
    case ControllerPrincipale= '/../controllers/controller.php';
    case Validator  =  '/../services/validator.service.php';
    case Controller= '/../controllers/login.controller.php';
    case RefController= '/../controllers/referentiel.controller.php';
    case PromoController= '/../controllers/promo.controller.php';
    case Routes = '/../app/route/route.web.php';
    case DataJson = './../data/data.json';
    case CheminAssetCss = '/assets/css';
    case CheminAssetImage ='/assets/images';

}

?>