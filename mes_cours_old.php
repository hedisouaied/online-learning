<?php
ob_start();
$pagetitle = "Mes Cours";
include 'header.php';
if (!isset($_SESSION['client'])) {
    header('location:index.php');
}


?>
<?php

function thmx_currency_convert($amount)
{
    $url = 'https://api.exchangerate-api.com/v4/latest/USD';
    $json = file_get_contents($url);

    $convert = $exp->rates->TND;

    return $convert * $amount;
}

$amount = $prix_tot * 1000;

$convert_taux = thmx_currency_convert(1);

if($convert_taux == 0 ){ $convert_taux = 2.7; }

$NumSite = 'MAR774';
$Password = 'oh$jwI63';

$Devise = 'USD';
$orderId = date('ymdHis');



$fullname = $_SESSION['name'];
$fullname_exp = explode(" ", $fullname);
$nom = $fullname_exp[0];
$prenom = $fullname_exp[1];

$email = $_SESSION['email'];
$country = $_SESSION['country'];
$phone = $_SESSION['phone'];


?>
<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                    <h1 class="h2 mb-8pt">Mes achats</h1>
                </div>
                <div class="ml-lg-16pt">
                    <a href="index.php" class="btn btn-light">Retour à l'accueil</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $req_mc = "SELECT * FROM checkout WHERE type_p = 'E-learning' AND ID_sess = " . $_SESSION['id'] . " ORDER BY ID DESC LIMIT 1";
                    $exec_mc = mysqli_query($conn, $req_mc);
                    $check_mc = mysqli_num_rows($exec_mc);
                    $array_mc = mysqli_fetch_array($exec_mc);
                    if ($check_mc !== 0) {

                        $req_fetch = "SELECT * FROM cours WHERE ID_c = " . $array_mc['ID_p'] . " LIMIT 1";
                        $exec_fetch = mysqli_query($conn, $req_fetch);
                        $array_fetch = mysqli_fetch_array($exec_fetch);
                    ?>
                        <div class="page-separator">
                            <div class="page-separator__text">Dernier achat E-learning</div>
                        </div>

                        <div class="card">
                            <img src="uploads/cours/img/<?php echo $array_fetch['Image']; ?>" alt="TypeScript" class="card-img" style="max-height: 100%; width: initial;">
                            <div class="fullbleed" style="opacity: .5;"></div>
                            <div class="card-body d-flex align-items-center justify-content-center fullbleed">
                                <div style="background: rgba(85, 103,255,0.7);padding: 10px;">
                                    <h2 class="text-white mb-16pt"><?php echo $array_fetch['Name_c']; ?></h2>
                                    <div class="d-flex align-items-center mb-16pt justify-content-center">
                                        <div  class="d-flex align-items-center mr-16pt">
                                            <span class="material-icons icon-16pt text-white-50 mr-4pt" style="color: white!important;">access_time</span>
                                            <p style="color: white!important;"class="flex text-white-50 lh-1 mb-0"><?php
                                                                                    $req_v = "SELECT * FROM `lesson` WHERE cours_id = " . $array_fetch['ID_c'] . " ";
                                                                                    $exec_v = mysqli_query($conn, $req_v);
                                                                                    $hours = 0;
                                                                                    while ($array_v = mysqli_fetch_array($exec_v)) {
                                                                                        $hours = $hours + $array_v['duration'];
                                                                                    }
                                                                                    echo ceil($hours / 60);


                                                                                    ?> heures</p>
                                        </div>
                                        <div class="d-flex align-items-center">s
                                            <span class="material-icons icon-16pt text-white-50 mr-4pt" style="color: white!important;">play_circle_outline</span>
                                            <p style="color: white!important;" class="flex text-white-50 lh-1 mb-0"><?php
                                                                                    $req_l = "SELECT * FROM `lesson` WHERE cours_id = " . $array_fetch['ID_c'] . " ";
                                                                                    $exec_l = mysqli_query($conn, $req_l);
                                                                                    $lessons = mysqli_num_rows($exec_l);
                                                                                    echo $lessons;
                                                                                    ?> leçons</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <?php
                                        $req_step = "SELECT * FROM steps WHERE ID_checkout = " . $array_mc['ID'] . " ";
                                        $exec_step = mysqli_query($conn, $req_step);
                                        $array_step = mysqli_fetch_array($exec_step);
                                        ?>
                                        <a href="ch/index.php?id_c=<?php echo $array_fetch['ID_c']; ?>&step=<?php echo $array_step['Steps'] ?>" class="btn btn-white mr-8pt">
                                            <?php
                                            if ($array_step['Steps'] == 0) {
                                                echo "Commencer";
                                            } else {
                                                echo "Reprendre";
                                            }
                                            ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-start mb-32pt">
                            <div class="d-flex align-items-center mr-24pt">
                                <a class="mr-12pt">
                                    <img src="uploads/cours/img/<?php echo $array_fetch['Image']; ?>" width="60" alt="Angular" class="rounded">
                                </a>
                                <div class="flex">
                                    <a class="card-title"><?php echo $array_fetch['Name_c']; ?></a>
                                    <p class="lh-1 mb-0">
                                        <span class="text-50 small">avec</span>
                                        <span class="text-50 small">SmarTTec</span>
                                    </p>
                                </div>
                            </div>
                            <?php
                            $req_rev = "SELECT * FROM review_table WHERE cours_ID = " . $array_fetch['ID_c'] . " AND Type_c = 'E-learning' ";
                            $exec_rev = mysqli_query($conn, $req_rev);
                            $count_rev = mysqli_num_rows($exec_rev);
                            if ($count_rev !== 0) {
                                $total = 0;
                                while ($c_total = mysqli_fetch_array($exec_rev)) {
                                    $total = $total + $c_total['user_rating'];
                                }
                                $moyen_t = $total / $count_rev;

                                $st_1 = floor($moyen_t);
                                $st_2 = 5 - $st_1;

                            ?>
                                <div class="d-flex align-items-center py-4pt" style="white-space: nowrap;">
                                    <div class="rating mr-8pt">
                                        <?php
                                        if ($st_1 !== 0) {
                                            for ($s = 1; $s <= $st_1; $s++) {
                                        ?>
                                                <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                                        <?php }
                                        } ?>
                                        <?php

                                        if ($st_2 !== 0) {
                                            for ($s = 1; $s <= $st_2; $s++) {
                                        ?>


                                                <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                                        <?php }
                                        } ?>
                                    </div>
                                    <small class="text-50"><?php echo $st_1; ?>/5</small>
                                </div>
                            <?php } ?>
                        </div>
                    <?php
                    }
                    ?>


                    <?php
                    $req_bc = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " AND type_p = 'E-learning' ";
                    $exec_bc = mysqli_query($conn, $req_bc);
                    $check_bc = mysqli_num_rows($exec_bc);
                    if ($check_bc !== 0) {
                    ?>
                        <div class="page-separator">
                            <div class="page-separator__text">Mes cours E-learning</div>
                        </div>

                        <div class="row card-group-row">
                            <?php

                            while ($array_bc = mysqli_fetch_array($exec_bc)) {

                                $req_el = "SELECT * FROM cours WHERE ID_c = " . $array_bc['ID_p'] . " ";
                                $exec_el = mysqli_query($conn, $req_el);
                                $array_el = mysqli_fetch_array($exec_el);


                            ?>


                                <div class="col-sm-6 col-xl-4 card-group-row__col">

                                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card undefined" data-toggle="popover" data-trigger="click">

                                        <a href="" class="card-img-top js-image" data-position="" data-height="140">
                                            <img src="uploads/cours/img/<?php echo $array_el['Image']; ?>" alt="course">
                                            <span class="overlay__content">
                                                <span class="overlay__action d-flex flex-column text-center">
                                                    <i class="material-icons icon-32pt">play_circle_outline</i>
                                                    <span class="card-title text-white"><?php echo $array_el['Name_c']; ?></span>
                                                </span>
                                            </span>
                                        </a>

                                        <div class="card-body flex">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"><?php echo $array_el['Name_c']; ?></a>
                                                    <small class="text-50 font-weight-bold mb-4pt">SmarTTec</small>
                                                </div>
                                            </div>
                                            <?php
                                            $req_rev = "SELECT * FROM review_table WHERE cours_ID = " . $array_el['ID_c'] . " AND Type_c = 'E-learning' ";
                                            $exec_rev = mysqli_query($conn, $req_rev);
                                            $count_rev = mysqli_num_rows($exec_rev);
                                            if ($count_rev !== 0) {
                                                $total = 0;
                                                while ($c_total = mysqli_fetch_array($exec_rev)) {
                                                    $total = $total + $c_total['user_rating'];
                                                }
                                                $moyen_t = $total / $count_rev;

                                                $st_1 = floor($moyen_t);
                                                $st_2 = 5 - $st_1;

                                            ?>
                                                <div class="d-flex">
                                                    <div class="rating flex">
                                                        <?php
                                                        if ($st_1 !== 0) {
                                                            for ($s = 1; $s <= $st_1; $s++) {
                                                        ?>
                                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                        <?php }
                                                        } ?>
                                                        <?php

                                                        if ($st_2 !== 0) {
                                                            for ($s = 1; $s <= $st_2; $s++) {
                                                        ?>


                                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                    <small class="text-50"><?php echo $st_1; ?>/5</small>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row justify-content-between">
                                                <div class="col-auto d-flex align-items-center">
                                                    <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small>
                                                            <?php
                                                            $req_v = "SELECT * FROM `lesson` WHERE cours_id = " . $array_el['ID_c'] . " ";
                                                            $exec_v = mysqli_query($conn, $req_v);
                                                            $hours = 0;
                                                            while ($array_v = mysqli_fetch_array($exec_v)) {
                                                                $hours = $hours + $array_v['duration'];
                                                            }
                                                            echo ceil($hours / 60);


                                                            ?> heures</small></p>
                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                    <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                                $req_l = "SELECT * FROM `lesson` WHERE cours_id = " . $array_el['ID_c'] . " ";
                                                                                                $exec_l = mysqli_query($conn, $req_l);
                                                                                                $lessons = mysqli_num_rows($exec_l);
                                                                                                echo $lessons;
                                                                                                ?> leçons</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="popoverContainer d-none">
                                        <div class="media">
                                            <div class="media-left mr-12pt">
                                                <img src="uploads/cours/img/<?php echo $array_el['Image']; ?>" width="40" height="40" alt="Angular" class="rounded">
                                            </div>
                                            <div class="media-body">
                                                <div class="card-title mb-0"><?php echo $array_el['Name_c']; ?></div>
                                                <p class="lh-1 mb-0">
                                                    <span class="text-50 small">avec</span>
                                                    <span class="text-50 small font-weight-bold">SmarTTec</span>
                                                </p>
                                            </div>
                                        </div>

                                        <p class="my-16pt text-70"><?php echo substr($array_el['Desc_c'], 0, 250) . "..."; ?></p>

                                        <div class="mb-16pt">
                                            <?php
                                            $str = $array_el['whatyou'];
                                            $arr = explode(",", $str);
                                            for ($i = 0; $i < count($arr); $i++) {
                                            ?>
                                                <div class="d-flex align-items-center">
                                                    <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small><?php echo $arr[$i]; ?></small></p>
                                                </div>
                                            <?php   } ?>
                                        </div>

                                        <div class="my-32pt">
                                            <div class="d-flex align-items-center mb-8pt justify-content-center">
                                                <div class="d-flex align-items-center mr-8pt">
                                                    <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                                $req_v = "SELECT * FROM `lesson` WHERE cours_id = " . $array_el['ID_c'] . " ";
                                                                                                $exec_v = mysqli_query($conn, $req_v);
                                                                                                $hours = 0;
                                                                                                while ($array_v = mysqli_fetch_array($exec_v)) {
                                                                                                    $hours = $hours + $array_v['duration'];
                                                                                                }
                                                                                                echo ceil($hours / 60);


                                                                                                ?> heures</small></p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                                $req_l = "SELECT * FROM `lesson` WHERE cours_id = " . $array_el['ID_c'] . " ";
                                                                                                $exec_l = mysqli_query($conn, $req_l);
                                                                                                $lessons = mysqli_num_rows($exec_l);
                                                                                                echo $lessons;
                                                                                                ?> leçons</small></p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <?php
                                                $req_step = "SELECT * FROM steps WHERE ID_checkout = " . $array_bc['ID'] . " ";
                                                $exec_step = mysqli_query($conn, $req_step);
                                                $array_step = mysqli_fetch_array($exec_step);
                                                ?>
                                                <a href="ch/index.php?id_c=<?php echo $array_el['ID_c']; ?>&step=<?php echo $array_step['Steps'] ?>" class="btn btn-primary mr-8pt">
                                                    <?php
                                                    if ($array_step['Steps'] == 0) {
                                                        echo "Commencer";
                                                    } else {
                                                        echo "Reprendre";
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                        </div>

                                        <?php
                                        $req_rev = "SELECT * FROM review_table WHERE cours_ID = " . $array_el['ID_c'] . " AND Type_c = 'E-learning' ";
                                        $exec_rev = mysqli_query($conn, $req_rev);
                                        $count_rev = mysqli_num_rows($exec_rev);
                                        if ($count_rev !== 0) {
                                            $total = 0;
                                            while ($c_total = mysqli_fetch_array($exec_rev)) {
                                                $total = $total + $c_total['user_rating'];
                                            }
                                            $moyen_t = $total / $count_rev;

                                            $st_1 = floor($moyen_t);
                                            $st_2 = 5 - $st_1;

                                        ?>
                                            <div class="d-flex align-items-center py-4pt" style="white-space: nowrap;">
                                                <div class="rating mr-8pt">
                                                    <?php
                                                    if ($st_1 !== 0) {
                                                        for ($s = 1; $s <= $st_1; $s++) {
                                                    ?>
                                                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                                                    <?php }
                                                    } ?>
                                                    <?php

                                                    if ($st_2 !== 0) {
                                                        for ($s = 1; $s <= $st_2; $s++) {
                                                    ?>


                                                            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                                                    <?php }
                                                    } ?>
                                                </div>
                                                <small class="text-50"><?php echo $st_1; ?>/5</small>
                                            </div>
                                        <?php } ?>

                                    </div>

                                </div>

                            <?php } ?>

                        </div>


                    <?php } ?>

                    <?php
                    $req_bc = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " AND type_p = 'Téléchargements' ";
                    $exec_bc = mysqli_query($conn, $req_bc);
                    $check_bc = mysqli_num_rows($exec_bc);
                    if ($check_bc !== 0) {
                    ?>
                        <div class="page-separator">
                            <div class="page-separator__text">Mes packs documentaires</div>
                        </div>

                        <div class="row card-group-row">

                            <?php

                            while ($array_bc = mysqli_fetch_array($exec_bc)) {

                                $req_el = "SELECT * FROM doc_formation WHERE ID = " . $array_bc['ID_p'] . " ";
                                $exec_el = mysqli_query($conn, $req_el);
                                $array_el = mysqli_fetch_array($exec_el);


                            ?>


                                <div class="col-sm-6 col-xl-4 card-group-row__col">

                                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card undefined" data-toggle="popover" data-trigger="click">

                                        <a href="" class="card-img-top js-image" data-position="" data-height="140">
                                            <img src="uploads/formations/<?php echo $array_el['Image']; ?>" alt="course">
                                            <span class="overlay__content">
                                                <span class="overlay__action d-flex flex-column text-center">
                                                    <i class="material-icons icon-32pt">file_present</i>
                                                    <span class="card-title text-white"><?php echo $array_el['Name']; ?></span>
                                                </span>
                                            </span>
                                        </a>

                                        <div class="card-body flex">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"><?php echo $array_el['Name']; ?></a>
                                                    <small class="text-50 font-weight-bold mb-4pt">SmarTTec</small>
                                                </div>

                                            </div>
                                            <?php
                                            $req_rev = "SELECT * FROM review_table WHERE cours_ID = " . $array_el['ID'] . " AND Type_c = 'Téléchargements' ";
                                            $exec_rev = mysqli_query($conn, $req_rev);
                                            $count_rev = mysqli_num_rows($exec_rev);
                                            if ($count_rev !== 0) {
                                                $total = 0;
                                                while ($c_total = mysqli_fetch_array($exec_rev)) {
                                                    $total = $total + $c_total['user_rating'];
                                                }
                                                $moyen_t = $total / $count_rev;

                                                $st_1 = floor($moyen_t);
                                                $st_2 = 5 - $st_1;

                                            ?>
                                                <div class="d-flex">
                                                    <div class="rating flex">
                                                        <?php
                                                        if ($st_1 !== 0) {
                                                            for ($s = 1; $s <= $st_1; $s++) {
                                                        ?>
                                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                        <?php }
                                                        } ?>
                                                        <?php

                                                        if ($st_2 !== 0) {
                                                            for ($s = 1; $s <= $st_2; $s++) {
                                                        ?>


                                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                    <small class="text-50"><?php echo $st_1; ?>/5</small>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row justify-content-between">
                                                <div class="col-auto d-flex align-items-center">
                                                    <span class="material-icons icon-16pt text-50 mr-4pt">file_present</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                                $req_l = "SELECT * FROM `docs` WHERE f_ID = " . $array_el['ID'] . " ";
                                                                                                $exec_l = mysqli_query($conn, $req_l);
                                                                                                $lessons = mysqli_num_rows($exec_l);
                                                                                                echo $lessons;
                                                                                                ?> documents</small></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="popoverContainer d-none">
                                        <div class="media">
                                            <div class="media-left mr-12pt">
                                                <img src="uploads/formations/<?php echo $array_el['Image']; ?>?>" width="40" height="40" alt="Angular" class="rounded">
                                            </div>
                                            <div class="media-body">
                                                <div class="card-title mb-0"><?php echo $array_el['Name']; ?></div>
                                                <p class="lh-1 mb-0">
                                                    <span class="text-50 small">avec</span>
                                                    <span class="text-50 small font-weight-bold">SmarTTec</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mr-8pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">file_present</span>
                                            <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                        $req_l = "SELECT * FROM `docs` WHERE f_ID = " . $array_el['ID'] . " ";
                                                                                        $exec_l = mysqli_query($conn, $req_l);
                                                                                        $lessons = mysqli_num_rows($exec_l);
                                                                                        echo $lessons;
                                                                                        ?> documents</small></p>
                                        </div>




                                        <?php
                                        $req_rev = "SELECT * FROM review_table WHERE cours_ID = " . $array_el['ID'] . " AND Type_c = 'Téléchargements' ";
                                        $exec_rev = mysqli_query($conn, $req_rev);
                                        $count_rev = mysqli_num_rows($exec_rev);
                                        if ($count_rev !== 0) {
                                            $total = 0;
                                            while ($c_total = mysqli_fetch_array($exec_rev)) {
                                                $total = $total + $c_total['user_rating'];
                                            }
                                            $moyen_t = $total / $count_rev;

                                            $st_1 = floor($moyen_t);
                                            $st_2 = 5 - $st_1;

                                        ?>
                                            <div class="d-flex align-items-center py-4pt" style="white-space: nowrap;">
                                                <div class="rating mr-8pt">
                                                    <?php
                                                    if ($st_1 !== 0) {
                                                        for ($s = 1; $s <= $st_1; $s++) {
                                                    ?>
                                                            <span class="rating__item"><span class="material-icons text-primary">star</span></span>
                                                    <?php }
                                                    } ?>
                                                    <?php

                                                    if ($st_2 !== 0) {
                                                        for ($s = 1; $s <= $st_2; $s++) {
                                                    ?>


                                                            <span class="rating__item"><span class="material-icons text-primary">star_border</span></span>
                                                    <?php }
                                                    } ?>
                                                </div>
                                                <small class="text-50"><?php echo $st_1; ?>/5</small>
                                            </div>
                                        <?php } ?>
                                        <div>
                                            <ul class="accordion accordion--boxed js-accordion measure-paragraph-max mb-0">
                                                <li class="accordion__item">
                                                    <div class="accordion__menu">
                                                        <ul class="list-unstyled ">
                                                            <?php
                                                            $req_docc = "SELECT * FROM docs WHERE f_ID = " . $array_el['ID'] . " ORDER BY Ordering ";
                                                            $exec_docc = mysqli_query($conn, $req_docc);
                                                            while ($array_docc = mysqli_fetch_array($exec_docc)) {

                                                            ?>
                                                                <li class="accordion__menu-link">
                                                                    <span class="material-icons icon-32pt icon--left text-body">file_present</span>
                                                                    <span class="text-50 small font-weight-bold">
                                                                        <?php echo $array_docc['Name_d']; ?>
                                                                    </span>
                                                                    <div class="flex">
                                                                        <a href="uploads/formations/<?php echo $array_docc['Doc']; ?>" class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary red_tajrib" target="_blank">Voir</a>
                                                                    </div>

                                                                </li>
                                                            <?php
                                                            }

                                                            ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            <?php } ?>

                        </div>



                    <?php } ?>



                    <?php
                    $req_ff = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " AND type_p = 'Direct'";
                    $exec_ff = mysqli_query($conn, $req_ff);

                    $check_ff = mysqli_num_rows($exec_ff);
                    if ($check_ff !== 0) {
                        $ids = array();
                        while ($array_ff = mysqli_fetch_array($exec_ff)) {
                            $req_sel = "SELECT * FROM events WHERE id = " . $array_ff['ID_p'] . " ";
                            $exec_sel = mysqli_query($conn, $req_sel);
                            $array_dd = mysqli_fetch_array($exec_sel);
                            $date_today = date('Y-m-d');
                            $date_start = $array_dd['start_event'];
                            $date_end = $array_dd['end_event'];

                            if ($date_today > $date_end) {
                                $ids[] = $array_dd['id'];
                            }
                        }
                        if (!empty($ids)) {
                    ?>


                            <div class="page-separator">
                                <div class="page-separator__text">Mes formations en direct finies </div>
                            </div>
                            <div class="row">
                                <?php

                                foreach ($ids as $idd) {
                                    $req_fin = "SELECT * FROM events WHERE id = " . $idd . " ";
                                    $exec_fin = mysqli_query($conn, $req_fin);
                                    $array_fin = mysqli_fetch_array($exec_fin);
                                    
                                    $req_for = "SELECT * FROM formations_live WHERE ID_f = " . $array_fin['ID_f'] . " ";
                                    $exec_for = mysqli_query($conn, $req_for);
                                    $array_for = mysqli_fetch_array($exec_for);

                                    $prix_tot = $array_for['price'];
                                ?>
                                    <div class="col-md-4">
                                        <ul class="accordion accordion--boxed js-accordion measure-paragraph-max mb-0" id="toc-<?php echo $array_fin['id']; ?>">

                                            <li class="accordion__item">
                                                <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-<?php echo $array_fin['id']; ?>" href="#toc-content-<?php echo $array_fin['id']; ?>">
                                                    <div class="flex">
                                                        <div class="d-flex align-items-center">
                                                            <div class="rounded mr-12pt z-0 o-hidden">
                                                                <div class="overlay">
                                                                    <img src="uploads/formations/img/<?php echo $array_for['Image']; ?>" width="40" height="40" alt="Angular" class="rounded">
                                                                    <span class="overlay__content overlay__content-transparent">
                                                                        <span class="overlay__action d-flex flex-column text-center lh-1">
                                                                            <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="flex">
                                                                <div class="card-title"><?php echo $array_fin['title']; ?></div>
                                                                <p class="flex text-50 lh-1 mb-0"><small>
                                                                        <?php
                                                                        $req_v = "SELECT * FROM `seance` WHERE session_id = " . $array_fin['id'] . " ";
                                                                        $exec_v = mysqli_query($conn, $req_v);
                                                                        echo mysqli_num_rows($exec_v);


                                                                        ?>
                                                                        séances</small></p>
                                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                                </a>
                                                <div class="accordion__menu">
                                                    <ul class="list-unstyled collapse show" id="toc-content-<?php echo $array_fin['id']; ?>">


                                                        <li class="accordion__menu-link">
                                                            

                                                                <?php

                                                                $req_ffff = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " AND type_p = 'Direct' AND ID_p =" . $array_fin['id'] . ' ';
                                                                $exec_ffff = mysqli_query($conn, $req_ffff);
                                                                $array_ffff = mysqli_fetch_array($exec_ffff);
                                                                if ($array_ffff['Paid'] == 0) { ?>

                                                                    <?php
                                                                    $Amount_tn = $prix_tot * 1000 * $convert_taux;
                                                                    $Amount = $prix_tot * 1000;
                                                                    $signture = sha1($NumSite . $Password . $orderId . $Amount_tn . $Devise);

                                                                    $Amount_d = $prix_tot * 100;
                                                                    ?>
<span class="material-icons icon-32pt icon--left text-body">attach_money</span>

                                                            <div class="flex">
                                                                    <div>
                                                                        <form method="POST" action="https://www.gpgcheckout.com/Paiement/Validation_paiement.php">

                                                                            <input type="hidden" value="<?php echo $array_ffff['ID']; ?>" name="orderProducts" />

                                                                            <div style="display:none;">
                                                                            <input type="text" name="NumSite" value="<?php echo $NumSite; ?>"><br /><br />
                                                                            <input type="text" name="Password" value="<?php echo md5($Password); ?>"><br /><br />
                                                                            <input type="text" name="orderID" value="<?php echo $orderId; ?>"><br /><br />
                                                                            <input type="text" name="Amount" value="<?php echo $Amount_tn; ?>"><br /><br />
                                                                            <input type="text" name="Currency" value="<?php echo $Devise; ?>"><br /><br />
                                                                            <input type="text" name="Language" value="fr"><br /><br />
                                                                            <input type="text" name="EMAIL" value="<?php echo $email; ?>"><br /><br />
                                                                            <input type="text" name="CustLastName" value="<?php echo $nom; ?>"><br /><br />
                                                                            <input type="text" name="CustFirstName" value="<?php echo $prenom; ?>"><br /><br />
                                                                            <input type="text" name="CustAddress" value="<?php echo $country; ?>"><br /><br />

                                                                            <input type="text" name="CustTel" value="<?php echo $phone; ?>"><br /><br />
                                                                            <input type="text" name="PayementType" value="1"><br /><br />
                                                                            <input type="text" name="MerchandSession" value=""><br /><br />
                                                                            <!-- <input type="text" name="orderProducts" value=""><br /><br /> -->
                                                                            <input type="text" name="signature" value="<?php echo $signture; ?>"><br /><br />
                                                                            <input type="text" name="AmountSecond" value="<?php echo $Amount_d; ?>"><br /><br />
                                                                            <input type="text" name="vad" value="176200003"><br /><br />
                                                                            <input type="text" name="Terminal" value="004"><br /><br />
                                                                            <input type="text" name="TauxConversion" value="2.7"><br /><br />
                                                                            <!--<input type="text" name="BatchNumber" value=" "><br /><br />
                                                                        	<input type="text" name="MerchantReference" value=" "><br /><br />
                                                                        	<input type="text" name="Reccu_Num" value=""><br /><br />
                                                                        	<input type="text" name="Reccu_ExpiryDate " value=""><br /><br />
                                                                        	<input type="text" name="Reccu_Frecuency " value=" "><br /><br />-->
                                                                        </div>

                                                                            <input class="ml-4pt btn btn-block btn-link text-secondary border-1 border-secondary" style="float: right;" type="submit" value="Payer" name="payments">

                                                                        </form>
                                                                        
                                                                    <!--    <a href="billing.php?id=<?php echo $array_ffff['ID'] ?>" class="ml-4pt btn btn-block btn-link text-secondary border-1 border-secondary" style="float: right;">Payer1</a> -->
</div>
</div>
                                                                    <?php }else{
                                                                        $req_certb = "SELECT * FROM certificate WHERE ID_sess =".$_SESSION['id']." AND ID_cours =".$array_for['ID_f']." AND Type ='Direct'";
                                                                        $exec_certb = mysqli_query($conn,$req_certb);
                                                                        $array_certb = mysqli_fetch_array($exec_certb);
                                                                        $check_certb = mysqli_num_rows($exec_certb);
                                                                    if($check_certb == 0){
                                                                        
                                                                        $req_nb_qz = "SELECT * FROM `questions-live` WHERE session_id =".$array_for['ID_f'];
                                                                        $exec_nb_qz = mysqli_query($conn,$req_nb_qz);
                                                                        $check_nb_qz = mysqli_num_rows($exec_nb_qz);
                                                                        if($check_nb_qz != 0){
                                                                    
                                                                    
                                                                    ?>
                                                                    <div class="flex">
                                                                    <div>
                                                                    <a href="qz/index.php?id_c=<?php echo $array_fin['id']; ?>" class="ml-4pt btn btn-sm btn-block  btn-accent btn--raised" style="float: right;color: white;">Quiz</a>
                                                                    </div>
                                                                    </div>
                                                                    <?php } }else{ ?>
                                                                <span class="material-icons icon-16pt icon--left text-body" style="color: #5af32e!important;font-size: 21px!important;">check_circle</span>
                                                                <strong>Vous avez déjà une certificat</strong>
                                                                <div class="flex">
                                                                    
                                                                        <a href="voir-certificat.php?key=<?php echo $array_certb['code_certif'] ?>" class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary" target="_blank" style="float: right;">Voir Certificat</a>

</div>
                                                                
                                                                    <?php 
                                                                    
                                                                    } } ?>
                                                                    
                                                                    


                                                        </li>


                                                        <?php
                                                        $count_s = 1;
                                                        while ($array_v = mysqli_fetch_array($exec_v)) {
                                                        ?>
                                                            <li class="accordion__menu-link">
                                                                <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                                                séance <?php echo $count_s; ?>
                                                                <div class="flex">
                                                                    <?php if ($array_ffff['Paid'] == 0) {
                                                                        echo '<span class="ml-4pt btn btn-sm  text-secondary " style="float: right;cursor: default;color:red !important;" >payer pour accéder au document <br> et la vidéo de la séance</span>';
                                                                    } else { ?>
                                                                        <a href="<?php echo $array_v['zoom_link']; ?>" class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary" target="_blank" style="float: right;">Vidéo</a>
                                                                        <a href="uploads/live/doc/<?php echo $array_v['doc']; ?>" target="_blank" class="ml-4pt btn btn-sm btn-link text-secondary border-1  border-secondary" style="float: right;">documents</a>


                                                                    <?php } ?>
                                                                
                                                            </li>

                                                        <?php
                                                            $count_s++;
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>

                            <br>
                    <?php }
                    } ?>



                    <?php
                    $req_ff = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " AND type_p = 'Direct'";
                    $exec_ff = mysqli_query($conn, $req_ff);

                    $check_ff = mysqli_num_rows($exec_ff);
                    if ($check_ff !== 0) {
                        $ids = array();
                        while ($array_ff = mysqli_fetch_array($exec_ff)) {
                            $req_sel = "SELECT * FROM events WHERE id = " . $array_ff['ID_p'] . " ";
                            $exec_sel = mysqli_query($conn, $req_sel);
                            $array_dd = mysqli_fetch_array($exec_sel);
                            $date_today = date('Y-m-d');
                            $date_start = $array_dd['start_event'];
                            $date_end = $array_dd['end_event'];

                            if (($date_today >= date('Y-m-d', strtotime('-1 day', strtotime($date_start)))) && ($date_today <= $date_end)) {
                                $ids[] = $array_dd['id'];
                            }
                        }

                        if (!empty($ids)) {

                    ?>


                            <div class="page-separator">
                                <div class="page-separator__text">Mes formations en direct actuelle</div>
                            </div>
                            <div class="row">
                                <?php

                                foreach ($ids as $idd) {
                                    $req_fin = "SELECT * FROM events WHERE id = " . $idd . " ";
                                    $exec_fin = mysqli_query($conn, $req_fin);
                                    $array_fin = mysqli_fetch_array($exec_fin);
                                    $req_for = "SELECT * FROM formations_live WHERE ID_f = " . $array_fin['ID_f'] . " ";
                                    $exec_for = mysqli_query($conn, $req_for);
                                    $array_for = mysqli_fetch_array($exec_for);
                                    $prix_tot = $array_for['price'];
                                ?>
                                    <div class="col-md-4">
                                        <ul class="accordion accordion--boxed js-accordion measure-paragraph-max mb-0" id="toc-<?php echo $array_fin['id']; ?>">
                                            <li class="accordion__item">
                                                <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-<?php echo $array_fin['id']; ?>" href="#toc-content-<?php echo $array_fin['id']; ?>">
                                                    <div class="flex">
                                                        <div class="d-flex align-items-center">
                                                            <div class="rounded mr-12pt z-0 o-hidden">
                                                                <div class="overlay">
                                                                    <img src="uploads/formations/img/<?php echo $array_for['Image']; ?>" width="40" height="40" alt="Angular" class="rounded">
                                                                    <span class="overlay__content overlay__content-transparent">
                                                                        <span class="overlay__action d-flex flex-column text-center lh-1">
                                                                            <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="flex">
                                                                <div class="card-title"><?php echo $array_fin['title']; ?></div>
                                                                <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                                            $req_v = "SELECT * FROM `seance` WHERE session_id = " . $array_fin['id'] . " ";
                                                                                                            $exec_v = mysqli_query($conn, $req_v);
                                                                                                            echo mysqli_num_rows($exec_v);


                                                                                                            ?> séances</small></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                                </a>
                                                <div class="accordion__menu">
                                                    <ul class="list-unstyled collapse show" id="toc-content-<?php echo $array_fin['id']; ?>">
                                                        <li class="accordion__menu-link">
                                                            <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                                            Meeting Zoom:
                                                            <div class="flex">
                                                                <a href="<?php echo $array_fin['zoom_link']; ?>" class="ml-4pt btn btn-sm btn-link text-secondary border-1 " target="_blank" style="float: right;background: #77c13a!important;color:white!important;">Lien Zoom</a>
                                                                <?php

                                                                $req_ffff = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " AND type_p = 'Direct' AND ID_p =" . $array_fin['id'] . ' ';
                                                                $exec_ffff = mysqli_query($conn, $req_ffff);
                                                                $array_ffff = mysqli_fetch_array($exec_ffff);
                                                                if ($array_ffff['Paid'] == 0) { ?>

                                                                    <?php
                                                                    $Amount_tn = $prix_tot * 1000 * $convert_taux;
                                                                    $Amount = $prix_tot * 1000;
                                                                    $signture = sha1($NumSite . $Password . $orderId . $Amount_tn . $Devise);

                                                                    $Amount_d = $prix_tot * 100;
                                                                    ?>

                                                                    <form method="POST" action="https://www.gpgcheckout.com/Paiement/Validation_paiement.php">
                                                                        <input type="hidden" value="<?php echo $array_ffff['ID']; ?>" name="orderProducts" />


                                                                        <div style="display:none;">
                                                                            <input type="text" name="NumSite" value="<?php echo $NumSite; ?>"><br /><br />
                                                                            <input type="text" name="Password" value="<?php echo md5($Password); ?>"><br /><br />
                                                                            <input type="text" name="orderID" value="<?php echo $orderId; ?>"><br /><br /><input type="text" name="Amount" value="<?php echo $Amount_tn; ?>"><br /><br />
                                                                            <input type="text" name="Currency" value="<?php echo $Devise; ?>"><br /><br />
                                                                            <input type="text" name="Language" value="fr"><br /><br />
                                                                            <input type="text" name="EMAIL" value="<?php echo $email; ?>"><br /><br />
                                                                            <input type="text" name="CustLastName" value="<?php echo $nom; ?>"><br /><br />
                                                                            <input type="text" name="CustFirstName" value="<?php echo $prenom; ?>"><br /><br />
                                                                            <input type="text" name="CustAddress" value="<?php echo $country; ?>"><br /><br />

                                                                            <input type="text" name="CustTel" value="<?php echo $phone; ?>"><br /><br />
                                                                            <input type="text" name="PayementType" value="1"><br /><br />
                                                                            <input type="text" name="MerchandSession" value=""><br /><br />
                                                                            <!-- <input type="text" name="orderProducts" value=""><br /><br /> -->
                                                                            <input type="text" name="signature" value="<?php echo $signture; ?>"><br /><br />
                                                                            <input type="text" name="AmountSecond" value="<?php echo $Amount_d; ?>"><br /><br />
                                                                            <input type="text" name="vad" value="176200003"><br /><br />
                                                                            <input type="text" name="Terminal" value="004"><br /><br />
                                                                            <input type="text" name="TauxConversion" value="2.7"><br /><br />
                                                                            <!--<input type="text" name="BatchNumber" value=" "><br /><br />
                                                                        	<input type="text" name="MerchantReference" value=" "><br /><br />
                                                                        	<input type="text" name="Reccu_Num" value=""><br /><br />
                                                                        	<input type="text" name="Reccu_ExpiryDate " value=""><br /><br />
                                                                        	<input type="text" name="Reccu_Frecuency " value=" "><br /><br />-->
                                                                        </div>

                                                                        <input class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary" style="float: right;" type="submit" value="Payer" name="payments">

                                                                    </form>
                                                                <?php } ?>


                                                            </div>
                                                        </li>
                                                        <?php
                                                        $count_s = 1;
                                                        while ($array_v = mysqli_fetch_array($exec_v)) {
                                                            if ($array_v['date'] < $date_today) {
                                                        ?>
                                                                <li class="accordion__menu-link">
                                                                    <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                                                    séance <?php echo $count_s; ?>
                                                                    <div class="flex">

                                                                        <?php if ($array_ffff['Paid'] == 0) {
                                                                            echo '<span class="ml-4pt btn btn-sm  text-secondary " style="float: right;cursor: default;color:red !important;" >payer pour accéder au document <br> et la vidéo de la séance</span>';
                                                                        } else { ?>
                                                                            <a href="<?php echo $array_v['zoom_link']; ?>" class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary" target="_blank" style="float: right;">Vidéo</a>
                                                                            <a href="uploads/live/doc/<?php echo $array_v['doc']; ?>" target="_blank" class="ml-4pt btn btn-sm btn-link text-secondary border-1  border-secondary" style="float: right;">documents</a>


                                                                        <?php } ?>
                                                                    </div>
                                                                </li>

                                                            <?php
                                                            } elseif ($array_v['date'] > $date_today) {
                                                            ?>
                                                                <li class="accordion__menu-link">
                                                                    séance <?php echo $count_s; ?> : &nbsp;
                                                                    <span class="material-icons icon-16pt icon--left text-body">schedule</span>
                                                                    <a class="flex"><?php echo $array_v['date']; ?></a>
                                                                    <span class="text-muted"><?php echo "de " . date("G:i", (strtotime($array_v['start_time']) - (3600 * $reglo_time))) . " jusqu'à " . date("G:i", (strtotime($array_v['end_time']) - (3600 * $reglo_time)));  ?></span>
                                                                </li>
                                                                <?php } else {
                                                                    // heure d'ete 
                                                             //   $time_now = date("H:i",strtotime('+1 hour'));

 $time_now = date("H:i");
                                                                if ($time_now < $array_v['start_time']) {
                                                                ?>
                                                                    <li class="accordion__menu-link">
                                                                        séance <?php echo $count_s; ?> : &nbsp;
                                                                        <span class="material-icons icon-16pt icon--left text-body">schedule</span>
                                                                        <a class="flex"><?php echo $array_v['date']; ?></a>
                                                                        <span class="text-muted"><?php echo "de " . date("G:i", (strtotime($array_v['start_time']) - (3600 * $reglo_time))) . " jusqu'à " . date("G:i", (strtotime($array_v['end_time']) - (3600 * $reglo_time)));  ?></span>
                                                                    </li>
                                                                <?php } elseif ($time_now > $array_v['end_time']) {

                                                                ?>
                                                                    <li class="accordion__menu-link">
                                                                        <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                                                        séance <?php echo $count_s; ?>
                                                                        <?php if ($array_ffff['Paid'] == 0) {
                                                                            echo '<span class="ml-4pt btn btn-sm  text-secondary " style="float: right;cursor: default;color:red !important;" >payer pour accéder au document <br> et la vidéo de la séance</span>';
                                                                        } else { ?>

                                                                            <div class="flex">
                                                                                <a href="<?php echo $array_v['zoom_link']; ?>" class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary" target="_blank" style="float: right;">Vidéo</a>
                                                                                <a href="uploads/live/doc/<?php echo $array_v['doc']; ?>" target="_blank" class="ml-4pt btn btn-sm btn-link text-secondary border-1  border-secondary" style="float: right;">documents</a>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </li>
                                                                <?php
                                                                } else {

                                                                ?>

                                                                    <li class="accordion__menu-link">
                                                                        <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                                                        séance <?php echo $count_s; ?>
                                                                        <div class="flex">
                                                                            <a href="<?php echo $array_fin['zoom_link']; ?>" class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary" target="_blank" style="float: right;color:red!important;">Regarder maintenant</a>

                                                                        </div>
                                                                    </li>


                                                        <?php          }
                                                            }

                                                            $count_s++;
                                                        } ?>

                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>

                            <br>
                            <br>
                    <?php }
                    } ?>
                    <br>



                    <?php
                    $req_ff = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " AND type_p = 'Direct'";
                    $exec_ff = mysqli_query($conn, $req_ff);

                    $check_ff = mysqli_num_rows($exec_ff);
                    if ($check_ff !== 0) {
                        $ids = array();
                        while ($array_ff = mysqli_fetch_array($exec_ff)) {
                            $req_sel = "SELECT * FROM events WHERE id = " . $array_ff['ID_p'] . " ";
                            $exec_sel = mysqli_query($conn, $req_sel);
                            $array_dd = mysqli_fetch_array($exec_sel);
                            $date_today = date('Y-m-d');
                            $date_start = $array_dd['start_event'];
                            $date_end = $array_dd['end_event'];

                            if (($date_today < date('Y-m-d', strtotime('-1 day', strtotime($date_start))))) {
                                $ids[] = $array_dd['id'];
                            }
                        }
                        if (!empty($ids)) {

                    ?>


                            <div class="page-separator">
                                <div class="page-separator__text">Mes formations en direct prochaines</div>
                            </div>
                            <div class="row">
                                <?php

                                foreach ($ids as $idd) {
                                    $req_fin = "SELECT * FROM events WHERE id = " . $idd . " ";
                                    $exec_fin = mysqli_query($conn, $req_fin);
                                    $array_fin = mysqli_fetch_array($exec_fin);
                                    $req_for = "SELECT * FROM formations_live WHERE ID_f = " . $array_fin['ID_f'] . " ";
                                    $exec_for = mysqli_query($conn, $req_for);
                                    $array_for = mysqli_fetch_array($exec_for);
                                    $prix_tot = $array_for['price'];
                                ?>
                                    <div class="col-md-4">
                                        <ul class="accordion accordion--boxed js-accordion measure-paragraph-max mb-0" id="toc-<?php echo $array_fin['id']; ?>">
                                            <li class="accordion__item">
                                                <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-<?php echo $array_fin['id']; ?>" href="#toc-content-<?php echo $array_fin['id']; ?>">
                                                    <div class="flex">
                                                        <div class="d-flex align-items-center">
                                                            <div class="rounded mr-12pt z-0 o-hidden">
                                                                <div class="overlay">
                                                                    <img src="uploads/formations/img/<?php echo $array_for['Image']; ?>" width="40" height="40" alt="Angular" class="rounded">
                                                                    <span class="overlay__content overlay__content-transparent">
                                                                        <span class="overlay__action d-flex flex-column text-center lh-1">
                                                                            <small class="h6 small text-white mb-0" style="font-weight: 500;">80%</small>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="flex">
                                                                <div class="card-title"><?php echo $array_fin['title']; ?></div>
                                                                <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                                            $req_v = "SELECT * FROM `seance` WHERE session_id = " . $array_fin['id'] . " ";
                                                                                                            $exec_v = mysqli_query($conn, $req_v);
                                                                                                            echo mysqli_num_rows($exec_v);
                                                                                                            ?> séances</small></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                                </a>
                                                <div class="accordion__menu">
                                                    <ul class="list-unstyled collapse show" id="toc-content-<?php echo $array_fin['id']; ?>">
                                                        <li class="accordion__menu-link">
                                                            <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                                            Meeting Zoom:
                                                            <div class="flex">
                                                                <a href="<?php echo $array_fin['zoom_link']; ?>" class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary" target="_blank" style="float: right;">Lien Zoom</a>

                                                                <?php

                                                                $req_ffff = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " AND type_p = 'Direct' AND ID_p =" . $array_fin['id'] . ' ';
                                                                $exec_ffff = mysqli_query($conn, $req_ffff);
                                                                $array_ffff = mysqli_fetch_array($exec_ffff);
                                                                if ($array_ffff['Paid'] == 0) { ?>
                                                                    <?php
                                                                    $Amount_tn = $prix_tot * 1000 * $convert_taux;
                                                                    $Amount = $prix_tot * 1000;
                                                                    $signture = sha1($NumSite . $Password . $orderId . $Amount_tn . $Devise);

                                                                    $Amount_d = $prix_tot * 100;
                                                                    ?>
                                                                    <form method="POST" action="https://www.gpgcheckout.com/Paiement/Validation_paiement.php">
                                                                        <input type="hidden" value="<?php echo $array_ffff['ID']; ?>" name="orderProducts" />

                                                                        <div style="display:none;">
                                                                            <input type="text" name="NumSite" value="<?php echo $NumSite; ?>"><br /><br />
                                                                            <input type="text" name="Password" value="<?php echo md5($Password); ?>"><br /><br />
                                                                            <input type="text" name="orderID" value="<?php echo $orderId; ?>"><br /><br /><input type="text" name="Amount" value="<?php echo $Amount_tn; ?>"><br /><br />
                                                                            <input type="text" name="Currency" value="<?php echo $Devise; ?>"><br /><br />
                                                                            <input type="text" name="Language" value="fr"><br /><br />
                                                                            <input type="text" name="EMAIL" value="<?php echo $email; ?>"><br /><br />
                                                                            <input type="text" name="CustLastName" value="<?php echo $nom; ?>"><br /><br />
                                                                            <input type="text" name="CustFirstName" value="<?php echo $prenom; ?>"><br /><br />
                                                                            <input type="text" name="CustAddress" value="<?php echo $country; ?>"><br /><br />

                                                                            <input type="text" name="CustTel" value="<?php echo $phone; ?>"><br /><br />
                                                                            <input type="text" name="PayementType" value="1"><br /><br />
                                                                            <input type="text" name="MerchandSession" value=""><br /><br />
                                                                            <!-- <input type="text" name="orderProducts" value=""><br /><br /> -->
                                                                            <input type="text" name="signature" value="<?php echo $signture; ?>"><br /><br />
                                                                            <input type="text" name="AmountSecond" value="<?php echo $Amount_d; ?>"><br /><br />
                                                                            <input type="text" name="vad" value="176200003"><br /><br />
                                                                            <input type="text" name="Terminal" value="004"><br /><br />
                                                                            <input type="text" name="TauxConversion" value="2.7"><br /><br />
                                                                            <!--<input type="text" name="BatchNumber" value=" "><br /><br />
                                                                        	<input type="text" name="MerchantReference" value=" "><br /><br />
                                                                        	<input type="text" name="Reccu_Num" value=""><br /><br />
                                                                        	<input type="text" name="Reccu_ExpiryDate " value=""><br /><br />
                                                                        	<input type="text" name="Reccu_Frecuency " value=" "><br /><br />-->
                                                                        </div>

                                                                        <input class="ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary" style="float: right;" type="submit" value="Payer" name="payments">

                                                                    </form>
                                                                <?php } ?>

                                                            </div>
                                                        </li>
                                                        <?php
                                                        $count_d = 1;
                                                        while ($array_sec = mysqli_fetch_array($exec_v)) {
                                                        ?>
                                                            <li class="accordion__menu-link">
                                                                séance <?php echo $count_d; ?> : &nbsp;
                                                                <span class="material-icons icon-16pt icon--left text-body">schedule</span>
                                                                <a class="flex"><?php echo $array_sec['date']; ?></a>
                                                                <span class="text-muted"><?php echo "de " . date("G:i", (strtotime($array_sec['start_time']) - (3600 * $reglo_time))) . " jusqu'à " . date("G:i", (strtotime($array_sec['end_time']) - (3600 * $reglo_time)));  ?></span>
                                                            </li>
                                                        <?php
                                                            $count_d++;
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>

                            <br>
                            <br>
                    <?php }
                    } ?>
                    <br>
                    <?php
                    $req_vide = "SELECT * FROM checkout WHERE ID_sess = " . $_SESSION['id'] . " ";
                    $exec_vide = mysqli_query($conn, $req_vide);
                    $check_vide = mysqli_num_rows($exec_vide);
                    if ($check_vide == 0) {

                    ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="_1o7LM">

                                    <div style="margin: auto;">
                                        <div style="text-align: center;">
                                            <img alt="" role="presentation" src="public/images/404.png" style="width: 300px;">
                                        </div>
                                        <div style="text-align: center;">
                                            <h2 class="JlgbC">Il n'y a pas de formations ni de cours achetées</h2>
                                            <p class="Cxy4C">Nous n'avons trouvé aucune formation ni cours sur votre compte actuellement. <span>ne perdez pas de temps et inscrivez-vous maintenant à des nouvelles formations. <a href="index.php">Cliquer ici</a></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="page-separator">
                                    <div class="page-separator__text">Recommandé</div>
                                </div>
                                <?php
                                $req_rec = "SELECT * FROM cours ORDER BY RAND() LIMIT 2";
                                $exec_rec = mysqli_query($conn, $req_rec);
                                while ($array_rec = mysqli_fetch_array($exec_rec)) {


                                ?>
                                    <div class="mb-8pt d-flex align-items-center">
                                        <a href="enroll-cours.php?id_c=<?php echo $array_rec['ID_c']; ?>" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                            <img src="uploads/cours/img/<?php echo $array_rec['Image']; ?>" alt="Angular Routing In-Depth" class="avatar-img rounded">
                                            <span class="overlay__content"></span>
                                        </a>
                                        <div class="flex">
                                            <a class="card-title mb-4pt" href="enroll-cours.php?id_c=<?php echo $array_rec['ID_c']; ?>"><?php echo $array_rec['Name_c']; ?></a>
                                            <div class="d-flex align-items-center">
                                                <div class="rating mr-8pt">

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                </div>
                                                <small class="text-muted">5/5</small>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php
                                $req_rec = "SELECT * FROM doc_formation ORDER BY RAND() LIMIT 2";
                                $exec_rec = mysqli_query($conn, $req_rec);
                                while ($array_rec = mysqli_fetch_array($exec_rec)) {


                                ?>
                                    <div class="mb-8pt d-flex align-items-center">
                                        <a href="enroll-doc.php?id_c=<?php echo $array_rec['ID']; ?>" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                            <img src="uploads/formations/<?php echo $array_rec['Image']; ?>" alt="Angular Routing In-Depth" class="avatar-img rounded">
                                            <span class="overlay__content"></span>
                                        </a>
                                        <div class="flex">
                                            <a class="card-title mb-4pt" href="enroll-doc.php?id_c=<?php echo $array_rec['ID']; ?>"><?php echo $array_rec['Name']; ?></a>
                                            <div class="d-flex align-items-center">
                                                <div class="rating mr-8pt">

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                </div>
                                                <small class="text-muted">5/5</small>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php
                                $req_rec = "SELECT * FROM formations_live ORDER BY RAND() LIMIT 2";
                                $exec_rec = mysqli_query($conn, $req_rec);
                                while ($array_rec = mysqli_fetch_array($exec_rec)) {
                                    $prix_tot = $array_for['price'];

                                ?>
                                    <div class="mb-8pt d-flex align-items-center">
                                        <a href="enroll-direct.php?id_l=<?php echo $array_rec['ID_f']; ?>" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                            <img src="uploads/formations/img/<?php echo $array_rec['Image']; ?>" alt="Angular Routing In-Depth" class="avatar-img rounded">
                                            <span class="overlay__content"></span>
                                        </a>
                                        <div class="flex">
                                            <a class="card-title mb-4pt" href="enroll-direct.php?id_l=<?php echo $array_rec['ID_f']; ?>"><?php echo $array_rec['Name_f']; ?></a>
                                            <div class="d-flex align-items-center">
                                                <div class="rating mr-8pt">

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                    <span class="rating__item"><span class="material-icons">star</span></span>

                                                </div>
                                                <small class="text-muted">5/5</small>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="page-separator">
                        <div class="page-separator__text">Certificats</div>
                    </div>

                    <?php
                    $req_certif = "SELECT * FROM certificate WHERE ID_sess = " . $_SESSION['id'] . " ";
                    $exec_certif = mysqli_query($conn, $req_certif);
                    $check_certif = mysqli_num_rows($exec_certif);
                    if ($check_certif == 0) {
                        echo "<h4>il n'y a pas de certificats pour le moment!!</h4>";
                    } else {

                    ?>

                        <div id="carouselExampleFade" class="carousel carousel-card slide mb-24pt col-md-6" style="margin: auto;">
                            <div class="carousel-inner">
                                <?php
                                $ippp = 0;
                                while ($array_certif = mysqli_fetch_array($exec_certif)) {
                                ?>
                                    <div class="carousel-item <?php if ($ippp == 0) {
                                                                    echo "active";
                                                                } ?>">

                                        <div class="card border-0 mb-0" href="">
                                            <img src="test_certif/certificate/<?php echo $array_certif['code_certif'] . $_SESSION['id'] . $array_certif['ID_cours'] . ".jpg"; ?>" alt="Flinto" class="card-img" style="max-height: 100%; width: initial;">
                                            <div class="fullbleed bg-primary" style="opacity: .5;"></div>
                                            <span class="card-body d-flex flex-column align-items-center justify-content-center fullbleed">
                                                <span class="row flex-nowrap">
                                                    <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                                        <span class="h5 text-white text-uppercase font-weight-normal m-0 d-block">
                                                            <?php

                                                            if ($array_certif['Type'] == "E-learning") {


                                                                $req_certif_n = "SELECT * FROM cours WHERE ID_c = " . $array_certif['ID_cours'];
                                                                $exec_certif_n = mysqli_query($conn, $req_certif_n);
                                                                $array_certif_n = mysqli_fetch_array($exec_certif_n);
                                                                $path = "uploads/cours/img/" . $array_certif_n['Image'];
                                                                $name_certi_el = $array_certif_n['Name_c'];
                                                            } else {
                                                                $req_certif_n = "SELECT * FROM formations_live WHERE ID_f = " . $array_certif['ID_cours'];
                                                                $exec_certif_n = mysqli_query($conn, $req_certif_n);
                                                                $array_certif_n = mysqli_fetch_array($exec_certif_n);
                                                                $path = "uploads/formations/img/" . $array_certif_n['Image'];
                                                                $name_certi_el = $array_certif_n['Name_f'];
                                                            }


                                                            ?>
                                                            <?php echo $name_certi_el; ?></span>
                                                        <span class="text-white-60 d-block mb-24pt"><?php echo $array_certif['date_certif']; ?></span>
                                                    </span>
                                                    <br>
                                                    <!-- <span class="col d-flex flex-column">
                                                        <span class="text-right flex mb-16pt">
                                                            <img src="<?php echo $path; ?>" width="64" alt="Flinto" class="rounded">
                                                        </span>
                                                    </span> -->
                                                </span>
                                                <span class="row flex-nowrap">
                                                    <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                                        <img src="public/images/illustration/achievement/128/white.png" width="64" alt="achievement">
                                                    </span>
                                                    <span class="col d-flex flex-column">
                                                        <span>
                                                            <a class="btn btn-accent" target="_blank" href="voir-certificat.php?key=<?php echo $array_certif['code_certif'] ?>">voir certificat</a>
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                    </div>
                                <?php
                                    $ippp++;
                                } ?>

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                                <span class="carousel-control-icon material-icons" aria-hidden="true">keyboard_arrow_left</span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                                <span class="carousel-control-icon material-icons" aria-hidden="true">keyboard_arrow_right</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- // END Header Layout Content -->

<?php include 'footer.php';
ob_end_flush();
?>