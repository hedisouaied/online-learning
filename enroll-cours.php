<?php
ob_start();
$enroll = "E-learning";
$pagetitle = "Formation 100% E-learning";
include 'header.php';
$query = "SELECT * FROM `cours` WHERE ID_c =  " . $_GET['id_c'] . " ";

$exec = mysqli_query($conn, $query);
$check = mysqli_num_rows($exec);
if ($check == 0) {
    header("location:index.php");
}
$array = mysqli_fetch_array($exec);

if (isset($_POST['ID_cours'])) {
    $type = "E-learning";
    $user_id = $_SESSION['id'];
    $ID_cours = $_POST['ID_cours'];
    $req_check = "SELECT * FROM `panier` WHERE ID_p = " . $ID_cours . " AND ID_sess = " . $user_id . " AND type_p = '" . $type . "' ";
    $exec_check = mysqli_query($conn, $req_check);
    $check = mysqli_num_rows($exec_check);
    if ($check == 0) {


        $req = "INSERT INTO `panier` (`ID_p`, `ID_sess`, `type_p`,`date`) VALUES ('" . $ID_cours . "','" . $user_id . "','" . $type . "',now())";
        $exec = mysqli_query($conn, $req);
        header("location:" . $_SERVER['REQUEST_URI']);
    }
}
?>
<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                    <div class="avatar avatar mb-16pt mb-md-0 mr-md-16pt">
                        <img src="uploads/cours/img/<?php echo $array['Image']; ?>" class="avatar-img rounded" alt="lesson">
                    </div>
                    <div class="flex">
                        <h1 class="h2 m-0"><?php echo $array['Name_c']; ?></h1>
                        <div class="rating mb-8pt d-inline-flex">
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star_border</i></div>
                        </div>
                    </div>
                </div>
                <div class="ml-lg-16pt">
                    <a href="cours.php" class="btn btn-light">Tous les cours</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="row">
                <div class="col-lg-8">
                    <video class="player__embed d-none" id="example" poster="uploads/cours/img/<?php echo $array['Image']; ?>">
                        <source src="uploads/cours/video/<?php echo $array['video']; ?>" type="video/mp4">
                        <track kind="captions" label="Portuguese" srclang="pt" src="<<path-to-caption.vtt>>">
                        <track kind="captions" label="English" srclang="en" src="<<path-to-caption.vtt>>">
                        Your browser does not support the video tag.
                    </video>


                    <div class="mb-24pt" style="margin-top: 1.5rem!important;">
                        <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                            <i class="material-icons icon--left">schedule</i>
                            <?php
                            $req_v = "SELECT * FROM `lesson` WHERE cours_id = " . $array['ID_c'] . " ";
                            $exec_v = mysqli_query($conn, $req_v);
                            $hours = 0;
                            while ($array_v = mysqli_fetch_array($exec_v)) {
                                $hours = $hours + $array_v['duration'];
                            }
                            echo ceil($hours / 60);


                            ?>&nbsp;heures
                        </span>
                        <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                            <i class="material-icons icon--left">assessment</i>
                            <?php echo $array['level']; ?>
                        </span>
                    </div>
                    <div class="border-left-2 page-section pl-32pt mb-32pt">
                        <?php

                        $req_sec = "SELECT * FROM `section` WHERE course_id = " . $array['ID_c'] . " ";
                        $exec_sec = mysqli_query($conn, $req_sec);
                        $sec_count = 1;
                        while ($array_sec = mysqli_fetch_array($exec_sec)) {

                        ?>


                            <div class="d-flex align-items-center page-num-container">
                                <div class="page-num"><?php echo $sec_count; ?></div>
                                <h4><?php echo $array_sec['title']; ?></h4>
                            </div>



                            <ul class="accordion accordion--boxed js-accordion measure-paragraph-max mb-32pt mb-lg-64pt" id="toc-<?php echo $sec_count; ?>">
                                <li class="accordion__item">
                                    <!-- class open for collapse icon down in "accordion__item open" -->
                                    <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-<?php echo $sec_count; ?>" href="#toc-content-<?php echo $sec_count; ?>">
                                        <?php
                                        $req_vid = "SELECT * FROM `lesson` WHERE cours_id = " . $array['ID_c'] . " AND section_id =" . $array_sec['ID'] . " ";
                                        $exec_vid = mysqli_query($conn, $req_vid);
                                        $count_vid = mysqli_num_rows($exec_vid);
                                        ?>
                                        <span class="flex"><?php echo $count_vid . " Leçons"; ?></span>
                                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <div class="accordion__menu">
                                        <ul class="list-unstyled collapse show" id="toc-content-<?php echo $sec_count; ?>">
                                            <?php

                                            while ($array_vid = mysqli_fetch_array($exec_vid)) {
                                            ?>
                                                <li class="accordion__menu-link">
                                                    <span class="material-icons icon-16pt icon--left text-body">play_circle_outline</span>
                                                    <a class="flex" href=""><?php echo $array_vid['title']; ?></a>
                                                    <span class="text-muted"><?php echo $array_vid['duration'] . " min";  ?></span>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>

                        <?php
                            $sec_count++;
                        } ?>
                    </div>

                    <div class="row mb-32pt">
                        <div class="col-md-12">
                            <div class="page-separator">
                                <div class="page-separator__text ">Ce que vous apprendrez</div>
                            </div>
                            <?php
                            $str = $array['whatyou'];
                            $arr = explode(",", $str);
                            for ($i = 0; $i < count($arr); $i++) {

                            ?>
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-center">
                                        <span class="material-icons text-50 mr-8pt">check</span>
                                        <span class="text-70"><?php echo $arr[$i]; ?></span>
                                    </li>

                                </ul>
                            <?php   } ?>
                        </div>
                        <div class="col-md-12">
                            <div class="page-separator">
                                <div class="page-separator__text">À propos de ce cours</div>
                            </div>
                            <p class="text-70"><?php echo $array['Desc_c']; ?></p>
                        </div>



                    </div>




                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body py-16pt text-center">

                            <?php
                            if (isset($_SESSION['client'])) {
                                $req_check_res = "SELECT * FROM checkout WHERE type_p = 'E-learning' AND ID_sess = " . $_SESSION['id'] . " AND ID_p = " . $_GET['id_c'] . " ";
                                $exec_check_res = mysqli_query($conn, $req_check_res);
                                $check_res = mysqli_num_rows($exec_check_res);
                                $array_check_res = mysqli_fetch_array($exec_check_res);
                                if ($check_res == 0) {
                            ?>
                                    <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                        <i class="material-icons">shopping_cart</i>
                                    </span>
                                    <h4 class="card-title"><strong>Déverrouiller le cours</strong></h4>
                                    <p class="card-subtitle text-70 mb-24pt">Accédez à toutes les leçons du cours</p>
                                    <form action="" method="POST">
                                        <input type="hidden" value="<?php echo $array['ID_c'] ?>" name="ID_cours" />
                                        <input class="btn btn-accent mb-8pt" type="submit" value="Ajouter au panier - <?php echo $array['price']; ?> $" />

                                    </form>
                                <?php } else { ?>

                                    <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                        <i class="fa fa-exclamation-circle fa-2x"></i>
                                    </span>
                                    <h4 class="card-title"><strong>Vous avez acheté ce cours le </strong> </h4>
                                    <h4 class="card-title"><strong><?php echo $array_check_res['date']; ?></strong> </h4>
                                    <br>
                                    <a href="mescours.php" class="btn btn-accent mb-8pt">Accédez au cours</a>
                            <?php    }
                            } ?>
                            <?php
                            if (!isset($_SESSION['client'])) {
                            ?>
                                <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                    <i class="material-icons">shopping_cart</i>
                                </span>
                                <h4 class="card-title"><strong>Déverrouiller le cours</strong></h4>
                                <p class="card-subtitle text-70 mb-24pt">Accédez à toutes les leçons du cours</p>
                                <a href="login.php?location=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-accent mb-8pt">Ajouter au panier - <?php echo $array['price']; ?> $</a>
                            <?php } ?>
                            <?php
                            if (!isset($_SESSION['client'])) {
                            ?>

                                <p class="mb-0">Avez vous un compte? <a href="login.php?location=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">se connecter</a></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="page-separator">
                        <div class="page-separator__text">Auteur</div>
                    </div>

                    <div class="media align-items-center mb-16pt">
                        <span class="media-left mr-16pt">
                            <img src="uploads/logo/black.svg" width="40" alt="avatar" class="rounded-circle">
                        </span>
                        <div class="media-body">
                            <a class="card-title m-0">SmarTTec</a>
                            <p class="text-50 lh-1 mb-0">admin</p>
                        </div>
                    </div>
                    <?php
                    $req_about = "SELECT * FROM about ";
                    $exec_about = mysqli_query($conn, $req_about);
                    $array_about = mysqli_fetch_array($exec_about);
                    ?>
                    <p class="text-70"><?php echo $array_about['Text']; ?></p>

                    <!-- <a href="teacher-profile.html" class="btn btn-white mb-24pt">Follow</a> -->

                    <div class="page-separator">
                        <div class="page-separator__text">Recommandées</div>
                    </div>

                    <?php
                    $req_rec = "SELECT * FROM cours WHERE ID_c != " . $_GET['id_c'] . " ORDER BY RAND() LIMIT 4";
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
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <div class="col-lg-12">

                    <!-- rating start -->

                    <div class="container">
                        <div class="page-separator">
                            <div class="page-separator__text">Avis de nos clients</div>
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        <h1 class="text-warning mt-4 mb-4">
                                            <b><span id="average_rating">0.0</span> / 5</b>
                                        </h1>
                                        <div class="mb-3">
                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                            <i class="fas fa-star star-light mr-1 main_star"></i>
                                        </div>
                                        <h3><span id="total_review">0</span> Review</h3>
                                    </div>

                                    <?php
                                    if (isset($_SESSION['client'])) {
                                        $req_b_r = "SELECT  * FROM checkout WHERE ID_p = " . $_GET['id_c'] . " AND type_p = 'E-learning' AND ID_sess = " . $_SESSION['id'] . " AND Paid = 1 ";
                                        $exec_b_r = mysqli_query($conn, $req_b_r);
                                        $check_b_r = mysqli_num_rows($exec_b_r);
                                        $req_b_rr = "SELECT  * FROM review_table WHERE cours_ID = " . $_GET['id_c'] . " AND Type_c = 'E-learning' AND user_ID = " . $_SESSION['id'] . " ";
                                        $exec_b_rr = mysqli_query($conn, $req_b_rr);
                                        $check_b_rr = mysqli_num_rows($exec_b_rr);
                                    }
                                    ?>

                                    <div class="col-sm-<?php
                                                        if (($check_b_r > 0) && ($check_b_rr == 0)) {
                                                            echo "4";
                                                        } else {
                                                            echo "8";
                                                        }
                                                        ?>">
                                        <p>
                                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                        <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                        </div>

                                        </p>
                                        <p>
                                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                        <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                        </div>
                                        </p>
                                        <p>
                                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                        </div>
                                        </p>
                                        <p>
                                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                        </div>
                                        </p>
                                        <p>
                                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                        </div>
                                        </p>
                                    </div>
                                    <?php
                                    if (($check_b_r > 0) && ($check_b_rr == 0)) {
                                    ?>
                                        <div class="col-sm-4 text-center">
                                            <h3 class="mt-4 mb-3">Donnez Votre Avis</h3>
                                            <button type="button" name="add_review" id="add_review" class="btn btn-primary">Avis</button>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                        <div class="mt-5" id="review_content"></div>
                    </div>
                    <div style="z-index: 1;" id="review_modal" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document" style="margin:6.75rem auto;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Submit Review</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="text-center mt-2 mb-4">
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                                    </h4>
                                    <div class="form-group">
                                        <input type="hidden" name="user_name" id="user_name" class="form-control" value="<?php echo $_SESSION['name']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                                    </div>
                                    <div class="form-group text-center mt-4">
                                        <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .progress-label-left {
                            float: left;
                            margin-right: 0.5em;
                            line-height: 1em;
                        }

                        .progress-label-right {
                            float: right;
                            margin-left: 0.3em;
                            line-height: 1em;
                        }

                        .star-light {
                            color: #e9ecef;
                        }

                        .modal-backdrop.show {
                            opacity: 0;
                            z-index: -1;
                        }
                    </style>


                    <!-- rating end -->

                </div>
            </div>

        </div>
    </div>

</div>
<!-- // END Header Layout Content -->

<?php include 'footer.php'; ?>

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
<?php ob_end_flush(); ?>