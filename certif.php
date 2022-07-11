<?php
ob_start();
$pagetitle = "Certificate";
include 'header.php';


if (isset($_POST['suivant'])) {

    $id_sess = $_POST['ID_sess'];
    $id_cour = $_POST['ID_cour'];
    $type = $_POST['type'];
    
    $req_check_certif = "SELECT * FROM `certificate` WHERE `ID_sess` = '" . $id_sess . "' AND `ID_cours` ='" . $id_cour . "' AND Type = '".$type."' ";
    $exec_check_certif = mysqli_query($conn, $req_check_certif);
    $check_certif = mysqli_num_rows($exec_check_certif);
    if ($check_certif !== 0) {
        header("location: mescours.php#certificate");
    } else {
        $type = $_POST['type'];

        if ($type == 'E-learning') {

            $req_cour = "SELECT * FROM cours WHERE ID_c = " . $id_cour . " ";
            $exec_cour = mysqli_query($conn, $req_cour);
            $array_cour = mysqli_fetch_array($exec_cour);
        }
        if ($type == 'Direct') {



            $req_cour = "SELECT * FROM events WHERE id = " . $id_cour . " ";
            $exec_cour = mysqli_query($conn, $req_cour);
            $array_cour = mysqli_fetch_array($exec_cour);
            
            
            
            
            $req_for = "SELECT * FROM formations_live WHERE ID_f = " . $array_cour['ID_f'] . " ";
            $exec_for  = mysqli_query($conn, $req_for);
            $array_for  = mysqli_fetch_array($exec_for);
    
    
            
        }

        $req_user = "SELECT * FROM clients WHERE ID = " . $id_sess . " ";
        $exec_user = mysqli_query($conn, $req_user);
        $array_user = mysqli_fetch_array($exec_user);

        $code = "SMARTTEC-" . (rand(1000, 9999)) . $id_sess . $id_cour;

        $date_now = date("Y-m-d");


if ($type == 'E-learning') {

        $name_img = $array_cour['Name_c'] . $id_sess . '.pdf';
}
if ($type == 'Direct') {
    
        $name_img = $array_cour['title'] . $id_sess . '.pdf';
    
}

?>


        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page-content ">

            <div class="page-section bg-alt border-bottom-2">
                <div class="container page__container">

                    <div class="d-flex flex-column flex-lg-row align-items-center">
                        <div class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                            <h1 class="h2 mb-8pt"><i class="fa fa-award" style="color:#A57164;"> </i> Destinaire du certificat: <?php echo $array_user['fullname']; ?> </h1>
                            <?php 
                            if ($type == 'E-learning') {
                                ?>
                            <div class="card-title mb-4pt">
                                <?php echo $type; ?>Le document ci-dessus certifie que <span style="text-transform: uppercase;" class="text-danger"><?php echo $array_user['fullname']; ?></span> a validé le cours <span style="text-transform: uppercase;" class="text-danger"><?php  echo $array_cour['Name_c']; ?></span> le <span class="text-danger"><?php echo $date_now; ?></span>, enseigné par SmarTTec. <br>Le certificat indique que le participant a suivi et validé le cours dans son intégralité.
                            </div>
                            <?php 
                            }
                            if ($type == 'Direct') {
                                
                                ?>
                            <div class="card-title mb-4pt">
                                Le document ci-dessus certifie que <span style="text-transform: uppercase;" class="text-danger"><?php echo $array_user['fullname']; ?></span> a validé la formation <span style="text-transform: uppercase;" class="text-danger"><?php  echo $array_for['Name_f']; ?> </span> le <span class="text-danger"><?php echo $date_now; ?></span>, enseigné par SmarTTec. <br>Le certificat indique que le participant a suivi et validé la formation dans son intégralité.
                            </div>
                            <?php } ?>
                        </div>
                        <div class="ml-lg-16pt">
                            <a href="mescours.php" class="btn btn-light">Mes cours</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="page-section border-bottom-2">
                <div class="container page__container" style="max-width: 100%;">
                    <div class="page-separator">
                        <div class="page-separator__text">Certificat</div>
                    </div>
                    <div class="row align-items-start">


                        <div class="col-md-8">
<?php
//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cms_smarttec_adm/certif' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'cms_smarttec_adm/certif/';

include "qrlib.php";

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);


//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'M';


$matrixPointSize = 2;

$data_link = "https://e-smarttec.com/verification.php?prenom=".str_replace(" ","+",$array_user['fullname'])."&code=".$code."&verify=";
// user data
    $filename = $PNG_TEMP_DIR . 'certif' . md5($data_link . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
    QRcode::png($data_link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    //display generated file
// echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /><hr/>';
?>
                            <div class="card card-body">
                                    <?php 
                            if ($type == 'E-learning') {
                                ?>
                                <embed style="height: 627px;" src="test_certif/index.php?genre=<?php echo $array_user['genre']; ?>&img=<?php echo "../".$PNG_WEB_DIR . basename($filename); ?>&nom=<?php echo $array_user['fullname']; ?>&cours=<?php echo $array_cour['Name_c'] ?>&certifcode=<?php echo $code; ?>&id_cours=<?php echo $array_cour['ID_c']; ?>&id_session=<?php echo $array_user['ID'] ?>&date_certif=<?php echo $date_now; ?>"></embed>
                            <?php 
                            }
                            if ($type == 'Direct') {
                                
                                ?>
                       <embed style="height: 627px;" src="test_certif/index.php?genre=<?php echo $array_user['genre']; ?>&nom=<?php echo $array_user['fullname']; ?>&img=<?php echo "../".$PNG_WEB_DIR . basename($filename); ?>&date_debut=<?php echo $array_cour['start_event']; ?>&date_fin=<?php echo $array_cour['end_event']; ?>&cours=<?php echo $array_for['Name_f'] ?>&contenue1=<?php echo $array_for['contenue1'] ?>&contenue2=<?php echo $array_for['contenue2'] ?>&contenue3=<?php echo $array_for['contenue3'] ?>&contenue4=<?php echo $array_for['contenue4'] ?>&contenue5=<?php echo $array_for['contenue5'] ?>&contenue6=<?php echo $array_for['contenue6'] ?>&certifcode=<?php echo $code; ?>&id_cours=<?php echo $array_for['ID_f']; ?>&id_session=<?php echo $array_user['ID'] ?>&date_certif=<?php echo $date_now; ?>"></embed>
                            <?php } ?>
</div>
                        </div>
                        <div class="col-md-4">

                            <div class="card">
                                <div class="card-header text-center">
                                        <?php 
                            if ($type == 'E-learning') {
                                ?>
                                    <a href="downloadcertif.php?code=<?php echo $code ?>&user=<?php echo $array_user['ID'] ?>&cours=<?php echo $array_cour['ID_c']; ?>&pdf=<?php echo $name_img; ?>" class="btn btn-accent" style="background: #5567ff;border-color: #5567ff;">Télécharger</a>
                                    <?php 
                            }
                            if ($type == 'Direct') {
                                
                                ?>
                                  <a href="downloadcertif.php?code=<?php echo $code; ?>&user=<?php echo $array_user['ID'] ?>&cours=<?php echo $array_cour['ID_f']; ?>&pdf=<?php echo $name_img; ?>" class="btn btn-accent" style="background: #5567ff;border-color: #5567ff;">Télécharger</a>
                                 <?php } ?>   
                                <a href="mescours.php#carouselExampleFade" class="btn btn-accent">Mes Certificat</a>
                                
                                </div>
                                     <?php 
                            if ($type == 'E-learning') {
                                ?>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex" style="border: none;">
                                        <div style="background: black;position: relative;">
                                            <div style="opacity:0.7;">
                                                <a href="enroll-cours.php?id_c=<?php echo $array_cour['ID_c']; ?>">
                                                    <img src="uploads/cours/img/<?php echo $array_cour['Image']; ?>" style="width: 100%;" />
                                                </a>
                                            </div>
                                            <a href="enroll-cours.php?id_c=<?php echo $array_cour['ID_c']; ?>" style="position: absolute;color: white;top: 28%;left: 40.5%;width: 55px;height: 55px;text-align: center;padding: 4.5%;background: rgba(0,0,0,0.5);border-radius: 50%;border: solid white 1.5px;"><i class="fa fa-play"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex">
                                        <a class="card-title mb-4pt" href="enroll-cours.php?id_c=<?php echo $array_cour['ID_c']; ?>"><i class="fa fa-trophy" style="color:#A57164"> </i>&nbsp; <?php echo $array_cour['Name_c']; ?></a>
                                    </div>
                                </div>
                                <?php 
                            }
                            if ($type == 'Direct') {
                                
                                ?>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex" style="border: none;">
                                        <div style="background: black;position: relative;">
                                            <div style="opacity:0.7;">
                                                <a href="enroll-direct.php?id_l=<?php echo $array_for['ID_f']; ?>">
                                                    <img src="uploads/formations/img/<?php echo $array_for['Image']; ?>" style="width: 100%;" />
                                                </a>
                                            </div>
                                            <a href="enroll-direct.php?id_l=<?php echo $array_for['ID_f']; ?>" style="position: absolute;color: white;top: 28%;left: 40.5%;width: 55px;height: 55px;text-align: center;padding: 4.5%;background: rgba(0,0,0,0.5);border-radius: 50%;border: solid white 1.5px;"><i class="fa fa-play"></i></a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex">
                                        <a class="card-title mb-4pt" href="enroll-direct.php?id_l=<?php echo $array_for['ID_f']; ?>"><i class="fa fa-trophy" style="color:#A57164"> </i>&nbsp; <?php echo $array_for['Name_f']; ?></a>
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
if ($type == 'E-learning') {

        $req_ins = "INSERT INTO `certificate` (`ID_sess`, `ID_cours`, `PDF`, `Type`,`code_certif`, `date_certif`) VALUES('" . $id_sess . "','" . $id_cour . "','" . $name_img . "','" . $type . "','" . $code . "','" . $date_now . "')";
        $exec_ins = mysqli_query($conn, $req_ins);
}
if ($type == 'Direct') {
        $req_ins = "INSERT INTO `certificate` (`ID_sess`, `ID_cours`, `PDF`, `Type`,`code_certif`, `date_certif`) VALUES('" . $id_sess . "','" . $array_for['ID_f'] . "','" . $name_img . "','" . $type . "','" . $code . "','" . $date_now . "')";
        $exec_ins = mysqli_query($conn, $req_ins);
    }
    }
} else {
    header('location:index.php');
}
include 'footer.php';
ob_end_flush();
?>