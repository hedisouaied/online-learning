<?php
$pagetitle = "Lessons E-learning";
include "connexion.php";
$msg = "";
if (isset($_POST['add'])) {

    $session_id = mysqli_real_escape_string($conn, $_GET['session_id']);
    $date =  $_POST['date'];
    $start =  $_POST['heure_start'];
    $end =  $_POST['heure_end'];
    $zoom =  $_POST['zoom'];

    $videos = array();

    $videos = $_FILES['file']['name'];

    $i = count($videos);



    for ($j = 0; $j < $i; $j++) {

        $ss = $start[$j];
        $ee = $end[$j];
        $tt = $date[$j];
        $zz = $zoom[$j];

        $errors = array();

        $file = "";
        // start file upload
        if (!empty($_FILES['file']['name'][$j])) {
            $file_name1 = mysqli_real_escape_string($conn, $_FILES['file']['name'][$j]);
            $file_tmp1 = $_FILES['file']['tmp_name'][$j];
            
            $avatarextensions = explode(".",$file_name1) ;
            $avatarextension = strtolower( end( $avatarextensions ) );
            $file = time() . '_' ."smarttec_doc.". $avatarextension;
            move_uploaded_file($file_tmp1, "../uploads/live/doc/" . $file);
            // end file upload
        }

        $req = "INSERT INTO `seance` (`session_id`, `date`, `start_time`, `end_time`,`zoom_link`, `doc`) VALUES('" . $session_id . "','" . $tt . "','" . $ss . "','" . $ee . "','" . $zz . "','" . $file . "')";



        $exec = mysqli_query($conn, $req);

        if ($exec) {
            $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Well done!</strong> Votre Lesson a été ajouté.
        </div>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Oh snap!</strong> Lesson non ajouté!!! 
        </div>";
        }
    }
}


if (isset($_POST['modifier'])) {
    $id_m = $_POST['id_m'];
    $date_m = $_POST['date_m'];
    $heure_start_m = $_POST['heure_start_m'];
    $heure_end_m = $_POST['heure_end_m'];
    $zoom_m = $_POST['zoom_m'];

    $query1 = "SELECT * FROM seance where ID=" . $id_m . " ";


    $exec1 = mysqli_query($conn, $query1);

    $array = mysqli_fetch_array($exec1);


    $file_m = $array['doc'];



    if (!empty($_FILES['file_m']['name'])) {
        $file_name1 = mysqli_real_escape_string($conn, $_FILES['file_m']['name']);
        $avatarextensions = explode(".",$file_name1) ;
        $avatarextension = strtolower( end( $avatarextensions ) );
        $file_tmp1 = $_FILES['file_m']['tmp_name'];
        $file_m = time() . '_' ."smarttec_doc.". $avatarextension;
        move_uploaded_file($file_tmp1, "../uploads/live/doc/" . $file_m);
        // end file upload
    }



    $req = "UPDATE `seance` SET `date`='" . $date_m . "',`start_time`='" . $heure_start_m . "',`end_time`='" . $heure_end_m . "',`doc`='" . $file_m . "',`zoom_link`='" . $zoom_m . "' WHERE ID= " . $id_m . " ";
    $exec = mysqli_query($conn, $req);
}


if (isset($_GET['idppppp'])) {
    $idsec = $_GET['idppppp'];
    $req = "DELETE FROM `seance` WHERE ID=$idsec ";
    $exec = mysqli_query($conn, $req);
    $loccc = 'ajout-seances.php?session_id='.$_GET['session_id'];
    header('location:'.$loccc);
}
?>

<?php include "header.php"; ?>
<!-- /.main-menu -->
<!-- Form Wizard -->
<link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">

<link rel="stylesheet" href="assets/plugin/form-wizard/prettify.css">
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">Séances de Session</h4>

                        <div class="box-content">

                            <div class="dropdown js__drop_down">
                                <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                                <ul class="sub-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else there</a></li>
                                    <li class="split"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                                <!-- /.sub-menu -->
                            </div>
                            <!-- /.dropdown js__dropdown -->
                            <div id="rootwizard-pill">
                                <div class="tab-header pill">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <ul>
                                                <li><a href="#tab-pill1" data-toggle="tab">Ajout Séance</a></li>
                                                <?php
                                                $query1 = "SELECT * FROM seance where session_id = " . $_GET['session_id'] . " ";
                                                $exec1 = mysqli_query($conn, $query1);
                                                $i = 2;
                                                while ($array = mysqli_fetch_array($exec1)) {
                                                ?>
                                                    <li><a href="#tab-pill<?php echo $i; ?>" data-toggle="tab"><?php echo "Séance " . ($i - 1); ?></a></li>

                                                <?php $i++;
                                                } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab-pill1">
                                        <p><?php echo $msg; ?></p>
                                        <div class="card-content">
                                            <form method="POST" enctype="multipart/form-data">

                                                <div id="plus_ins">

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Date de Séance</label>
                                                        <input required type="date" class="form-control" id="exampleInputEmail1" name="date[]">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Heure de début</label>
                                                        <input required type="time" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" name="heure_start[]">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Heure de fin</label>
                                                        <input required type="time" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" name="heure_end[]">
                                                    </div>
                                                    <div style="display: none;">
                                                        <label for="exampleInputEmail1">Document</label>
                                                        <input type="file" name="file[]" id="input-file-now" class="dropify" data-max-file-size="100M" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf" />
                                                    </div>
                                                    <div class="form-group" style="display: none;">
                                                        <label for="exampleInputEmail1">Vidéo de la séance</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le lien" name="zoom[]">
                                                    </div>
                                                    <hr style="border: 3px solid #00aeff;">
                                                </div>

                                                <div>
                                                    <button title="Ajouter une autre formaulaire" type="button" class="plus_ss btn btn-success btn-block"><i class="fa fa-plus"></i></button>
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" name="add">Ajouter</button>
                                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="liste-formations.php">Retour</a>
                                            </form>
                                        </div>
                                    </div>

                                    <?php
                                    $query188 = "SELECT * FROM seance where session_id = " . $_GET['session_id'] . " ";
                                    $exec188 = mysqli_query($conn, $query188);
                                    $i = 2;
                                    while ($array = mysqli_fetch_array($exec188)) {
                                    ?>
                                        <div class="tab-pane" id="tab-pill<?php echo $i; ?>">
                                            <!-- /.row -->

                                            <div class="card-content">
                                                <form method="POST" enctype="multipart/form-data">

                                                    <div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Date de Séance</label>
                                                            <input required type="date" class="form-control" id="exampleInputEmail1" value="<?php $date_new = str_replace('/', '-', $array['date']);
                                                                                                                                            echo date('Y-m-d', strtotime($date_new)); ?>" name="date_m">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Heure de début</label>
                                                            <input required type="time" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" name="heure_start_m" value="<?php echo $array['start_time']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Heure de fin</label>
                                                            <input required type="time" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" name="heure_end_m" value="<?php echo $array['end_time']; ?>">
                                                        </div>
                                                        <div>
                                                            <label for="exampleInputEmail1">Document</label>
                                                            <input type="file" name="file_m" id="input-file-now" class="dropify" data-max-file-size="100M" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" />
                                                            <?php
                                                            if (!empty($array['doc'])) {
                                                            ?>
                                                                <a target="_blank" href="../uploads/live/doc/<?php echo $array['doc']; ?>"><?php echo $array['doc']; ?></a>
                                                            <?php } else {
                                                                echo "Cette séance n'a pas de document";
                                                            }
                                                            ?>
                                                            <img style="width:50px;" src="https://img.icons8.com/windows/2x/file-upload.png" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="id_m" value="<?php echo $array['ID']; ?>">
                                                            <label for="exampleInputEmail1">Vidéo de la séance</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le lien" name="zoom_m" value="<?php echo $array['zoom_link']; ?>">
                                                        </div>
                                                        <hr style="border: 3px solid #00aeff;">
                                                    </div>
                                                    <br>
                                                    <button type="submit" name="modifier" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                                                    <a class="btn btn-danger btn-sm waves-effect waves-light" href="?session_id=<?php echo $_GET['session_id']; ?>&idppppp=<?php echo $array['ID']; ?>">Supprimer sèance <?php echo ($i-1); ?> </a>

                                                    <a class="btn btn-info btn-sm waves-effect waves-light" href="liste-formations.php">Retour</a>
                                                </form>
                                            </div>


                                        </div>
                                    <?php $i++;
                                    } ?>
                                </div>

                                <ul class="pager wizard">
                                    <li class="previous"><a href="javascript:void(0)"><i class="fa fa-angle-double-left fa-2x"></i></a></li>
                                    <li class="next"><a href="javascript:void(0)"><i class="fa fa-angle-double-right fa-2x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php include "footer.php"; ?>