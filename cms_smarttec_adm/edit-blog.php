<?php
include "connexion.php";

$idb = $_GET['bl_id'];

$msg = "";
if ($_POST) {

    // $logo = '';

    //2- Récuperation des variables
    $titre = mysqli_real_escape_string($conn, $_POST['Titre']);
    $para = mysqli_real_escape_string($conn, $_POST['Para']);
    $rem = mysqli_real_escape_string($conn, $_POST['Remarque']);
    $file_name_doc_blog = mysqli_real_escape_string($conn, $_POST['file_name']);


    $file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name']);

    if ($file_name) {
        $errors = array();
        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $exp = explode('.', $_FILES['logo']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        $logo = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/img_blog/" . $logo);
            //echo "Success";
        } else {
            print_r($errors);
        }



        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `Image`='" . $logo . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    }

    $exec = mysqli_query($conn, $req);



    $file_name1 = mysqli_real_escape_string($conn, $_FILES['Image1']['name']);

    if ($file_name1) {
        $errors = array();
        $file_name = $_FILES['Image1']['name'];
        $file_size = $_FILES['Image1']['size'];
        $file_tmp = $_FILES['Image1']['tmp_name'];
        $file_type = $_FILES['Image1']['type'];
        $exp = explode('.', $_FILES['Image1']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        $img1 = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/img_blog/" . $img1);
            //echo "Success";
        } else {
            print_r($errors);
        }



        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "',`Image1`='" . $img1 . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    }

    $exec = mysqli_query($conn, $req);

    $file_name2 = mysqli_real_escape_string($conn, $_FILES['Image2']['name']);

    if ($file_name2) {
        $errors = array();
        $file_name = $_FILES['Image2']['name'];
        $file_size = $_FILES['Image2']['size'];
        $file_tmp = $_FILES['Image2']['tmp_name'];
        $file_type = $_FILES['Image2']['type'];
        $exp = explode('.', $_FILES['Image2']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        $img2 = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/img_blog/" . $img2);
            //echo "Success";
        } else {
            print_r($errors);
        }



        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `Image2`='" . $img2 . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    }

    $exec = mysqli_query($conn, $req);

    $file_name3 = mysqli_real_escape_string($conn, $_FILES['Image3']['name']);

    if ($file_name3) {
        $errors = array();
        $file_name = $_FILES['Image3']['name'];
        $file_size = $_FILES['Image3']['size'];
        $file_tmp = $_FILES['Image3']['tmp_name'];
        $file_type = $_FILES['Image3']['type'];
        $exp = explode('.', $_FILES['Image3']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        $img3 = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/img_blog/" . $img3);
            //echo "Success";
        } else {
            print_r($errors);
        }



        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `Image3`='" . $img3 . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    }

    $exec = mysqli_query($conn, $req);
    
    
    $file_name3 = mysqli_real_escape_string($conn, $_FILES['doc']['name']);

    if ($file_name3) {
        $errors = array();
        $file_name = mysqli_real_escape_string($conn,$_FILES['doc']['name']);
        $file_size = $_FILES['doc']['size'];
        $file_tmp = mysqli_real_escape_string($conn,$_FILES['doc']['tmp_name']);
        $file_type = $_FILES['doc']['type'];
        $exp = explode('.', $_FILES['doc']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("pdf","zip","rar","txt");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a PDF or ZIP or RAR file.";
        }

       

        $doc_bl = time() . '_' . "blog.".$file_ext;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/doc_blog/" . $doc_bl);
            //echo "Success";
        } else {
            print_r($errors);
        }



        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `DOC`='" . $doc_bl . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `blog` SET `Titre`='" . $titre . "',`Para`='" . $para . "',`Remarque`='" . $rem . "', `file_name`='" . $file_name_doc_blog . "' WHERE ID=" . $idb . " ";
    }

    $exec = mysqli_query($conn, $req);
    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Blog a été modifié.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Blog non modifié!!! 
</div>";
    }
}

?>


<?php include "header.php"; ?>
<!-- /.main-menu -->
<?php include "sidebar.php"; ?>
<link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">modifier blog</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <?php

                                $query1 = "SELECT * FROM blog where ID=$idb ";


                                $exec1 = mysqli_query($conn, $query1);

                                while ($array = mysqli_fetch_array($exec1)) {
                                    $titre = $array['Titre'];
                                    $para = $array['Para'];
                                    $rem = $array['Remarque'];

                                    $img = $array['Image'];
                                    $img1 = $array['Image1'];
                                    $img2 = $array['Image2'];
                                    $img3 = $array['Image3'];
                                    $doc_blog = $array['DOC'];
                                    $file_name_bl = $array['file_name'];
                                }

                                ?>
                                <div>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="logo" id="input-file-now" class="dropify" />
                                    <img src="../uploads/img_blog/<?php echo $img; ?>" alt="<?php echo $titre; ?>" style="width:150px;" />
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titre De Blog</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Titre De blog" name="Titre" value="<?php echo $titre ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Paragraphe</label>
                                    <textarea class="editor_yes" name="Para" required><?php echo $para ?></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Remarque</label>
                                    <textarea class="editor_yes" name="Remarque" required><?php echo $rem ?></textarea>
                                </div>



                                <label for="exampleInputEmail1">Extra Images: (option)</label>
                                <div style="display: flex;">
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <input type="file" name="Image1" id="input-file-now" class="dropify" />
                                        <?php
                                        if (!empty($img1)) {


                                        ?>
                                            <img src="../uploads/img_blog/<?php echo $img1; ?>" alt="<?php echo $titre; ?>" style="width:150px;" />
                                        <?php
                                        } else {
                                            echo "Photo 1 n'existe pas";
                                        }
                                        ?>


                                    </div>
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <input type="file" name="Image2" id="input-file-now" class="dropify" />
                                        <?php
                                        if (!empty($img2)) {


                                        ?>
                                            <img src="../uploads/img_blog/<?php echo $img2; ?>" alt="<?php echo $titre; ?>" style="width:150px;" />
                                        <?php
                                        } else {
                                            echo "Photo 2 n'existe pas";
                                        }
                                        ?>
                                    </div>
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <input type="file" name="Image3" id="input-file-now" class="dropify" />
                                        <?php
                                        if (!empty($img3)) {


                                        ?>
                                            <img src="../uploads/img_blog/<?php echo $img3; ?>" alt="<?php echo $titre; ?>" style="width:150px;" />
                                        <?php
                                        } else {
                                            echo "Photo 3 n'existe pas";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <br>
                                <div>
                                    <label>Documents de blog (option)</label>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="doc" id="input-file-now" class="dropify" />
                                    <?php
                                        if (!empty($doc_blog)) {


                                        ?>
                                    <a href="../uploads/doc_blog/<?php echo $doc_blog; ?>"> Document </a>
                                     <?php
                                        } else {
                                            echo "DOC n'existe pas";
                                        }
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label >Nom de fichier (option)</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Nom de fichier De blog" value="<?php echo $file_name_bl; ?>" name="file_name">
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
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

    <!-- 
	================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/scripts/jquery.min.js"></script>
    <script src="assets/scripts/modernizr.min.js"></script>
    <script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/plugin/nprogress/nprogress.js"></script>
    <script src="assets/plugin/sweet-alert/sweetalert.min.js"></script>
    <script src="assets/plugin/waves/waves.min.js"></script>
    <!-- Full Screen Plugin -->
    <script src="assets/plugin/fullscreen/jquery.fullscreen-min.js"></script>
    <!-- Dropify -->
    <script src="assets/plugin/dropify/js/dropify.min.js"></script>
    <script src="assets/scripts/fileUpload.demo.min.js"></script>

    <script src="assets/scripts/main.min.js"></script>
    <script src="assets/color-switcher/color-switcher.min.js"></script>
    <!-- Maxlength -->
    <script src="assets/plugin/maxlength/bootstrap-maxlength.min.js"></script>
    <!-- Demo Scripts -->
    <script src="assets/scripts/form.demo.min.js"></script>