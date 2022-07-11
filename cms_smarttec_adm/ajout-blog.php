<?php
include "connexion.php";
$msg = "";
if ($_POST) {

    // $logo = '';

    //2- Récuperation des variables
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $titre = mysqli_real_escape_string($conn, $_POST['Titre']);
    $para = mysqli_real_escape_string($conn, $_POST['Para']);
    $rem = mysqli_real_escape_string($conn, $_POST['Remarque']);
    $file_name_doc_blog = mysqli_real_escape_string($conn, $_POST['file_name']);





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
    }

    $img1 = "";

    if (!empty($_FILES['Image1']['name'])) {
        $errors = array();
        $file_name1 = mysqli_real_escape_string($conn, $_FILES['Image1']['name']);
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

        $img1 = time() . '_' . $file_name1;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/img_blog/" . $img1);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }


    $img2 = "";

    if (!empty($_FILES['Image2']['name'])) {
        $errors = array();
        $file_name2 = mysqli_real_escape_string($conn, $_FILES['Image2']['name']);
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

        $img2 = time() . '_' . $file_name2;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/img_blog/" . $img2);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }


    $img3 = "";
    if (!empty($_FILES['img3']['name'])) {
        $errors = array();
        $file_name3 = mysqli_real_escape_string($conn, $_FILES['Image3']['name']);
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

        $img3 = time() . '_' . $file_name3;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/img_blog/" . $img3);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }
    
     $doc_blog = "";
    if (!empty($_FILES['doc']['name'])) {
        $errors = array();
        $file_name3 = mysqli_real_escape_string($conn, $_FILES['doc']['name']);
        $file_size = $_FILES['doc']['size'];
        $file_tmp = $_FILES['doc']['tmp_name'];
        $file_type = $_FILES['doc']['type'];
        $exp = explode('.', $_FILES['doc']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("pdf","zip","rar","txt");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a PDF or ZIP or RAR file.";
        }

       

        $doc_blog = time() . '_' . "blog.".$file_ext;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/doc_blog/" . $doc_blog);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }


    $req = "INSERT INTO `blog`(`Titre`, `Para`, `Remarque`, `Auth`, `Date`, `Image`, `Image1`, `Image2`, `Image3`, `DOC`, `file_name`) VALUES('" . $titre . "','" . $para . "','" . $rem . "','" . $_SESSION['id'] . "',now(),'" . $logo . "','" . $img1 . "','" . $img2 . "','" . $img3 . "','" . $doc_blog . "','" . $file_name_doc_blog . "')";


    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Blog a été ajouté.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Blog non ajouté!!! 
</div>";
    }
}

?>


<?php
$pagetitle = "Ajout Blog";
include "header.php"; ?>

<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">Ajout blog</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <div>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="logo" id="input-file-now" class="dropify" required />
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titre De Blog</label>
                                    <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Titre De blog" name="Titre">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Paragraphe</label>
                                    <textarea class="editor_yes" name="Para"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sous Paragraphe</label>
                                    <textarea class="editor_yes" required class="form-control" name="Remarque"> </textarea>
                                </div>


                                <label for="exampleInputEmail1">Extra Images: (option)</label>
                                <div style="display: flex;">
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <input type="file" name="Image1" id="input-file-now" class="dropify" />
                                    </div>
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <input type="file" name="Image2" id="input-file-now" class="dropify" />
                                    </div>
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <input type="file" name="Image3" id="input-file-now" class="dropify" />
                                    </div>
                                </div>
                                <br>
                                
                                <div>
                                    <!-- /.dropdown js__dropdown -->
                                    <label>Documents de blog (option)</label>
                                    <input type="file" name="doc" id="input-file-now" class="dropify" />
                                </div>
                                <div class="form-group">
                                    <label >Nom de fichier (option)</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Nom de fichier De blog" name="file_name">
                                </div>
                              
                                
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
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
    <!--/#wrapper -->

    <?php include 'footer.php'; ?>