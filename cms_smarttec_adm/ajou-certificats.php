<?php
$pagetitle = 'Ajouter une Certificat';
include "connexion.php";

$msge = "";
$msg = "";
$msgd = "";
if (isset($_POST['ajout-certif-e-learning'])) {


    $client = mysqli_real_escape_string($conn, $_POST['client']);
    $cours = mysqli_real_escape_string($conn, $_POST['cours']);
    $date_certif = mysqli_real_escape_string($conn, $_POST['date_certif']);
    $type_p = "E-learning";
    $code = "SMARTTEC-" . (rand(1000, 9999)) . $client . $cours;

    $req_cour = "SELECT * FROM cours WHERE ID_c = " . $cours . " ";
    $exec_cour = mysqli_query($conn, $req_cour);
    $array_cour = mysqli_fetch_array($exec_cour);


    $req_user = "SELECT * FROM clients WHERE ID = " . $client . " ";
    $exec_user = mysqli_query($conn, $req_user);
    $array_user = mysqli_fetch_array($exec_user);

    $name_img = $array_cour['Name_c'] . $client . '.pdf';


    $check_u = "SELECT * FROM `certificate` WHERE `ID_sess` ='" . $client . "' AND `ID_cours` = '" . $cours . "' AND Type = 'E-learning' ";
    $exec_u = mysqli_query($conn, $check_u);
    $check_u = mysqli_num_rows($exec_u);

    if ($check_u !== 0) {
        $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Ce client a déja une certificat!!! </div>";
    } else {

        /*    $req = "INSERT INTO `certificate`(`ID_cours`,`ID_sess`, `Type`, `date_certif`) VALUES('" . $cours . "','" . $client . "','" . $type_p . "', '" . $date_certif . "')";
        $exec = mysqli_query($conn, $req); */
    }
}



if (isset($_POST['ajout-certif-Direct'])) {


    $client = mysqli_real_escape_string($conn, $_POST['client']);
    $cours = mysqli_real_escape_string($conn, $_POST['cours']);
    $session = mysqli_real_escape_string($conn, $_POST['session_f']);
    $date_certif = mysqli_real_escape_string($conn, $_POST['date_certif']);
    $type_p = "Direct";
    $code = mysqli_real_escape_string($conn, $_POST['code_certif']);

    $req_cour = "SELECT * FROM formations_live WHERE ID_f = " . $cours . " ";
    $exec_cour = mysqli_query($conn, $req_cour);
    $array_cour = mysqli_fetch_array($exec_cour);
    
    $req_sess = "SELECT * FROM events WHERE id = " . $session . " ";
    $exec_sess = mysqli_query($conn, $req_sess);
    $array_sess = mysqli_fetch_array($exec_sess);


    $req_user = "SELECT * FROM clients WHERE ID = " . $client . " ";
    $exec_user = mysqli_query($conn, $req_user);
    $array_user = mysqli_fetch_array($exec_user);

    $name_img = $array_cour['Name_f'] . $client . '.pdf';


    $check_u = "SELECT * FROM `certificate` WHERE `ID_sess` ='" . $client . "' AND `ID_cours` = '" . $cours . "' AND Type = 'Direct' ";
    $exec_u = mysqli_query($conn, $check_u);
    $check_u = mysqli_num_rows($exec_u);


   
    
    if ($check_u !== 0) {
        $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Ce client a déja une certificat!!! </div>";
    } else {

        /*    $req = "INSERT INTO `certificate`(`ID_cours`,`ID_sess`, `Type`, `date_certif`) VALUES('" . $cours . "','" . $client . "','" . $type_p . "', '" . $date_certif . "')";
        $exec = mysqli_query($conn, $req); */
    }
}


?>
<!-- Select2 -->

<?php include "header.php"; ?>


<!-- /.main-menu -->
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <div class="box-content">
                            <!-- /.dropdown js__dropdown -->
                            <div id="rootwizard">
                                <div class="tab-header">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <ul>
                                                <li><a href="#tab1" data-toggle="tab">E-learning</a></li>
                                                <li><a href="#tab2" data-toggle="tab"> formation en Direct</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <p><?php echo $msg;
                                            echo $msge;
                                            echo $msgd; ?></p>
                                        <h1 class="box-title">Ajouter une certificat E-learning</h1>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Clients
                                                </label>
                                                <select required name="client" class="form-control select2_1" style="width: 100%;">
                                                    <option value="">Sectionner un client</option>
                                                    <?php
                                                    $query1 = "SELECT * FROM `clients`";

                                                    $exec1 = mysqli_query($conn, $query1);

                                                    while ($array1 = mysqli_fetch_array($exec1)) {

                                                        echo "<option value='" . $array1['ID'] . "' >" . $array1['email'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Cours
                                                </label>
                                                <select required name="cours" class="form-control">
                                                    <option value="">Sectionner un cour</option>
                                                    <?php
                                                    $query2 = "SELECT * FROM `cours`";

                                                    $exec2 = mysqli_query($conn, $query2);

                                                    while ($array2 = mysqli_fetch_array($exec2)) {

                                                        echo "<option value='" . $array2['ID_c'] . "' >" . $array2['Name_c'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="date" name="date_certif" />
                                            </div>
                                            <button type="submit" name="ajout-certif-e-learning" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                            <?php
                                            if (isset($_POST['ajout-certif-e-learning'])) { 
//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'certif' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'certif/';

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
                                                <embed style="height: 0px;" src="../test_certif/index.php?genre=<?php echo $array_user['genre']; ?>&nom=<?php echo $array_user['fullname']; ?>&img=<?php echo "../cms_smarttec_adm/".$PNG_WEB_DIR . basename($filename); ?>&cours=<?php echo $array_cour['Name_c'] ?>&certifcode=<?php echo $code; ?>&id_cours=<?php echo $array_cour['ID_c']; ?>&id_session=<?php echo $array_user['ID'] ?>&date_certif=<?php echo $date_certif; ?>"></embed>
                                            <?php  }
                                            ?>
                                        </form>
                                        <?php
                                        if (isset($_POST['ajout-certif-e-learning'])) {

                                            $req_ins = "INSERT INTO `certificate` (`ID_sess`, `ID_cours`, `PDF`, `Type`,`code_certif`, `date_certif`) VALUES('" . $client . "','" . $cours . "','" . $name_img . "','" . $type_p . "','" . $code . "','" . $date_certif . "')";
                                            $exec_ins = mysqli_query($conn, $req_ins);
                                            if ($exec_ins) {

                                                $msge = "<div class='alert alert-success alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Well done!</strong> Certificat à été ajoutée avec succès.</div>";
                                            } else {
                                                $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Oh snap!</strong> Certificat non ajoutée!!! 
                                </div>";
                                            }
                                            echo $msge;
                                        }

                                        ?>

                                    </div>

                                    <div class="tab-pane" id="tab2">
                                        <h1 class="box-title">Ajouter une certificat de formation en Direct</h1>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Clients
                                                </label>
                                                <select required name="client" class="form-control select2_1" style="width: 100%;">
                                                    <option value="">Sectionner un client</option>
                                                    <?php
                                                    $query1 = "SELECT * FROM `clients`";

                                                    $exec1 = mysqli_query($conn, $query1);

                                                    while ($array1 = mysqli_fetch_array($exec1)) {

                                                        echo "<option value='" . $array1['ID'] . "' >" . $array1['email'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Formations
                                                </label>
                                                <select id="select_formation" required name="cours" class="form-control">
                                                    <option value="">Sectionner une formation</option>
                                                    <?php

                                                    $req_l = "SELECT * FROM formations_live";
                                                    $exec_l = mysqli_query($conn, $req_l);
                                                   

                                                    while ($array2 = mysqli_fetch_array($exec_l)) {

                                                        echo "<option value='" . $array2['ID_f'] . "' >" . $array2['Name_f'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div id="div_session">

                                                
                                            </div>
                                         
                                            <div class="form-group">
                                                <input class="form-control" type="date" name="date_certif" />
                                            </div>
                                            <label>Code de certificat</label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="code de certificat" name="code_certif" />
                                            </div>
                                            <button type="submit" name="ajout-certif-Direct" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                        </form>
                                        
                                        <?php
                                        if (isset($_POST['ajout-certif-Direct'])) {

                                            $req_ins = "INSERT INTO `certificate` (`ID_sess`, `ID_cours`, `PDF`, `Type`,`code_certif`, `date_certif`) VALUES('" . $client . "','" . $cours . "','" . $name_img . "','" . $type_p . "','" . $code . "','" . $date_certif . "')";
                                            $exec_ins = mysqli_query($conn, $req_ins);
                                            if ($exec_ins) {

                                                $msge = "<div class='alert alert-success alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Well done!</strong> Certificat à été ajoutée avec succès.</div>";
                                            } else {
                                                $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Oh snap!</strong> Certificat non ajoutée!!! 
                                </div>";
                                            }
                                            echo $msge;
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-content -->
            </div>
        </div>
    </div>
</div>
<?php 
if (isset($_POST['ajout-certif-Direct'])) { 

 //set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'certif' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'certif/';

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

                                            <iframe style="height: 0px" src="../test_certif/index.php?genre=<?php echo $array_user['genre']; ?>&nom=<?php echo $array_user['fullname']; ?>&img=<?php echo "../cms_smarttec_adm/".$PNG_WEB_DIR . basename($filename); ?>&date_debut=<?php echo $array_sess['start_event']; ?>&date_fin=<?php echo $array_sess['end_event']; ?>&cours=<?php echo $array_cour['Name_f'] ?>&contenue1=<?php echo $array_cour['contenue1'] ?>&contenue2=<?php echo $array_cour['contenue2'] ?>&contenue3=<?php echo $array_cour['contenue3'] ?>&contenue4=<?php echo $array_cour['contenue4'] ?>&contenue5=<?php echo $array_cour['contenue5'] ?>&contenue6=<?php echo $array_cour['contenue6'] ?>&certifcode=<?php echo $code; ?>&id_cours=<?php echo $array_cour['ID_f']; ?>&id_session=<?php echo $array_user['ID'] ?>&date_certif=<?php echo $date_certif; ?>"></iframe>
                                        <?php  }
                                        ?>
<?php include 'footer.php'; ?>

<script>
    $('#select_formation').change(function(){
         //get the selected value
    var selectedValue = this.value;

    //make the ajax call
    $.ajax({
        url: 'fetch_sessions_select.php',
        type: 'POST',
        data: {option : selectedValue},
        success: function(res) {
          //  alert(res);
            $('#div_session').html(res);
        }
    });
    });
</script>