<?php
ob_start();
$pagetitle = "Certificate";
include 'header.php';


if (isset($_GET['key'])) {


    $req_check_certif = "SELECT * FROM `certificate` WHERE `code_certif` = '" . $_GET['key'] . "' ";
    $exec_check_certif = mysqli_query($conn, $req_check_certif);
    $check_certif = mysqli_num_rows($exec_check_certif);
    $array_certif = mysqli_fetch_array($exec_check_certif);
    if ($check_certif == 0) {
        echo "il n'a pas de certificats";
    } else {
        $type = $array_certif['Type'];

        if ($type == 'E-learning') {

            $req_cour = "SELECT * FROM cours WHERE ID_c = " . $array_certif['ID_cours'] . " ";
            $exec_cour = mysqli_query($conn, $req_cour);
            $array_cour = mysqli_fetch_array($exec_cour);
            $cour_name = $array_cour['Name_c'];
            $id_cours = $array_cour['ID_c'];
            $img_cour = $array_cour['Image'];
            $echo = "le cours";
        } else {
            $req_cour = "SELECT * FROM formations_live WHERE ID_f = " . $array_certif['ID_cours'] . " ";
            $exec_cour = mysqli_query($conn, $req_cour);
            $array_cour = mysqli_fetch_array($exec_cour);
            $cour_name = $array_cour['Name_f'];
            $id_cours = $array_cour['ID_f'];
            $img_cour = $array_cour['Image'];
            $echo = "la formation";
        }

        $req_user = "SELECT * FROM clients WHERE ID = " . $array_certif['ID_sess'] . " ";
        $exec_user = mysqli_query($conn, $req_user);
        $array_user = mysqli_fetch_array($exec_user);


?>


        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">

            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">

                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt"><i class="fa fa-award" style="color:#A57164;"> </i> Destinaire du certificat: <?php echo $array_user['fullname']; ?> </h1>
                            <div class="card-title mb-4pt">
                                Le document ci-dessus certifie que <span style="text-transform: uppercase;" class="text-danger"><?php echo $array_user['fullname']; ?></span> a validé <?php echo $echo;  ?> <span style="text-transform: uppercase;" class="text-danger"><?php echo $cour_name; ?></span> le <span class="text-danger"><?php echo $array_certif['date_certif']; ?></span>, enseigné par SmarTTec. <br>Le certificat indique que le participant a suivi et validé <?php echo $echo;  ?> dans son intégralité.
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="page-section border-bottom-2">
                <div class="container page__container">
                    <div class="page-separator">
                        <div class="page-separator__text">Certificat</div>
                    </div>
                    <div class="row align-items-start">


                        <div class="col-md-8">

                            <div class="card card-body">
                                <img src="test_certif/certificate/<?php echo $array_certif['code_certif'] . $array_certif['ID_sess'] . $array_certif['ID_cours'] ?>.jpg" />
                            </div>


                        </div>
                        <div class="col-md-4">

                            <div class="card">
                                <?php
                                if ((isset($_SESSION['id'])) && ($_SESSION['id'] == $array_certif['ID_sess'])) {


                                ?>
                                    <div class="card-header text-center">

                                        <a href="downloadcertif.php?code=<?php echo $array_certif['code_certif'] ?>&user=<?php echo $array_certif['ID_sess'] ?>&cours=<?php echo $array_certif['ID_cours']; ?>&pdf=<?php echo $array_certif['PDF']; ?>" class="btn btn-accent" style="background: #5567ff;border-color: #5567ff;">Télécharger</a>


                                        <a href="mescours.php#carouselExampleFade" class="btn btn-accent">Mes Certificat</a>
                                    </div>
                                <?php } ?>
                                <?php
                                if ($type == 'E-learning') {
                                ?>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex" style="border: none;">
                                            <div style="background: black;position: relative;">
                                                <div style="opacity:0.7;">
                                                    <a href="enroll-cours.php?id_c=<?php echo $id_cours; ?>">
                                                        <img src="uploads/cours/img/<?php echo $img_cour; ?>" style="width: 100%;" />
                                                    </a>
                                                </div>
                                                <a href="enroll-cours.php?id_c=<?php echo $id_cours; ?>" style="position: absolute;color: white;top: 28%;left: 40.5%;width: 55px;height: 55px;text-align: center;padding: 5.5%;background: rgba(0,0,0,0.5);border-radius: 50%;border: solid white 1.5px;"><i class="fa fa-play"></i></a>
                                            </div>
                                        </div>
                                        <div class="list-group-item d-flex">
                                            <a class="card-title mb-4pt" href="enroll-cours.php?id_c=<?php echo $id_cours; ?>"><i class="fa fa-trophy" style="color:#A57164"> </i>&nbsp; <?php echo $cour_name; ?></a>
                                        </div>
                                    </div>
                                <?php } else {
                                ?>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex" style="border: none;">
                                            <div style="background: black;position: relative;">
                                                <div style="opacity:0.7;">
                                                    <a href="enroll-direct.php?id_l=<?php echo $id_cours; ?>">
                                                        <img src="uploads/formations/img/<?php echo $img_cour; ?>" style="width: 100%;" />
                                                    </a>
                                                </div>
                                                <a href="enroll-direct.php?id_l=<?php echo $id_cours; ?>" style="position: absolute;color: white;top: 28%;left: 40.5%;width: 55px;height: 55px;text-align: center;padding: 5.5%;background: rgba(0,0,0,0.5);border-radius: 50%;border: solid white 1.5px;"><i class="fa fa-play"></i></a>
                                            </div>
                                        </div>
                                        <div class="list-group-item d-flex">
                                            <a class="card-title mb-4pt" href="enroll-direct.php?id_l=<?php echo $id_cours; ?>"><i class="fa fa-trophy" style="color:#A57164"> </i>&nbsp; <?php echo $cour_name; ?></a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- // END Header Layout Content -->

        <!-- Footer -->

<?php



    }
} else {
    header("location: index.php");
}
include 'footer.php';
ob_end_flush();
?>