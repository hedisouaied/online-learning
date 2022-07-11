<?php
ob_start();
include '../connexion.php';
if (!isset($_SESSION['client'])) {
    header('location:../index.php');
}
if (!isset($_GET['step'])) {
    header('location:../mescours.php');
} else {
    if ($_GET['step'] == "") {
        header('location:../mescours.php');
    }
}
if (isset($_GET['id_c'])) {

    $req_vr = "SELECT * FROM checkout WHERE ID_p = '" . $_GET['id_c'] . "' AND ID_sess = " . $_SESSION['id'] . " AND type_p = 'E-learning' ";
    $exec_vr = mysqli_query($conn, $req_vr);
    $array_vr = mysqli_fetch_array($exec_vr);
    $check_vr = mysqli_num_rows($exec_vr);
    if ($check_vr !== 0) {

        $req_cour = "SELECT * FROM cours WHERE ID_c = " . $array_vr['ID_p'] . " ";
        $exec_cour = mysqli_query($conn, $req_cour);
        $array_cour = mysqli_fetch_array($exec_cour);

        $num_video = 0;
        $req_video = "SELECT * FROM lesson WHERE cours_id = " . $array_cour['ID_c'] . " ";
        $exec_video = mysqli_query($conn, $req_video);
        while ($array_video = mysqli_fetch_array($exec_video)) {
            $num_video++;
        }


        $num_sec = 0;
        $req_sec = "SELECT * FROM section WHERE course_id = " . $array_cour['ID_c'] . " ORDER BY orderr ";
        $exec_sec = mysqli_query($conn, $req_sec);
        $array_vide = array();
        $array_type = array();
        $array_id = array();
        while ($array_sec = mysqli_fetch_array($exec_sec)) {
            $req_vs = "SELECT * FROM lesson WHERE section_id = " . $array_sec['ID'] . " ";
            $exec_vs = mysqli_query($conn, $req_vs);
            while ($array_vs = mysqli_fetch_array($exec_vs)) {
                $array_type[] = 'video';
                $array_id[] = $array_vs['ID'];
            }
            $array_type[] = 'quiz';


            $array_id[] = $array_sec['ID'];



            $num_sec++;
        }
        $array_vide[] = $array_type;
        $array_vide[] = $array_id;

        //  print_r($array_vide);
        $all_steps = $num_video + $num_sec;

        $req_cccc = "SELECT * FROM steps WHERE ID_checkout=" . $array_vr['ID'] . " ";
        $exec_cccc = mysqli_query($conn, $req_cccc);
        $array_cccc = mysqli_fetch_array($exec_cccc);



        if (isset($_POST['suivant'])) {

            if (((int)$array_cccc['Steps'] + 1) == (int)$_GET['step']) {
                $req_quiz = "UPDATE `steps` SET `Steps`='" . $_GET['step'] . "' WHERE ID_checkout=" . $array_vr['ID'] . " ";

                $exec_quiz = mysqli_query($conn, $req_quiz);
            }
        }
        $req_cccc = "SELECT * FROM steps WHERE ID_checkout=" . $array_vr['ID'] . " ";
        $exec_cccc = mysqli_query($conn, $req_cccc);
        $array_cccc = mysqli_fetch_array($exec_cccc);

        if ($array_cccc['Steps'] < $_GET['step']) {
            header("location:index.php?id_c=" . $_GET['id_c'] . "&step=" . $array_cccc['Steps']);
        }
    } else {
        header("location:../mescours.php");
    }
} else {
    header("location:../mescours.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="stylesheet" href="../admin/assets/styles/style.min.css">

    <link href="favicons/images-favicon.png" rel="icon" type="image/png">

    <!-- Basic Page Needs
        ================================================== -->
    <title><?php echo $array_cour['Name_c']; ?> | E-learning</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Courseplus is - Professional A unique and beautiful collection of UI elements">


    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="css/css-icons.css">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/css-uikit.css">
    <link rel="stylesheet" href="css/scss-style.css">
    <link rel="stylesheet" href="css/css-tailwind.css">

    <link rel="stylesheet" href="../admin/assets/plugin/form-wizard/prettify.css">

    <!-- Form Wizard -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BMSVieira/moovie.js@latest/css/moovie.min.css">
    <link rel="stylesheet" href="css/checkbox.css">
    <link rel="stylesheet" href="css/certificate.css">

    <link rel="stylesheet" href="css/drop.css">



</head>

<body class="bg-white">

    <div id="wrapper" class="course-watch">

        <!-- Main Contents -->
        <div class="main_content">

            <div class="relative">

                <ul class=" relative z-10">
                    <?php

                    $i = $_GET['step'];
                    if (isset($array_vide[0][$i])) {
                        if ($array_vide[0][$i] == "video") {

                    ?>
                            <li>


                                <!-- to autoplay video uk-video="automute: true" -->
                                <div class="embed-video" style="padding-bottom: 0;height: auto;">



                                    <video class="player__embed d-none" id="example" poster="uploads/cours/img/<?php echo $array_cour['Image']; ?>">
                                        <source src="../uploads/cours/lessons/<?php
                                                                                $req_vv = "SELECT * FROM lesson WHERE ID = " . $array_vide[1][$i] . " ";
                                                                                $exec_vv = mysqli_query($conn, $req_vv);
                                                                                $array_vv = mysqli_fetch_array($exec_vv);
                                                                                echo $array_vv['video'];
                                                                                ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>

                                </div>
                                <form action="index.php?id_c=<?php echo $_GET['id_c']; ?>&step=<?php echo $_GET['step'] + 1; ?>" method="POST">


                                    <div class="row" style="background: #f5f7fa;">

                                        <div class=" col-md-3">
                                            <button type="submit" name="suivant" class="btn  btn-block" style="border-bottom: 3px solid #2a41e8 !important;color: #2a41e8;"> suivant <i class="fa fa-fast-forward"></i></button>

                                        </div>

                                    </div>


                                </form>

                            </li>
                        <?php } elseif ($array_vide[0][$i] == 'quiz') {

                        ?>
                            <li>

                                <?php
                                if (!isset($_POST['valide'])) {
                                ?>
                                    <div id="rootwizard-pill">
                                        <div class="tab-header pill">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <ul>
                                                        <?php
                                                        $query1 = "SELECT * FROM section where ID = " . $array_vide[1][$i] . " ";
                                                        $exec1 = mysqli_query($conn, $query1);
                                                        $array = mysqli_fetch_array($exec1);
                                                        $query2 = "SELECT * FROM questions where section_id = " . $array['ID'] . " ";
                                                        $exec2 = mysqli_query($conn, $query2);


                                                        $ii = 2;
                                                        while ($array = mysqli_fetch_array($exec2)) {
                                                        ?>
                                                            <li><a href="#tab-pill<?php echo $ii; ?>" data-toggle="tab"><?php echo "Question " . ($ii - 1); ?></a></li>

                                                        <?php $ii++;
                                                        } ?>
                                                        <li><a href="#tab-pill1" data-toggle="tab"> Valider</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                                            <div class="tab-content" style="padding: 6%;">
                                                <div class="tab-pane" id="tab-pill1">
                                                    <!-- /.row -->

                                                    <div class="row">

                                                        <div class=" col-md-9" style="margin: auto;">

                                                            <div ontouchstart="" style="width: max-content;margin: auto;">
                                                                <div class="button">
                                                                    <input type="hidden" name="valide">

                                                                    <button type="submit" value="Valider"><span>Valider</span></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                                <?php
                                                $query1 = "SELECT * FROM section where ID = " . $array_vide[1][$i] . " ";
                                                $exec1 = mysqli_query($conn, $query1);
                                                $array = mysqli_fetch_array($exec1);
                                                $query2 = "SELECT * FROM questions where section_id = " . $array['ID'] . " ";
                                                $exec2 = mysqli_query($conn, $query2);


                                                $ii = 2;
                                                while ($array = mysqli_fetch_array($exec2)) {
                                                ?>
                                                    <div class="tab-pane" id="tab-pill<?php echo $ii; ?>">
                                                        <!-- /.row -->

                                                        <div class="row" style="width: 62%;margin: auto;">

                                                            <div class=" col-md-12">

                                                                <div class="form-group">
                                                                    <label style="font-size: 1.5em;font-weight: 400;font-family: Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;"><?php echo $array['question']; ?></label>
                                                                    <input type="hidden" name="id_quiz[]" value="<?php echo $array['ID']; ?>">
                                                                </div>

                                                                <div class="row">
                                                                    <?php
                                                                    $req_pre = "SELECT * FROM reponse WHERE question_id =" . $array['ID'] . ' ';
                                                                    $exec_pre = mysqli_query($conn, $req_pre);
                                                                    while ($array_pre = mysqli_fetch_array($exec_pre)) {
                                                                    ?>
                                                                        <div class="col-sm-12 col-md-12 ">
                                                                            <div class="form-group">


                                                                                <input class="" type="checkbox" name="rep<?php echo $ii - 1; ?>[]" value="<?php echo $array_pre['ID']; ?>" style="height: 20px;width: 20px;margin-right: 7px;position: relative;top: 5px;">

                                                                                <label class="form-check-label" style="padding-top: 9px;font-weight: 500;font-family: Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;">
                                                                                    <?php echo $array_pre['reponse']; ?>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>

                                                                </div>

                                                            </div>

                                                        </div>


                                                    </div>
                                                <?php $ii++;
                                                } ?>

                                                <input type="hidden" name="nb_q" value="<?php echo $ii - 2; ?>" </div>
                                        </form>
                                        <ul class="pager wizard">
                                            <li class="previous"><a style="background-color: #ed0b4c;border-color: #ed0b4c;box-shadow: inset 0 1px 0 hsl(0deg 0% 100% / 15%), 0 1px 1px rgb(39 44 51 / 8%);color:white!important;" href="javascript:void(0)">Précédent</a></li>
                                            <li class="next"><a style="background-color: #ed0b4c;border-color: #ed0b4c;box-shadow: inset 0 1px 0 hsl(0deg 0% 100% / 15%), 0 1px 1px rgb(39 44 51 / 8%);color:white!important;" href="javascript:void(0)">Suivant</a></li>
                                        </ul>
                                    </div>

                                <?php } else {

                                    $note_all = 0;
                                    $note_sur = 0;
                                    $nbr_q = $_POST['nb_q'];

                                    for ($i = 1; $i <= $nbr_q; $i++) {
                                        $id_quiz = $_POST['id_quiz'][$i - 1];
                                        $req_q = "SELECT * FROM questions WHERE ID = '" . $id_quiz . "' ";
                                        $exec_q = mysqli_query($conn, $req_q);
                                        $array_q = mysqli_fetch_array($exec_q);
                                        $note_el_question = $array_q['points'];
                                        $note_sur = $note_sur + $note_el_question;
                                        $req_u = "SELECT * FROM reponse WHERE question_id = '" . $id_quiz . "' AND vrai_faux = 1";
                                        $array_vrai = array();
                                        $exec_u = mysqli_query($conn, $req_u);
                                        while ($array_u = mysqli_fetch_array($exec_u)) {
                                            $array_vrai[] = $array_u['ID'];
                                        }
                                        if (isset($_POST['rep' . $i])) {

                                            $check = $_POST['rep' . $i];
                                            $y = 1;
                                            $nombre_des_rep_vrai_de_base = count($array_vrai);
                                            $nombre_de_mes_rep = count($check);

                                            foreach ($check as $chh) {
                                                if (!in_array($chh, $array_vrai)) {
                                                    $y = 0;
                                                }
                                            }

                                            if ($y == 0) {
                                                $note_quiz = 0;
                                            } else {

                                                if ($nombre_des_rep_vrai_de_base == $nombre_de_mes_rep) {
                                                    $note_quiz = $note_el_question;
                                                } else {
                                                    $note_quiz = ($note_el_question / 2);
                                                }
                                            }



                                            $note_all = $note_all + $note_quiz;
                                        }
                                    }




                                    $reqq = "SELECT * FROM `note` WHERE id_sess = " . $_SESSION['id'] . " AND id_cours = '" . $_GET['id_c'] . "' AND id_section = '" . $array_q['section_id'] . "' ";
                                    $execc = mysqli_query($conn, $reqq);
                                    $check_note = mysqli_num_rows($execc);
                                    if ($check_note < 1) {
                                        $rr_ins = "INSERT INTO `note` (`id_sess`,`id_cours`, `id_section`, `note`, `sure`)
                                    VALUES('" . $_SESSION['id'] . "','" . $_GET['id_c'] . "','" . $array_q['section_id'] . "','" . $note_all . "','" . $note_sur . "' ) ";
                                        $ee_ins = mysqli_query($conn, $rr_ins);
                                    } else {
                                        $array_checc = mysqli_fetch_array($execc);

                                        if ($array_checc['note'] < $note_all) {

                                            $req_quiz = "UPDATE `note` SET `note`='" . $note_all . "',`sure`='" . $note_sur . "' WHERE ID=" . $array_checc['ID'] . " ";

                                            $exec_quiz = mysqli_query($conn, $req_quiz);
                                        }
                                    }


                                    $reqq = "SELECT * FROM `note` WHERE id_sess = " . $_SESSION['id'] . " AND id_cours = '" . $_GET['id_c'] . "' AND id_section = '" . $array_q['section_id'] . "' ";
                                    $execc = mysqli_query($conn, $reqq);
                                    $array_checc = mysqli_fetch_array($execc);

                                    if (($note_all / $note_sur) < 0.5) {
                                        $msg_note = "
                                    <div class='row'> 
                                    <div class='col-md-6' style='margin: auto;background: white;padding: 14px;border-radius: 10px;' >
                                    <h2 style ='font-size: 2em;text-align: center;margin-bottom: 10px;'><i class='fa fa-close' style='color:red;'></i> Quiz raté</h2>
                                    <p>Votre note : <br> <strong>" . $note_all . "/" . $note_sur . '</strong></p>
                                    <p>La résultat maximale dans ce quiz <i class="fa fa-star" style="color:gold;"></i> : <br> <strong>' . $array_checc['note'] . '/' . $array_checc['sure'] . '</strong></p>
                                    </div> 
                                    </div>';
                                    } else {
                                        $msg_note = "
                                    <div class='row'> 
                                    <div class='col-md-6' style='margin: auto;background: white;padding: 14px;border-radius: 10px;' >
                                    <h2 style ='font-size: 2em;text-align: center;margin-bottom: 10px;'><i class='fa fa-check' style='color:#2ecc71;'></i> Quiz passé</h2>
                                    <p>Votre note : <br> <strong>" . $note_all . "/" . $note_sur . '</strong></p>
                                    <p>La résultat maximale dans ce quiz <i class="fa fa-star" style="color:gold;"></i> : <br> <strong>' . $array_checc['note'] . '/' . $array_checc['sure'] . '</strong></p>
                                    </div> 
                                    </div>';
                                    }
                                ?>
                                    <div id="rootwizard-pill">
                                        <div class="tab-header pill">
                                            <div class="navbar">
                                                <div class="navbar-inner">
                                                    <ul>
                                                        <li><a href="#tab-pill1" data-toggle="tab"> Valider</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <form <?php

                                                if (($note_all / $note_sur) >= 0.5) {

                                                    if ($all_steps !== ($_GET['step'] + 1)) {
                                                ?> action="index.php?id_c=<?php echo $_GET['id_c']; ?>&step=<?php echo $_GET['step'] + 1; ?>" <?php

                                                                                                                                            } else {

                                                                                                                                                ?> action="../certif.php" <?php

                                                                                                                                                                        }
                                                                                                                                                                    } ?> method="POST">
                                            <div class="tab-content" style="padding: 6%;">
                                                <div class="tab-pane" id="tab-pill1">
                                                    <!-- /.row -->

                                                    <div class="row">

                                                        <div class=" col-md-9" style="margin: auto;">
                                                            <?php echo $msg_note; ?>

                                                            <?php

                                                            if (($note_all / $note_sur) >= 0.5) {

                                                                if ($all_steps !== ($_GET['step'] + 1)) {
                                                            ?>
                                                                    <div class="row">
                                                                        <div class="col-md-6" style="margin: auto;padding: 14px;">
                                                                            <input type="submit" name="suivant" class="btn btn-success btn-block" value="suivant" style="background: #ed0b4c;">
                                                                        </div>
                                                                    </div>
                                                                <?php

                                                                } else {

                                                                ?>
                                                                    <input type="hidden" name="ID_sess" value="<?php echo $_SESSION['id']; ?>" />

                                                                    <input type="hidden" name="ID_cour" value="<?php echo $_GET['id_c']; ?>" />
                                                                    <input type="hidden" name="type" value="<?php echo "E-learning"; ?>" />

                                                                    <!-- designed by me... enjoy! -->
                                                                    <div class="wrapper">
                                                                        <button class="cta" name="suivant" type="submit">
                                                                            <span>GET CERTIFICATE</span>
                                                                            <span>
                                                                                <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                                    <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                        <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                                                                        <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                                                                        <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                                                                                    </g>
                                                                                </svg>
                                                                            </span>
                                                                        </button>
                                                                    </div>

                                                                <?php

                                                                }
                                                            } else { ?>




                                                                <div ontouchstart="" style="width: max-content;margin: auto;">

                                                                    <div class="button">
                                                                        <input type="hidden" name="valide">

                                                                        <a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><span style="position: relative;top: 29%;">Repeter</span></a>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>

                                                        </div>

                                                    </div>


                                                </div>

                                            </div>
                                        </form>

                                    </div>

                                <?php   } ?>
                            </li>
                        <?php

                        }
                    } else {
                        ?>
                        <li>



                            <form action="index.php?id_c=<?php echo $_GET['id_c']; ?>&step=<?php echo $_GET['step'] + 1; ?>" method="POST">


                                <div class="row">

                                    <div class=" col-md-9" style="margin: auto;">
                                        <input type="submit" name="suivant" class="btn btn-success btn-block" value="suivant">

                                    </div>

                                </div>


                            </form>

                        </li>
                    <?php
                    }
                    ?>
                </ul>

                <div class="bg-gray-200 w-full h-full absolute inset-0 animate-pulse"></div>

            </div>

            <nav class="cd-secondary-nav border-b md:p-0 lg:px-6">
                <ul uk-switcher="connect: #course-tabs; animation: uk-animation-fade">
                    <li><a href="#" class="lg:px-2"> Information </a></li>
                    <li><a href="#" class="lg:px-2"> Announcements </a></li>
                </ul>
            </nav>

            <div class="container">

                <div class="max-w-2xl lg:py-6 mx-auto uk-switcher" id="course-tabs">

                    <!--  Overview -->
                    <div>

                        <h4 class="text-2xl font-semibold"> à propos de ce cours </h4>

                        <p> <?php echo $array_cour['Name_c']; ?> </p>

                        <hr class="my-5">

                        <div class="grid lg:grid-cols-3 mt-8 gap-8">
                            <div>
                                <h3 class="text-lg font-semibold"> Description </h3>
                            </div>
                            <div class="col-span-2">
                                <p>
                                    <?php
                                    echo $array_cour['Desc_c'];
                                    ?>
                                </p>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold"> Ce que vous apprendez </h3>
                            </div>
                            <div class="col-span-2">
                                <ul>
                                    <?php

                                    $str = $array_cour['whatyou'];
                                    $arr = explode(",", $str);
                                    for ($i = 0; $i < count($arr); $i++) {
                                    ?>
                                        <li> <i class="uil-check text-xl font-bold mr-2"></i><?php echo $arr[$i]; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>


                    </div>

                    <!--  Announcements -->
                    <div>
                        <h3 class="text-xl font-semibold mb-3"> Announcement </h3>

                        <div class="flex items-center gap-x-4 mb-5">
                            <img src="images/avatars-avatar-4.jpg" alt="" class="rounded-full shadow w-12 h-12">
                            <div>
                                <h4 class="-mb-1 text-base"> Stella Johnson</h4>
                                <span class="text-sm"> Instructor <span class="text-gray-500"> 1 year ago </span> </span>
                            </div>
                        </div>

                        <h4 class="leading-8 text-xl"> Nam liber tempor cum soluta nobis eleifend option congue imperdiet
                            doming id quod mazim placerat facer possim assum.</h4>
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


                    </div>





                </div>
            </div>


        </div>

        <!-- sidebar -->
        <div class="sidebar">

            <!-- slide_menu for mobile -->
            <span class="slide_menu right-3 left-auto" uk-toggle="target: .sidebar ; cls: is-active">
            </span>

            <!-- back to home link -->
            <div class="flex justify-between lg:-ml-1 mt-1 mr-2">
                <a href="../mescours.php" class="flex items-center text-blue-500 text-sm">
                    <ion-icon name="chevron-back-outline" class="text-lg"></ion-icon>
                    <span class="md:inline hidden"> Retour</span>
                </a>
            </div>

            <!-- title -->
            <h1 class="text-2xl font-bold mt-2" style="font-size: 1.5em;margin: 10px 5px;line-height: 3rem;"> <?php echo $array_cour['Name_c']; ?> </h1>

            <!-- sidebar list -->
            <div class="sidebar_inner" data-simplebar>
                <?php
                $req_cccc = "SELECT * FROM steps WHERE ID_checkout=" . $array_vr['ID'] . " ";
                $exec_cccc = mysqli_query($conn, $req_cccc);
                $array_cccc = mysqli_fetch_array($exec_cccc);


                $sttp_now = $array_cccc['Steps'];

                $pourctage = (($sttp_now  / $all_steps) * 100);

                ?>
                <div class="relative overflow-hidden rounded-md bg-gray-200 h-1 mt-4" style="height: 0.5rem;">
                    <div class="w-2/4 h-full bg-green-500" style="width: <?php echo $pourctage; ?>%;"></div>
                </div>

                <div class="mt-2 text-sm border-b pb-3">
                    <div style="font-size: 1.5em;margin: 10px 0;"> <?php echo ceil($pourctage); ?>% Complete</div>
                </div>

                <div id="curriculum">
                    <dov uk-accordion="multiple: true" class="p-4 divide-y space-y-3">

                        <?php
                        $req_sec = "SELECT * FROM section WHERE course_id = " . $array_cour['ID_c'] . " ORDER BY orderr ";
                        $exec_sec = mysqli_query($conn, $req_sec);
                        $sect_num = 1;
                        $pi = 0;
                        while ($array_sec = mysqli_fetch_array($exec_sec)) {                        ?>
                            <div class="uk-open">
                                <a class="uk-accordion-title text-md mx-2 font-semibold" href="#">
                                    <div class="mb-1 text-sm font-medium"> Section <?php echo $sect_num; ?> </div> <?php echo $array_sec['title']; ?>
                                </a>
                                <div class="uk-accordion-content mt-3">

                                    <ul class="course-curriculum-list">
                                        <?php $req_vs = "SELECT * FROM lesson WHERE section_id = " . $array_sec['ID'] . " ";
                                        $exec_vs = mysqli_query($conn, $req_vs);
                                        while ($array_vs = mysqli_fetch_array($exec_vs)) { ?>
                                            <li>
                                                <?php
                                                $rtt = "SELECT * FROM steps WHERE ID_checkout= " . $array_vr['ID'] . " ";
                                                $ett = mysqli_query($conn, $rtt);
                                                $att = mysqli_fetch_array($ett);
                                                if ($pi <= $att['Steps']) {
                                                ?>

                                                    <a href="index.php?id_c=<?php echo $_GET['id_c']; ?>&step=<?php echo $pi ?>" style="<?php if ($pi == $_GET['step']) {
                                                                                                                                            echo "background-color: #ed0b4c;color: white !important;";
                                                                                                                                        } ?>">
                                                        <i class='fa fa-play-circle' style="font-size: 1.2em;<?php if ($pi == $_GET['step']) {
                                                                                                                    echo "background-color: #ed0b4c;color: white !important;";
                                                                                                                } else {
                                                                                                                    echo "color: #909090 !important;";
                                                                                                                } ?>"></i><?php echo $array_vs['title']; ?> <span class="" style="margin-left: auto;"> <?php echo "  " . $array_vs['duration']; ?> min </span>
                                                    </a>
                                                    <?php if (!empty($array_vs['doc'])) { ?>
                                                        <label class="dropdown">

                                                            <div class="dd-button" style="padding: 4px 8px;font-size: 13px;line-height: 1.35135;border-radius: 2px;padding-right: 40px!important;">
                                                                <i class='fa fa-folder-open' style="color: #F8D775;"></i> Ressources
                                                            </div>

                                                            <input type="checkbox" class="dd-input" id="test">
                                                            <div class="dd-menu">


                                                                <a href="../uploads/cours/doc/<?php echo $array_vs['doc']; ?>" target="_blank"><?php echo $array_vs['doc']; ?></a>

                                                            </div>

                                                        </label>

                                                    <?php } ?>

                                                <?php } else { ?>

                                                    <a style="cursor:not-allowed"><i class='fa fa-play-circle' style="font-size: 1.2em;color:#585757;"></i> <?php echo $array_vs['title']; ?> <span class="" style="margin-left: auto;"> <?php echo "  " . $array_vs['duration']; ?> min </span>
                                                    </a>
                                                <?php  } ?>

                                            </li>
                                        <?php
                                            $pi++;
                                        } ?>
                                        <li>
                                            <?php
                                            $rtt = "SELECT * FROM steps WHERE ID_checkout= " . $array_vr['ID'] . " ";
                                            $ett = mysqli_query($conn, $rtt);
                                            $att = mysqli_fetch_array($ett);
                                            if ($pi <= $att['Steps']) {
                                            ?>
                                                <a href="index.php?id_c=<?php echo $_GET['id_c']; ?>&step=<?php echo $pi ?>" style="<?php if ($pi == $_GET['step']) {
                                                                                                                                        echo "background-color: #ed0b4c;color: white !important;";
                                                                                                                                    } ?>">
                                                    <i class='fa fa-puzzle-piece' style="font-size: 1.2em;<?php if ($pi == $_GET['step']) {
                                                                                                                echo "color: white !important;";
                                                                                                            } else {
                                                                                                                echo "color: #909090 !important;";
                                                                                                            } ?>"></i> Quiz
                                                </a>
                                            <?php } else { ?>
                                                <a style="cursor: not-allowed;">
                                                    <i class='fa fa-puzzle-piece' style="font-size: 1.2em;color: #585757;"></i> Quiz
                                                </a>
                                            <?php  } ?>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                        <?php
                            $sect_num++;
                            $pi++;
                        } ?>




                    </dov>
                </div>



            </div>

            <!-- overly for mobile -->
            <div class="overly-mobi bg-black bg-opacity-30" uk-toggle="target: .sidebar ; cls: is-active"></div>

        </div>

    </div>


    <!-- Javascript
    ================================================== -->
    <script src="js/js-jquery-3.3.1.min.js"></script>
    <script src="js/js-uikit.js"></script>
    <script src="js/js-tippy.all.min.js"></script>
    <script src="js/js-simplebar.js"></script>
    <script src="js/js-custom.js"></script>
    <script src="js/js-bootstrap-select.min.js"></script>
    <script src="js/dist-ionicons.js"></script>




    <script src="../admin/assets/plugin/bootstrap/js/bootstrap.min.js"></script>
    <!-- Form Wizard -->
    <script src="../admin/assets/plugin/form-wizard/prettify.js"></script>
    <script src="../admin/assets/plugin/form-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="../admin/assets/plugin/jquery-validation/jquery.validate.min.js"></script>
    <script src="../admin/assets/scripts/form.wizard.init.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BMSVieira/moovie.js@latest/js/moovie.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var demo = new Moovie({
                selector: "#example",
                dimensions: {
                    width: "100%"
                }
            });
        });
    </script>
    <script src="css/drop.js"></script>


</body>

</html>
<?php
ob_end_flush();
?>