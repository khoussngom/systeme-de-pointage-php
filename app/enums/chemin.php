<?php
enum Chemins: string {
    case Dashboard = '/../views/acceuil/dashboard.php';
    case ViewLogin = '/../views/login/connexion.html.php';
    case Layout = '/../views/layout/base.layout.php';
    case Promotion = '/../views/acceuil/promo.php';
    case Logout = '/../views/login/logout.php';
    case Model     = '/../models/model.php';
    case Service  =  '/../services/connexion.service.php';
    case Controller= '/../controllers/controller.php';
    case Routes = '/../app/route/route.web.php';
    case DataJson = './../data/data.json';
    case CheminAssetCss = '/assets/css';
    case CheminAssetImage ='/assets/images';

}

?>