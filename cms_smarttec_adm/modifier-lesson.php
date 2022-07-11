<?php
$pagetitle = 'Modifier lesson';
include "connexion.php";
$msg = "";
if ($_POST) {

    $query1 = "SELECT * FROM lesson where ID=" . $_GET['video_id'] . " ";


    $exec1 = mysqli_query($conn, $query1);

    $array = mysqli_fetch_array($exec1);

    $logo = $array['video'];

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $section_id = mysqli_real_escape_string($conn, $_POST['section_id']);




    if (!empty($_FILES['logo']['name'])) {
        $errors = array();
        $file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name']);
        $file_size = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $exp = explode('.', $_FILES['logo']['name']);
        $end_expl = end($exp);

        $logo = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/cours/lessons/" . $logo);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }
    $file = "";
    // start file upload
    if (!empty($_FILES['file']['name'])) {
        $file_name1 = mysqli_real_escape_string($conn, $_FILES['file']['name']);
        $file_tmp1 = $_FILES['file']['tmp_name'];
        $file = time() . '_' . $file_name1;
        move_uploaded_file($file_tmp1, "../uploads/cours/doc/" . $file);
        // end file upload
    }


    $req = "UPDATE `lesson` SET `video`='" . $logo . "',`title`='" . $title . "',`duration`='" . $duration . "',`section_id`='" . $section_id . "',`doc`='" . $file . "' WHERE ID=" . $_GET['video_id'] . " ";



    //echo $req;

    //4- Execution de la requete
    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre lesson a été modifié.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> lesson non modifié!!! 
</div>";
    }
}
?>

<?php include "header.php"; ?>
<!-- /.main-menu -->
<?php include "sidebar.php"; ?>
<!-- Form Wizard -->
<link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">

<link rel="stylesheet" href="assets/plugin/form-wizard/prettify.css">
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">modifier un lesson</h4>


                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <?php

                                $query3 = "SELECT * FROM lesson where ID = " . $_GET['video_id'] . " ";


                                $exec3 = mysqli_query($conn, $query3);

                                $array3 = mysqli_fetch_array($exec3);
                                $title = $array3['title'];
                                $dur = $array3['duration'];
                                $vid = $array3['video'];
                                $doc = $array3['doc'];


                                ?>
                                <div id="plus_input">
                                    <!-- /.dropdown js__dropdown -->
                                    <label for="exampleInputEmail1">Video de lesson</label>
                                    <input type="file" name="logo" id="input-file-now" class="dropify" accept="video/mp4,video/x-m4v,video/*" />
                                    <video style="width:200px;" controls>
                                        <source src="../uploads/cours/lessons/<?php echo $vid; ?>" type="video/mp4">
                                    </video>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom de lesson</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le lesson" required name="title" value="<?php echo $title; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Duration</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" required name="duration" value="<?php echo $dur; ?>">
                                    <label for="exampleInputEmail1">Document (Option):</label>
                                    <input type="file" name="file" id="input-file-now" class="dropify" data-max-file-size="100M" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" />
                                    <?php
                                    if (!empty($doc)) { ?>
                                        <a target="_blank" href="../uploads/cours/doc/<?php echo $doc; ?>"><?php echo $doc; ?></a>
                                    <?php  } else {
                                        echo "Ce lesson ne contient pas un Document.";
                                    } ?>
                                    <img style="width:50px;" src="https://img.icons8.com/windows/2x/file-upload.png" />
                                </div>

                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Section!
                                    </label>
                                    <input type="hidden" name="lesson_id" value="<?php echo $_GET['video_id']; ?>" />
                                    <select name="section_id" class="form-control" required>
                                        <option value="">sélectionnez une section</option>
                                        <?php
                                        $query = "SELECT * FROM `section` WHERE course_id = " .  $array3['cours_id'] . " ";

                                        $exec = mysqli_query($conn, $query);

                                        while ($array = mysqli_fetch_array($exec)) {

                                            echo "<option value='" . $array['ID'] . "' ";

                                            if ($array['ID'] == $array3['section_id']) {
                                                echo ' selected="selected" ';
                                            }

                                            echo " >" . $array['title'] . "</option>";
                                        }

                                        ?>
                                    </select>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="ajou-lesson.php?lesson_id=<?php echo $array3['cours_id']; ?>">Retour</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-content -->

            <!-- /.box-title -->

            <!-- /.card-content -->
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-lg-6 col-xs-12 -->


    <!-- /.col-lg-6 col-xs-12 -->


    <!-- /.col-xs-12 -->

    <!-- /.col-lg-6 col-xs-12 -->

    <!-- /.col-lg-6 col-xs-12 -->
</div>


</div>

</form>
</div>
<!-- /.card-content -->
</div>
<!-- /.box-content -->
</div>

</div>

</div>
<!-- /.main-content -->
</div>

<!-- /.row small-spacing -->

</div>
<!-- /.main-content -->
</div>


<?php include "footer.php"; ?>