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


        $data = $rem ;
        
        

          $image_array_1 = explode("data:image/png;",$data);
          $image_array_2 = explode("base64,",$image_array_1[1]);
          $image_array_3 = explode('"',$image_array_2[1]);


          $data = base64_decode($image_array_3[0]);

          $imagename = "smart".time() . ".png" ;

          file_put_contents("uploads/editor//".$imagename,$data) ;

        
        $mystring = $rem ;
        
        $findme = 'src="data:image/png;base64,'.$image_array_3[0].'"';
        
        $pos = strpos($mystring, $findme);
        
        
       $bodytag = str_replace($findme, 'src="https://e-smarttec.com/uploads/editor/'.$imagename.'"',$rem );

    //3- Préparation de la requete
    $req = "UPDATE `services` SET `Name`='" . $titre . "',`Description`='" . $para . "',`Content`='" . $rem . "' WHERE ID=" . $idb . " ";


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



        $req = "UPDATE `services` SET `Name`='" . $titre . "',`Description`='" . $para . "',`Content`='" . $rem . "',`img1`='" . $img1 . "' WHERE ID=" . $idb . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `services` SET `Name`='" . $titre . "',`Description`='" . $para . "',`Content`='" . $rem . "' WHERE ID=" . $idb . " ";
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



        $req = "UPDATE `services` SET `Name`='" . $titre . "',`Description`='" . $para . "',`Content`='" . $rem . "', `img2`='" . $img2 . "' WHERE ID=" . $idb . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `services` SET `Name`='" . $titre . "',`Description`='" . $para . "',`Content`='" . $rem . "' WHERE ID=" . $idb . " ";
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



        $req = "UPDATE `services` SET `Name`='" . $titre . "',`Description`='" . $para . "',`Content`='" . $rem . "', `img3`='" . $img3 . "' WHERE ID=" . $idb . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `services` SET `Name`='" . $titre . "',`Description`='" . $para . "',`Content`='" . $rem . "' WHERE ID=" . $idb . " ";
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
                        <h4 class="box-title">modifier Service</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <?php

                                $query1 = "SELECT * FROM services where ID=$idb ";


                                $exec1 = mysqli_query($conn, $query1);

                                while ($array = mysqli_fetch_array($exec1)) {
                                    $titre = $array['Name'];
                                    $para = $array['Description'];
                                    $rem = $array['Content'];
                                    $img1 = $array['img1'];
                                    $img2 = $array['img2'];
                                    $img3 = $array['img3'];
                                }

                                ?>

                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Service</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le nom de service" name="Titre" value="<?php echo $titre ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea class="form-control" name="Para" required><?php echo $para ?></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contenue</label>
                                    <textarea class="editor_yes" name="Remarque"><?php echo $rem ?></textarea>
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


                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.main-content -->
    </div>


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