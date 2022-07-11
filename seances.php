<?php
ob_start();
$pagetitle = "Formation En Direct";
include 'header.php';


$query = "SELECT * FROM `events` WHERE id =  " . $_GET['id'] . " ";

$exec = mysqli_query($conn, $query);

$array = mysqli_fetch_array($exec);




$query1 = "SELECT * FROM `formations_live` WHERE ID_f =  " . $array['ID_f'] . " ";

$exec1 = mysqli_query($conn, $query1);

$array1 = mysqli_fetch_array($exec1);



if (isset($_POST['ID_calendar'])) {
    $type = "Direct";
    $user_id = $_SESSION['id'];
    $ID_li = $_POST['ID_calendar'];
    $req_check = "SELECT * FROM `checkout` WHERE ID_p = " . $ID_li . " AND ID_sess = " . $user_id . " AND type_p = '" . $type . "' ";
    $exec_check = mysqli_query($conn, $req_check);
    $check = mysqli_num_rows($exec_check);
    if ($check == 0) {


        $req = "INSERT INTO `checkout` (`ID_p`, `ID_sess`, `type_p`,`date`) VALUES ('" . $ID_li . "','" . $user_id . "','" . $type . "',now())";

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
                        <img src="uploads/formations/img/<?php echo $array1['Image']; ?>" class="avatar-img rounded" alt="lesson">
                    </div>
                    <div class="flex">
                        <h1 class="h2 m-0"><?php echo $array['title']; ?></h1>
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
                    <a href="direct.php" class="btn btn-light">Toutes les Formations</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="row">
                <div class="col-lg-8">
                    <video class="player__embed d-none" id="example" poster="uploads/formations/img/<?php echo $array1['Image']; ?>">
                        <source src="uploads/formations/video/<?php echo $array1['video']; ?>" type="video/mp4">
                        <track kind="captions" label="Portuguese" srclang="pt" src="<<path-to-caption.vtt>>">
                        <track kind="captions" label="English" srclang="en" src="<<path-to-caption.vtt>>">
                        Your browser does not support the video tag.
                    </video>


                    <div class="mb-24pt" style="margin-top: 1.5rem!important;">
                        <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                            <i class="material-icons icon--left">schedule</i>
                            <?php
                            $req_v = "SELECT * FROM `seance` WHERE session_id = " . $array['id'] . " ";
                            $exec_v = mysqli_query($conn, $req_v);
                            echo mysqli_num_rows($exec_v);


                            ?>&nbsp;séances
                        </span>

                    </div>

 <div class="row mb-32pt">
                        <div class="col-md-12">
                            <div class="page-separator">
                                <div class="page-separator__text">À propos de cette session</div>
                            </div>
                            <p class="text-70"><?php echo $array['Description']; ?></p>
                        </div>
                    </div>

                    <div class="border-left-2 page-section pl-32pt mb-32pt">
                        <?php

                        $req_sec = "SELECT * FROM `seance` WHERE session_id = " . $array['id'] . " ";
                        $exec_sec = mysqli_query($conn, $req_sec);
                        $sec_count = 1;
                        while ($array_sec = mysqli_fetch_array($exec_sec)) {

                        ?>




                            <ul class="accordion accordion--boxed js-accordion measure-paragraph-max mb-32pt mb-lg-64pt" id="toc-<?php echo $sec_count; ?>">
                                <li class="accordion__item">
                                    <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-<?php echo $sec_count; ?>" href="#toc-content-<?php echo $sec_count; ?>">

                                        <span class="flex">Seance <?php echo $sec_count; ?></span>
                                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <div class="accordion__menu">
                                        <ul class="list-unstyled collapse show" id="toc-content-<?php echo $sec_count; ?>">

                                            <li class="accordion__menu-link">
                                                <span class="material-icons icon-16pt icon--left text-body">schedule</span>
                                                <a class="flex"><?php echo $array_sec['date']; ?></a>
                                                <span class="text-muted"><?php echo "de " . date("G:i", (strtotime($array_sec['start_time']) - (3600 * $reglo_time))) . " jusqu'à " . date("G:i", (strtotime($array_sec['end_time']) - (3600 * $reglo_time)));  ?></span>
                                            </li>
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
                                <div class="page-separator__text">À propos de cette formation</div>
                            </div>
                            <p class="text-70"><?php echo $array1['Desc_f']; ?></p>
                        </div>
                    </div>



                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body py-16pt text-center">

                            <?php
                            if (isset($_SESSION['client'])) {
                                $req_check_res = "SELECT * FROM checkout WHERE type_p = 'Direct' AND ID_sess = " . $_SESSION['id'] . " AND ID_p = " . $_GET['id'] . " ";
                                $exec_check_res = mysqli_query($conn, $req_check_res);
                                $check_res = mysqli_num_rows($exec_check_res);
                                $array_check_res = mysqli_fetch_array($exec_check_res);
                                if ($check_res == 0) {
                            ?>
                                    <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                        <i class="material-icons">shopping_cart</i>
                                    </span>
                                    <h4 class="card-title"><strong>Déverrouiller la session</strong></h4>
                                    <p class="card-subtitle text-70 mb-24pt">Accédez à toutes les séances de session</p>
                                    <form action="" method="POST">
                                        <input type="hidden" value="<?php echo $array['id'] ?>" name="ID_calendar" />
                                        <input class="btn btn-accent mb-8pt" type="submit" value="Réserver maintenant - <?php echo $array1['price']; ?> $" />

                                    </form>
                                <?php } else { ?>

                                    <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                        <i class="fa fa-exclamation-circle fa-2x"></i>
                                    </span>
                                    <h4 class="card-title"><strong>Vous avez Réserver cette session le </strong> </h4>
                                    <h4 class="card-title"><strong><?php echo $array_check_res['date']; ?></strong> </h4>
                                    <br>
                                    <a href="mescours.php" class="btn btn-accent mb-8pt">Accédez à la session</a>
                            <?php    }
                            } ?>
                            <?php
                            if (!isset($_SESSION['client'])) {
                            ?>
                                <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                    <i class="material-icons">shopping_cart</i>
                                </span>
                                <h4 class="card-title"><strong>Déverrouiller la session</strong></h4>
                                <p class="card-subtitle text-70 mb-24pt">Accédez à toutes les séances de la session</p>
                                <a href="signup.php?location=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>&reserve_id=<?php echo $_GET['id']; ?>" class="btn btn-accent mb-8pt">Réserver maintenant - <?php echo $array1['price']; ?> $</a>
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
                            <a class="card-title m-0" href="teacher-profile.html">SmarTTec</a>
                            <p class="text-50 lh-1 mb-0">admin</p>
                        </div>
                    </div>
                    <?php
                    $req_about = "SELECT * FROM about ";
                    $exec_about = mysqli_query($conn, $req_about);
                    $array_about = mysqli_fetch_array($exec_about);
                    ?>
                    <p class="text-70"><?php echo $array_about['Text']; ?></p>

                    <!-- <a class="btn btn-white mb-24pt">Follow</a> -->

                    <div class="page-separator">
                        <div class="page-separator__text">Recommandées</div>
                    </div>
                    <?php
                    $req_rec = "SELECT * FROM formations_live ORDER BY RAND() LIMIT 4";
                    $exec_rec = mysqli_query($conn, $req_rec);
                    while ($array_rec = mysqli_fetch_array($exec_rec)) {


                    ?>
                        <div class="mb-8pt d-flex align-items-center">
                            <a href="enroll-direct.php?id_l=<?php echo $array_rec['ID_f']; ?>" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                <img src="uploads/formations/img/<?php echo $array_rec['Image']; ?>" alt="Angular Routing In-Depth" class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="enroll-direct.php?id_l=<?php echo $array_rec['ID_f']; ?>"><?php echo $array_rec['Name_f']; ?></a>

                            </div>
                        </div>
                    <?php } ?>

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