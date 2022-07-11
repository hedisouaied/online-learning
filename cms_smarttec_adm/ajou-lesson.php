<?php
$pagetitle = "Lessons E-learning";
include "connexion.php";
$msg = "";
if ($_POST) {

    $lesson_id = mysqli_real_escape_string($conn, $_POST['lesson_id']);
    $section_id = mysqli_real_escape_string($conn, $_POST['section']);
    $title =  $_POST['title'];
    $duration =  $_POST['duration'];
    $videos = array();
    $videos = $_POST['logo'];
    $i = count($videos);



    for ($j = 0; $j < $i; $j++) {

        $dd = $duration[$j];
        $tt = mysqli_real_escape_string($conn,$title[$j]);
        $errors = array();
        // start video upload
        $file_name = mysqli_real_escape_string($conn, $_POST['logo'][$j]);

        $logo = time() . '_' . $file_name;
        rename("../uploads/cours/lessons/" . $file_name, "../uploads/cours/lessons/" . $logo);
        // end video upload

        $file = "";
        // start file upload
        if (!empty($_FILES['file']['name'][$j])) {
            $file_name1 = mysqli_real_escape_string($conn, $_FILES['file']['name'][$j]);
            $file_tmp1 = $_FILES['file']['tmp_name'][$j];
            $file = time() . '_' . $file_name1;
            move_uploaded_file($file_tmp1, "../uploads/cours/doc/" . $file);
            // end file upload
        }

        $req = "INSERT INTO `lesson`(`cours_id`, `section_id`, `video`, `title`, `duration`, `doc`) VALUES('" . $lesson_id . "','" . $section_id . "','" . $logo . "','" . $tt . "','" . $dd . "','" . $file . "')";



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

if (isset($_GET['supp_id'])) {
    $idsec = $_GET['supp_id'];
    $query_un = "SELECT * FROM `lesson` WHERE ID = " . $idsec;

    $exec_un = mysqli_query($conn, $query_un);

    $array_un = mysqli_fetch_array($exec_un);
    $req = "DELETE FROM `lesson` WHERE ID=$idsec ";
    $exec = mysqli_query($conn, $req);
    if ($exec) {
        unlink('../uploads/cours/lessons/' . $array_un['video']);
    }
    header("location: ajou-lesson.php?lesson_id=" . $_GET['lesson_id']);
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
                        <h4 class="box-title">Lessons E-learning</h4>

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
                                                <li><a href="#tab-pill1" data-toggle="tab">Ajout Lessons</a></li>
                                                <?php
                                                $query1 = "SELECT * FROM section where course_id = " . $_GET['lesson_id'] . " ";
                                                $exec1 = mysqli_query($conn, $query1);
                                                $i = 2;
                                                while ($array = mysqli_fetch_array($exec1)) {
                                                ?>
                                                    <li><a href="#tab-pill<?php echo $i; ?>" data-toggle="tab"><?php echo $array['title'] ?></a></li>

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

                                                <div id="plus_input">
                                                    <?php
                                                    $i = 1;
                                                    ?>
                                                    <!-- /.dropdown js__dropdown -->
                                                    <label for="exampleInputEmail1">Video de lesson</label>
                                                    <input required type="file" name="file<?php echo $i; ?>" onchange="uploadFile<?php echo $i; ?>()" id="file<?php echo $i; ?>" class="dropify" accept="video/mp4,video/x-m4v,video/*" />
                                                    <progress style="width: 100%;height: 49px;" id="progressBar<?php echo $i; ?>" value="0" max="100" style="width:300px;"></progress>
                                                    <h3 id="status<?php echo $i; ?>"></h3>
                                                    <p id="loaded_n_total<?php echo $i; ?>"></p>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nom de lesson</label>
                                                        <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le lesson" name="title[]">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Duration: (min)</label>
                                                        <input required type="number" class="form-control" id="exampleInputEmail1" placeholder="Entrer la durée" name="duration[]">
                                                        <label for="exampleInputEmail1">Document (Option):</label>
                                                        <input type="file" name="file[]" id="input-file-now" class="dropify" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" />
                                                    </div>
                                                    <script>
                                                        function _(el) {
                                                            return document.getElementById(el);
                                                        }

                                                        function uploadFile<?php echo $i; ?>() {
                                                            var file = _("file<?php echo $i; ?>").files[0];
                                                            // alert(file.name+" | "+file.size+" | "+file.type);
                                                            var formdata = new FormData();
                                                            formdata.append("file<?php echo $i; ?>", file);
                                                            var ajax = new XMLHttpRequest();
                                                            ajax.upload.addEventListener("progress", progressHandler<?php echo $i; ?>, false);
                                                            ajax.addEventListener("load", completeHandler<?php echo $i; ?>, false);
                                                            ajax.addEventListener("error", errorHandler<?php echo $i; ?>, false);
                                                            ajax.addEventListener("abort", abortHandler<?php echo $i; ?>, false);
                                                            ajax.open("POST", "file_upload_parser.php?id=file<?php echo $i; ?>"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
                                                            //use file_upload_parser.php from above url
                                                            ajax.send(formdata);
                                                        }

                                                        function progressHandler<?php echo $i; ?>(event) {
                                                            _("loaded_n_total<?php echo $i; ?>").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
                                                            var percent = (event.loaded / event.total) * 100;
                                                            _("progressBar<?php echo $i; ?>").value = Math.round(percent);
                                                            _("status<?php echo $i; ?>").innerHTML = Math.round(percent) + "% uploaded... please wait";
                                                        }

                                                        function completeHandler<?php echo $i; ?>(event) {
                                                            _("status<?php echo $i; ?>").innerHTML = event.target.responseText;
                                                            _("progressBar<?php echo $i; ?>").value = 0; //wil clear progress bar after successful upload
                                                        }

                                                        function errorHandler<?php echo $i; ?>(event) {
                                                            _("status<?php echo $i; ?>").innerHTML = "Upload Failed";
                                                        }

                                                        function abortHandler<?php echo $i; ?>(event) {
                                                            _("status<?php echo $i; ?>").innerHTML = "Upload Aborted";
                                                        }
                                                    </script>

                                                </div>

                                                <div>
                                                    <button title="Ajouter une autre formaulaire" type="button" class="plus_yy btn btn-success btn-block"><i class="fa fa-plus"></i></button>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">
                                                        Section!
                                                    </label>
                                                    <input type="hidden" name="lesson_id" value="<?php echo $_GET['lesson_id']; ?>" />
                                                    <select name="section" required="true" class="form-control">
                                                        <option value="">sélectionnez une section</option>
                                                        <?php
                                                        $query = "SELECT * FROM `section` WHERE course_id = " . $_GET['lesson_id'] . " ";

                                                        $exec = mysqli_query($conn, $query);

                                                        while ($array = mysqli_fetch_array($exec)) {

                                                            echo "<option value='" . $array['ID'] . "' >" . $array['title'] . "</option>";
                                                        }

                                                        ?>
                                                    </select>
                                                </div>

                                                <br>
                                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="list-cours.php">Retour</a>
                                            </form>
                                        </div>
                                    </div>

                                    <?php
                                    $query188 = "SELECT * FROM section where course_id = " . $_GET['lesson_id'] . " ";
                                    $exec188 = mysqli_query($conn, $query188);
                                    $i = 2;
                                    while ($array = mysqli_fetch_array($exec188)) {
                                    ?>
                                        <div class="tab-pane" id="tab-pill<?php echo $i; ?>">
                                            <!-- /.row -->

                                            <div class="row">
                                                <?php

                                                $query1 = "SELECT * FROM lesson where cours_id = " . $_GET['lesson_id'] . " AND section_id = " . $array['ID'] . "  ";


                                                $exec1 = mysqli_query($conn, $query1);

                                                $check = mysqli_num_rows($exec1);

                                                if ($check == 0) {

                                                    echo "<div class='alert alert-danger'>il n'y a pas de lessons pour cette section</div>";
                                                }

                                                while ($array21 = mysqli_fetch_array($exec1)) {
                                                    $titre = $array21['title'];
                                                    $duration = $array21['duration'];

                                                ?>
                                                    <div class=" col-md-4">
                                                        <a target="_blank" href="../uploads/cours/lessons/<?php echo $array21['video'];  ?>"><img src="../uploads/cours/video/vid.png" alt="<?php echo $array['title'] ?>" style="100%;" /></a>

                                                        <h5><?php echo $array21['title']; ?></h5>
                                                        <h6><?php echo $array21['duration'] . " min"; ?></h6>
                                                        <?php

                                                        $query2 = "SELECT * FROM section  where ID = " . $array21['section_id'] . " ";


                                                        $exec2 = mysqli_query($conn, $query2);

                                                        $array2 = mysqli_fetch_array($exec2);
                                                        $titre1 = $array2['title'];

                                                        ?>
                                                        <h5><?php echo $titre1; ?></h5>

                                                        <a class="btn btn-primary btn-sm waves-effect waves-light" href="modifier-lesson.php?video_id=<?php echo $array21['ID']; ?>">Modifier</a>
                                                        <a class="btn btn-danger btn-sm waves-effect waves-light" href="?lesson_id=<?php echo $_GET['lesson_id']; ?>&supp_id=<?php echo $array21['ID']; ?>">Supprimer</a>
                                                    </div>
                                                <?php } ?>
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
<div class="row">

    <!-- /.col-lg-4 ol-xs-12 -->

    <!-- /.col-lg-4 col-xs-12 -->
    <div class="col-lg-4 ol-xs-12">

        <!-- /.box-content card white -->
    </div>
    <!-- /.col-lg-4 col-xs-12 -->
</div>
<!-- /.row small-spacing -->

</div>
<!-- /.main-content -->
</div>
<!--/#wrapper -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
<!-- 
	================================================== -->


<?php include "footer.php"; ?>