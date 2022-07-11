<?php
$pagetitle = 'Modifier Quiz';
include "connexion.php";
$msg = "";
$id_c = $_GET['quiz_id'];
if ($_POST) {

    $quiz_id = mysqli_real_escape_string($conn, $_POST['quiz_id']);
    $section_id = mysqli_real_escape_string($conn, $_POST['section']);
    $question =  mysqli_real_escape_string($conn, $_POST['question']);
    $points =  mysqli_real_escape_string($conn, $_POST['points']);


    $query1 = "SELECT * FROM questions where ID=$id_c ";


    $exec1 = mysqli_query($conn, $query1);

    $array = mysqli_fetch_array($exec1);

    $logo = $array['Image'];

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


    $req_quiz = "UPDATE `questions` SET `section_id`='" . $section_id . "',`question`='" . $question . "',`Image`='" . $logo . "',`points`='" . $points . "' WHERE ID=" . $_GET['quiz_id'] . " ";

    $exec_quiz = mysqli_query($conn, $req_quiz);


    $reponse = $_POST['reponsee'];
    $id_rep = $_POST['id_rep'];

    $checks = $_POST['checkkk'];


    $pp = array();

    foreach ($checks as $tt) {
        $pp[] = $tt;
    }

    $i = count($reponse);
    for ($j = 0; $j < $i; $j++) {

        $rr = mysqli_real_escape_string($conn, $reponse[$j]);
        $vf = $pp[$j];
        $id_rr = $id_rep[$j];



        $req = "UPDATE `reponse` SET `reponse`='" . $rr . "',`vrai_faux`='" . $vf . "' WHERE ID= " .  $id_rr . " ";

        $exec = mysqli_query($conn, $req);

        if ($exec) {
            $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Well done!</strong> Votre Quiz a été modifié.
        </div>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Oh snap!</strong> Quiz non modifié!!! 
        </div>";
        }
    }

    if (isset($_POST['reponse'])) {

        $reponse = $_POST['reponse'];

        $checks = $_POST['checkk'];
        $pp = array();

        foreach ($checks as $tt) {
            $pp[] = $tt;
        }

        $i = count($reponse);

        for ($j = 0; $j < $i; $j++) {

            $rr = mysqli_real_escape_string($conn, $reponse[$j]);
            $vf = $pp[$j];



            $req = "INSERT INTO `reponse` (`question_id`, `reponse`, `vrai_faux`) VALUES('" . $_GET['quiz_id'] . "','" . $rr . "','" . $vf . "')";

            $exec = mysqli_query($conn, $req);
        }
    }
}

if (isset($_GET['supp_id'])) {
    $idsec = $_GET['supp_id'];
    $req = "DELETE FROM `reponse` WHERE ID=$idsec ";
    $exec = mysqli_query($conn, $req);
}
?>

<?php include "header.php"; ?>

<!-- Form Wizard -->
<link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">

<link rel="stylesheet" href="assets/plugin/form-wizard/prettify.css">
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">modifier la question</h4>


                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <?php

                                $query3 = "SELECT * FROM questions where ID = " . $_GET['quiz_id'] . " ";


                                $exec3 = mysqli_query($conn, $query3);

                                $array3 = mysqli_fetch_array($exec3);
                                $question = $array3['question'];
                                $points = $array3['points'];


                                ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Question</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer la question" required name="question" value="<?php echo $question; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Points</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer les points" required name="points" value="<?php echo $points; ?>">


                                </div>

                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Section!
                                    </label>
                                    <input type="hidden" name="quiz_id" value="<?php echo $_GET['quiz_id']; ?>" />
                                    <select name="section" class="form-control" required>
                                        <option value="">sélectionnez une section</option>
                                        <?php
                                        $query = "SELECT * FROM `section` WHERE course_id = " .  $_GET['cours_id'] . " ";

                                        $exec = mysqli_query($conn, $query);

                                        while ($array = mysqli_fetch_array($exec)) {

                                            echo "<option value='" . $array['ID'] . "' ";

                                            if ($array['ID'] == $array3['section_id']) {
                                                echo ' selected="selected" ';
                                            }

                                            echo " >" . $array['title'] . "</option>";
                                        }

                                        ?>
                                        <option <?php if (0 == $array3['section_id']) {
                                                    echo ' selected="selected" ';
                                                } ?> value="0">Grand Quiz</option>
                                    </select>
                                </div>
                                <div style="display: flex;">
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <label for="exampleInputEmail1">Image (optionnelle)</label>
                                        <input accept="image/png,image/jpeg,image/jpg" type="file" name="logo" id="input-file-now" class="dropify" />
                                    </div>
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <?php
                                        if ($array3['Image'] == '') {
                                        ?>
                                            <a><img src="../uploads/cours/video/Quiz.jpg" alt="" style="width:100%;" /></a>
                                        <?php } else {
                                            echo '<a><img src="../uploads/cours/quiz/' . $array3['Image'] . '" alt="" style="width:100%;" /></a>';
                                        }
                                        ?>
                                    </div>

                                </div>

                                <br>
                                <div class="row">
                                    <?php
                                    $req_rep = "SELECT * FROM reponse WHERE question_id = " . $_GET['quiz_id'] . " ";
                                    $exec_rep = mysqli_query($conn, $req_rep);
                                    $i = 0;
                                    while ($array_rep = mysqli_fetch_array($exec_rep)) {
                                    ?>
                                        <div class="col-md-4" style="margin-bottom: 20px;">
                                            <!-- /.dropdown js__dropdown -->

                                            <div class="form-group">
                                                <input type="hidden" name="id_rep[]" value="<?php echo $array_rep['ID']; ?>" <label for="exampleInputEmail1">Réponse de la question</label>
                                                <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer la réponse" value="<?php echo $array_rep['reponse']; ?>" name="reponsee[]">
                                            </div>

                                            <ul class="list-inline" style="margin:auto;width:max-content;">
                                                <li>
                                                    <div class=" success">
                                                        <input type="radio" <?php if ($array_rep['vrai_faux'] == 1) {
                                                                                echo 'checked';
                                                                            } ?> name="checkkk[<?php echo $i; ?>]" value="1">
                                                        <label>Vrai</label>
                                                    </div>
                                                    <!-- /.radio -->
                                                </li>
                                                <li>
                                                    <div class=" danger">
                                                        <input type="radio" <?php if ($array_rep['vrai_faux'] == 0) {
                                                                                echo 'checked';
                                                                            } ?> value="0" name="checkkk[<?php echo $i; ?>]">
                                                        <label>faux</label>
                                                    </div>
                                                    <!-- /.radio -->
                                                </li>

                                            </ul>
                                            <div style="margin:auto;width:max-content;">
                                                <a class="btn btn-danger btn-sm waves-effect waves-light" href="?quiz_id=<?php echo $_GET['quiz_id']; ?>&cours_id=<?php echo $_GET['cours_id']; ?>&supp_id=<?php echo $array_rep['ID']; ?>">Supprimer</a>
                                            </div>
                                        </div>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" style="margin-bottom: 20px;">

                                        <div id="plus_radio"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <button title="Ajouter une autre réponse" type="button" class="plus_rep btn btn-success btn-block"><i class="fa fa-plus"></i></button>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="ajout-quiz.php?lesson_id=<?php echo $_GET['cours_id']; ?>">Retour</a>
                            </form>
                        </div>
                    </div>
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