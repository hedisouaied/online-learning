<?php
$pagetitle = "Quiz Formation en direct";
include "connexion.php";

$msg = "";
if (isset($_POST['points'])) {

    $question =  mysqli_real_escape_string($conn, $_POST['question']);
    $points =  mysqli_real_escape_string($conn, $_POST['points']);
    $cours_id = $_GET['cours_id'];


    $logo = "";
    if (!empty($_FILES['logo']['name'])) {
        $errors = array();
        $file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name']);
        $file_size = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $exp = explode('.', $_FILES['logo']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");

        $logo = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/cours/quiz/" . $logo);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }

    /* pour ajouter le question à la base */

    $req_quiz = "INSERT INTO `questions-live` (`question`, `points`, `session_id`, `Image`)
                 VALUES('" . $question . "','" . $points . "','" . $cours_id . "','" . $logo . "' ) ";
    $exe_quizc = mysqli_query($conn, $req_quiz);


    /* pour ajouter le question à la base */


    /* récuperer la derniere question inseréé */

    $req_fetch = "SELECT * FROM `questions-live` ORDER BY `ID` DESC LIMIT 1";
    $exec_fetch = mysqli_query($conn, $req_fetch);
    $array_fetch = mysqli_fetch_array($exec_fetch);
    $dernier_id = $array_fetch['ID'];

    /* récuperer la derniere question inseréé */

    /* les reponses */

    $reponse = $_POST['reponse'];

    $checks = $_POST['checkk'];


    $pp = array();

    foreach ($checks as $tt) {
        $pp[] = $tt;
    }

    $i = count($reponse);

    /* les réponses */




    /* inserer les reponse dans la base en boucle */

    for ($j = 0; $j < $i; $j++) {

        $rr = mysqli_real_escape_string($conn, $reponse[$j]);
        $vf = $pp[$j];



        $req = "INSERT INTO `reponse-live` (`question_id`, `reponse`, `vrai_faux`) VALUES('" . $dernier_id . "','" . $rr . "','" . $vf . "')";

        $exec = mysqli_query($conn, $req);

        if ($exec) {
            $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Well done!</strong> Votre Quiz a été ajouté.
        </div>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Oh snap!</strong> Quiz non ajouté!!! 
        </div>";
        }
    }

    /* inserer les reponse dans la base en boucle */
}

if (isset($_POST['minutes'])) {
    $minutes = mysqli_real_escape_string($conn, $_POST['minutes']);
    $minutes = str_replace(",", ".", $minutes);
    $minutes = $minutes * 60;

        $req_sec_timer = "UPDATE `formations_live` SET `timer`='" . $minutes . "' WHERE ID_f=" . $_GET['cours_id'] . " ";
        $exec_sec_timer = mysqli_query($conn, $req_sec_timer);
    
    
}

if (isset($_POST['limitee'])) {
    $minutes = mysqli_real_escape_string($conn, $_POST['limitee']);

        $req_sec_timer = "UPDATE `formations_live` SET `limit_q`='" . $minutes . "' WHERE ID_f=" . $_GET['cours_id'] . " ";
        $exec_sec_timer = mysqli_query($conn, $req_sec_timer);

    
}


if (isset($_GET['supp_id'])) {
    $idsec = $_GET['supp_id'];
    $req = "DELETE FROM `questions-live` WHERE ID=$idsec ";
    $exec = mysqli_query($conn, $req);
}
$req_cours_1 = "SELECT * FROM formations_live WHERE ID_f =".$_GET['cours_id'];
$exec_cours_1 = mysqli_query($conn, $req_cours_1);
$array_cours_1 = mysqli_fetch_array($exec_cours_1);
?>

<?php include "header.php"; ?>
<!-- /.main-menu -->

<link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">

<link rel="stylesheet" href="assets/plugin/form-wizard/prettify.css">
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">Quiz E-learning</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row" style="padding: 20px;">
                                    <form method="POST" action="">
                                        <div class="col-md-12">
                                           
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    minutes
                                                </label>
                                                <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer les minutes" name="minutes" value="<?php echo $array_cours_1['timer']/60;  ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger" value="modifier" name="timer" >
                                            </div>

                                        </div>
                                    </form>

                                </div>


                            </div>

                            <div class="col-md-6">
                                <div class="row" style="padding: 20px;">
                                    <form method="POST" action="">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    nombres de limite questions
                                                </label>
                                                <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer limite de questions" name="limitee" value="<?php echo $array_cours_1['limit_q']  ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-danger" value="modifier" name="lm">
                                            </div>

                                        </div>
                                    </form>

                                </div>


                            </div>

                        </div>

                        <div class="box-content">
                            <!-- /.dropdown js__dropdown -->
                            <div id="rootwizard-pill">
                                <div class="tab-header pill">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <ul>
                                                <li><a href="#tab-pill1" data-toggle="tab">Ajout Quiz</a></li>
                                               
                                                <li><a href="#tab-pill2" data-toggle="tab">Liste des questions</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab-pill1">
                                        <p><?php echo $msg; ?></p>
                                        <div class="card-content">
                                            <form method="POST" enctype="multipart/form-data">

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">
                                                                question!
                                                            </label>
                                                            <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer la question" name="question">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <div class="form-group">

                                                            <label for="exampleInputEmail1">
                                                                points!
                                                            </label>
                                                            <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer les points" name="points">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="display: flex;">
                                                    <div style="flex: 1;">
                                                        <!-- /.dropdown js__dropdown -->
                                                        <label for="exampleInputEmail1">Image (optionnelle)</label>
                                                        <input accept="image/png,image/jpeg,image/jpg" type="file" name="logo" id="input-file-now" class="dropify" />
                                                    </div>

                                                </div>

                                                <div id="plus_radio_live">
                                                    <!-- /.dropdown js__dropdown -->

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Réponse de la question</label>
                                                        <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer la réponse" name="reponse[]">
                                                    </div>

                                                    <ul class="list-inline">
                                                        <li>
                                                            <div class=" success">
                                                                <input type="radio" checked name="checkk[1]" value="1">
                                                                <label>Vrai</label>
                                                            </div>
                                                            <!-- /.radio -->
                                                        </li>
                                                        <li>
                                                            <div class=" danger">
                                                                <input type="radio" value="0" name="checkk[1]">
                                                                <label>faux</label>
                                                            </div>
                                                            <!-- /.radio -->
                                                        </li>

                                                    </ul>
                                                </div>

                                                <div>
                                                    <button title="Ajouter une autre réponse" type="button" class="plus_rep_live btn btn-success btn-block"><i class="fa fa-plus"></i></button>
                                                </div>
                                                <br>


                                                <br>
                                                <button type="submit" name="ajout_quiz" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="list-cours.php">Retour</a>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="tab-pill2">
                                        <!-- /.row -->

                                        <div class="row">
                                            <?php

                                            $query1 = "SELECT * FROM `questions-live` where session_id =  " . $_GET['cours_id'];


                                            $exec1 = mysqli_query($conn, $query1);

                                            $check = mysqli_num_rows($exec1);

                                            if ($check == 0) {

                                                echo "<div class='alert alert-danger'>il n'y a pas des questions pour cette formation</div>";
                                            }

                                            while ($array21 = mysqli_fetch_array($exec1)) {
                                                $titre = $array21['question'];
                                                // $duration = $array21['duration'];

                                            ?>
                                                <div class=" col-md-4">
                                                    <?php
                                                    if ($array21['Image'] == '') {
                                                    ?>
                                                        <a><img src="../uploads/cours/video/Quiz.jpg" alt="" style="width:100%;" /></a>
                                                    <?php } else {
                                                        echo '<a><img src="../uploads/cours/quiz/' . $array21['Image'] . '" alt="" style="width:100%;" /></a>';
                                                    }
                                                    ?>

                                                    <h5><?php echo $array21['question']; ?></h5>
                                                    <?php

                                                    $query2 = "SELECT * FROM `reponse-live`  where question_id = " . $array21['ID'] . " ";


                                                    $exec2 = mysqli_query($conn, $query2);

                                                    while ($array2 = mysqli_fetch_array($exec2)) {
                                                        $titre1 = $array2['reponse'];

                                                    ?>
                                                        <h6><?php echo $titre1;
                                                            if ($array2['vrai_faux'] == 1) {
                                                                echo '<i class="fa fa-check" style="color:#34a853;" ></i>';
                                                            } else {
                                                                echo '<i class="fa fa-close" style="color:red;" ></i>';
                                                            } ?></h6>
                                                    <?php } ?>
                                                    <a class="btn btn-primary btn-sm waves-effect waves-light" href="modifier-quiz-live.php?quiz_id=<?php echo $array21['ID']; ?>&cours_id=<?php echo $_GET['cours_id']; ?>">Modifier</a>
                                                    <a class="btn btn-danger btn-sm waves-effect waves-light" href="?cours_id=<?php echo $_GET['cours_id']; ?>&supp_id=<?php echo $array21['ID']; ?>">Supprimer</a>
                                                </div>
                                            <?php } ?>
                                        </div>


                                    </div>
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