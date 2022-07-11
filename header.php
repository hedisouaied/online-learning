<?php 
include "connexion.php";


$req_about = "SELECT * FROM about WHERE ID = 1";
$exec_about = mysqli_query($conn, $req_about);
$array_about = mysqli_fetch_array($exec_about);


if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif(!empty($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
}else{
    $ip = "197.2.238.142";
}



//echo "<br>jhtjhgj" . $ip;
//$ip = '154.111.171.28';
$ip_data = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=" . $ip));

$result = $ip_data['geoplugin_timezone'];


if(!empty($result)){

//echo "<br>" . $result.'dfgfxg';
}else{
    
    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
$result = $details->timezone;

}
if(empty($result)){

$result = "Africa/Tunis";
}


//echo "<br>";

//date_default_timezone_set($result);
$origin_tz = "Africa/Tunis";
$remote_tz = $result;

$origin_dtz = new DateTimeZone($origin_tz);
$remote_dtz = new DateTimeZone($remote_tz);
$origin_dt = new DateTime("now", $origin_dtz);
$remote_dt = new DateTime("now", $remote_dtz);
$offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
//echo "<br>" . ($offset / 3600);
$reglo_time = ($offset / 3600);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:title"              content="SmarTTec" />
    <meta property="og:description"        content="SMARTTEC est une société de consulting, études et formations. Nous vous accompagnons de près pour le développement de vos compétences." />
    <meta property="og:image"              content="https://e-smarttec.com/uploads/sliders/1623162761_1620292547_executives-joking-laughing-office.jpg" />
    <title><?php
            if ((isset($pagetitle))) {
                echo $pagetitle;
            }
            ?></title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if (isset($enroll)) {

    ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <?php }
    ?>

    <?php
    if ((isset($pagetitle)) && ($pagetitle == "Calendrier des Formation en Direct")) {
    ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/fr.min.js" integrity="sha512-vz2hAYjYuxwqHQAgHPZvry+DTuwemFT/aBIDmgE0cnmYENu/+t8c3u/nX2Ont6e+3m+W6FEKxN1granjgGfr1Q==" crossorigin="anonymous"></script>
    <?php
    }
    ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/uploads/logo/smarttec.ico" type="image/x-icon">
    <link rel="icon" href="/uploads/logo/smarttec.ico" type="image/x-icon">

    <link rel="stylesheet" href="public/css/owl.carousel.min.css">
    <link rel="stylesheet" href="public/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <link rel="stylesheet" href="public/css/animate.css">
    <link rel="stylesheet" href="public/css/style.css">




    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">
    

    <!-- Preloader -->
    <link type="text/css" href="public/vendor/spinkit.css" rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="public/vendor/perfect-scrollbar.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="public/css/material-icons.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="public/css/fontawesome.css" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="public/css/preloader.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="public/css/app.css" rel="stylesheet">


    <link type="text/css" href="public/css/magnific-popup.css" rel="stylesheet">



    <link rel="stylesheet" href="public/css/moovie.min.css">

    <link rel="stylesheet" href="public/css/feedback.scss">






    <?php
    if ((isset($pagetitle)) && ($pagetitle == "Calendrier des Formation en Direct")) {
    ?>

        <script>
            $(document).ready(function() {
                var calendar = $('#calendar').fullCalendar({
                    monthNames: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
                    dayNames: ['Dimanche','Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                    dayNamesShort: ['Dim','Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
                    lang: 'fr',
                    editable: false,
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: ''
                    },
                    events: 'load.php?id_1=<?php echo $_GET['id_l']; ?>',
                    selectable: false,
                    selectHelper: false,
                });
            });
        </script>

        <style>
        
            .fc-day-grid-event .fc-time {
                display: none;

            }

            .fc-view-container *,
            .fc-view-container :after,
            .fc-view-container :before {
                color: #303840;
            }


            .fc-title {
                color: white;
                font-size: 1.3em;
                text-align: center;
            }

            .fc-row .fc-content-skeleton td.fc-event-container {
                background: #303840;
                padding: 10px;
                border: 1px solid white;
                border-radius: 10px;
            }

            .fc-event {
                border: none;
            }

            .fc-content {
                width: max-content;
                margin: auto;
            }
            
           
        </style>

    <?php
    }
    ?>
    <style>
         .modal-backdrop{
                display: none!important;
                
            }
        #default-drawer{
            z-index: 1000;
        }
    </style>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P6JE3WTLL2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-P6JE3WTLL2');
</script>
    
    
<?php
if(isset($_SESSION['client'])){
    ?>
    <style>
     
        
        .btn-new-ani {
        width: max-content;
        position: fixed;
        top: 80px;
        right: 2%;
        z-index: 9999;
        }
        
        .button-anim {
          min-width: 100px;
          min-height: 100px;
          font-family: 'Nunito', sans-serif;
          font-size: 12px;
          text-transform: uppercase;
          letter-spacing: 1.3px;
          font-weight: 700;
          color: #fff;
          background: #ed0b4c;
        background: linear-gradient(90deg, rgba(237, 11, 76,1) 0%, rgba(237, 11, 76,1) 100%);
          border: none;
          border-radius: 50%!important;
          box-shadow: 12px 12px 24px rgba(62, 84, 255,.84);
          transition: all 0.3s ease-in-out 0s;
          cursor: pointer;
          outline: none;
          position: relative;
          padding: 10px;
          }
        
        .button-anim::before {
        content: '';
          border-radius: 100%;
          min-width: calc(100px + 12px);
          min-height: calc(100px + 12px);
          border: 6px solid #ed0b4c;
          box-shadow: 0 0 60px rgba(62, 84, 255,.84);
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          opacity: 0;
          transition: all .3s ease-in-out 0s;
          
        }
        
        .button-anim:hover, .button-anim:focus {
          color: #fff;
          transform: translateY(-6px);
        }
        
        .button-anim:hover::before, .button-anim:focus::before {
          opacity: 1;
        }
        
        .button-anim::after {
          content: '';
          width: 30px; height: 30px;
          border-radius: 100%;
          border: 6px solid #ed0b4c;
          position: absolute;
          z-index: -1;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          animation: ring 1.5s infinite;
        }
        
        .button-anim:hover::after, .button-anim:focus::after {
          animation: none;
          display: none;
        }
        
        @keyframes ring {
          0% {
            width: 30px;
            height: 30px;
            opacity: 1;
          }
          100% {
            width: 150px;
            height: 150px;
            opacity: 0;
          }
        }
        </style>
<?php } ?>
<style>
    .serv_hover:hover{
        background: #003250!important;
        color: white!important;
        border-left: 4px solid #ed0b4c!important;
    }
    
    
</style>
<style>
    
     
    .box {
        animation-duration: 2s;
        animation-iteration-count: infinite;
        background-color: #ed0b4c;
       color:#fff;
        transform-origin: bottom;
        height:max-content;
        padding:0 3px;
        border-radius:2px;
        
    }
    .bounce-1 {
        animation-name: bounce-1;
        animation-timing-function: linear;
    }
    @keyframes bounce-1 {
        0%   { transform: translateY(4px); }
        50%  { transform: translateY(-8px); }
        
        100% { transform: translateY(4px); }
    }
 

</style>
</head>

<body class="layout-sticky-subnav layout-learnly ">

 <div class="preloader">

<div class="sk-bounce">
    <div class="sk-bounce-dot"></div>
    <div class="sk-swing-dot"></div>
    <div class="sk-swing-dot"></div>
    <div class="sk-bounce-dot"></div>
      
  </div> 
    </div>
    <?php
if(isset($_SESSION['client']) && $pagetitle!="Mes Cours"){
    
    ?>
<div class="btn-new-ani">
          <button class="button-anim" onclick="window.location.href='mescours.php'">Mes achats</button>
        </div>
        <?php } ?>
    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header" class="mdk-header js-mdk-header mb-0" data-fixed data-effects="waterfall" style="z-index: 999;">
            <div class="mdk-header__content">

                <div class="navbar navbar-expand navbar-light bg-white navbar-shadow" id="default-navbar" data-primary>
                    <div class="container page__container" style="max-width: 95%;">
                        <button class="navbar-toggler w-auto mr-16pt d-block rounded-0" type="button" data-toggle="sidebar">
                            <span class="material-icons">short_text</span>
                        </button>
                        <!-- Navbar Brand -->
                        <a href="index.php" class="navbar-brand mr-16pt">

                            <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">

                                <span style="background: white;width: 50px;" class="avatar-title rounded"><img src="uploads/logo/black.svg" alt="logo" class="img-fluid" /></span>

                            </span>

                            <span class="d-none d-lg-block">SmarTTec</span>
                        </a>

                        <!-- Navbar toggler -->

                        <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
                            <li class="nav-item active">
                                <a href="index.php" class="nav-link <?php if($pagetitle == "Accueil"){ echo 'accueil'; } ?>">Accueil</a>
                            </li>


                            <li class="nav-item dropdown active">
                                <a href="#" class="nav-link dropdown-toggle <?php if($pagetitle == "conseils"){ echo 'accueil'; } ?>" data-toggle="dropdown" data-caret="false">Nos Services</a>
                                <div class="dropdown-menu">
                                    <?php 
                                    $info = "SELECT * FROM services";
                                    $exec_info = mysqli_query($conn, $info);
                                    while ($array_info = mysqli_fetch_array($exec_info)) {
                                        if(!empty($array_info['Content']) ){
                                    ?>
                                    <a href="service.php?id=<?php echo $array_info['ID']; ?>" class="serv_hover dropdown-item <?php if(isset($service_rank)){ if($service_rank == $array_info['ID']){ echo 'active'; } } ?>"><?php echo $array_info['Name']; ?></a>
                                    <?php } } ?>
                                   
                                </div>
                            </li>
                            <li class="nav-item dropdown active">
                                <a href="#" class="nav-link dropdown-toggle <?php if(($pagetitle == "Formation en Direct")|| ($pagetitle == "Cours E-learning")){ echo 'accueil';} ?>" data-toggle="dropdown" data-caret="false">Nos formations</a>
                                <div class="dropdown-menu">
                                    <a href="direct.php" class="serv_hover dropdown-item <?php if($pagetitle == "Formation en Direct"){ echo 'active'; } ?>">En direct</a>
                                    <a href="cours.php" class="serv_hover dropdown-item <?php if($pagetitle == "Cours E-learning"){ echo 'active'; } ?>">E-learning</a>
                                      </div>
                            </li>
                           
                            <li class="nav-item active">
                                <a href="docs.php" class="nav-link <?php if($pagetitle == "Packs Documents"){ echo 'accueil'; } ?>">Nos packs</a>
                            </li>
                            <li class="nav-item active">
                                <a type="button" data-toggle="modal" data-target="#exampleModal" class="nav-link <?php if($pagetitle == "Certificate"){ echo 'accueil'; } ?>">Certificats</a>
                            </li>

                            </li>

                        </ul>

                        <form class="search-form form-control-rounded navbar-search d-none d-lg-flex mr-16pt" action="index.php#target_search" style="max-width: 230px">
                            <button class="btn" type="submit"><i class="material-icons">search</i></button>
                            <input type="text" class="form-control" name="search_all" placeholder="Rechercher ...">
                        </form>

                        <?php if (!isset($_SESSION['client'])) { ?>

                            <ul class="nav navbar-nav ml-auto mr-0">
                                <li class="nav-item" style="margin-left: 0.5rem;">
                                    <a href="login.php?location=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" style="width: 125px;" class="btn btn-outline-secondary">Se connecter</a>
                                </li>
                                <li class="nav-item" style="margin-left: 0.5rem;">
                                    <a href="signup.php" class="btn btn-outline-secondary" style="width: 125px;">Inscription</a>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <div class="nav-item dropdown">
                                <a href="panier.php" class="nav-link d-flex align-items-center">
                                    <span class="avatar avatar-sm mr-8pt2">

                                        <span class="avatar-title rounded-circle bg-primary" style="position: relative;">
                                            <i class="material-icons">shopping_cart</i>
                                            <span class="badge badge-notifications badge-accent" style="position: absolute;top: -6.5px;right: -10px;">
                                                <?php
                                                $req_pn = "SELECT * FROM `panier` WHERE ID_sess = " . $_SESSION['id'] . "  ";
                                                $exec_pn = mysqli_query($conn, $req_pn);
                                                $items_in_cart = mysqli_num_rows($exec_pn);
                                                echo $items_in_cart;
                                                ?>
                                            </span>
                                        </span>

                                </a>

                            </div>
                            <div class="nav navbar-nav ml-auto mr-0 flex-nowrap d-flex">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" data-caret="false">
                                        <?php
                                        if (!empty($_SESSION['photo'])) {


                                        ?>
                                            <span class="avatar avatar-sm mr-8pt2">
                                                <span class="avatar-title rounded-circle bg-primary"><img src="uploads/avatars/<?php echo $_SESSION['photo']; ?>" alt="people" style="width: 50px;height: 40px;padding: 0;max-width: 50px;" class="rounded-circle"></span>
                                            </span>
                                        <?php } else { ?>
                                            <span class="avatar avatar-sm mr-8pt2">
                                                <span class="avatar-title rounded-circle bg-primary"><img src="public/images/people/110/guy-3.jpg" alt="people" style="width: 50px;height: 40px;padding: 0;max-width: 50px;" class="rounded-circle"></span>
                                            </span>
                                        <?php } ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header"><strong><?php echo $_SESSION['name']; ?></strong></div>
                                        <a class="dropdown-item" href="modifier-profile.php">Informations</a>
                                        <a class="dropdown-item" href="mescours.php">Mes achats</a>
                                        <a class="dropdown-item" href="logout.php">Déconnexion</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>

        <!-- // END Header -->