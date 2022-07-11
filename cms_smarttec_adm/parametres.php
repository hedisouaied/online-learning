<?php
include "connexion.php";
$msg = "";
if ($_POST) {


    //2- Récuperation des variables
    $title1 = mysqli_real_escape_string($conn, $_POST['title1']);
    $para1 = mysqli_real_escape_string($conn, $_POST['para1']);
    $title2 = mysqli_real_escape_string($conn, $_POST['title2']);
    $para2 = mysqli_real_escape_string($conn, $_POST['para2']);
    $title3 = mysqli_real_escape_string($conn, $_POST['title3']);
    $para3 = mysqli_real_escape_string($conn, $_POST['para3']);

    $req_fetch = "SELECT * FROM site_settings WHERE ID_s = 1 ";
    $exec_fetch = mysqli_query($conn, $req_fetch);
    $array_fetch = mysqli_fetch_array($exec_fetch);
    $logo = $array_fetch['Image'];

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



        $logo = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/sliders/" . $logo);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }

    $req = "UPDATE `site_settings` SET `Image`='" . $logo . "',`title1`='" . $title1 . "',`para1`='" . $para1 . "',`title2`='" . $title2 . "',`para2`='" . $para2 . "',`para3`='" . $para3 . "', `title3`='" . $title3 . "' WHERE ID_s=1 ";

    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre informations a été modifier.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> informations non modifier!!! 
</div>";
    }
}

?>


<?php include "header.php"; ?>
<!-- /.main-menu -->
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">Modifier paramétres de site</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <?php

                                $query1 = "SELECT * FROM site_settings where ID_s=1 ";


                                $exec1 = mysqli_query($conn, $query1);

                                $array = mysqli_fetch_array($exec1);

                                $img = $array['Image'];
                                $title1 = $array['title1'];
                                $para1 = $array['para1'];
                                $title2 = $array['title2'];
                                $para2 = $array['para2'];
                                $title3 = $array['title3'];
                                $para3 = $array['para3'];
                               


                                ?>
                                <br>
                                <div>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="logo" id="input-file-now" class="dropify" />
                                    <img src="../uploads/sliders/<?php echo $img; ?>" alt="<?php echo $title1; ?>" style="width:150px;" />
                                </div>
                                <div class="m-t-20">
                                    <label for="exampleInputEmail1">titre1</label>

                                    <textarea name="title1" id="textarea" class="form-control" maxlength="1000" rows="2" placeholder="This textarea has a limit of 225 chars."><?php echo $title1; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">phrase1</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="para1" value="<?php echo $para1 ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">titre2</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="title2" value="<?php echo $title2 ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phrase2</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="para2" value="<?php echo $para2 ?>">
                                </div>
                                
                                <br>

                                <div class="checkbox margin-bottom-20">
                                    <input type="checkbox" id="chk-1"><label for="chk-1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Submit</button>
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
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
    <!-- 
	================================================== -->
    <?php include 'footer.php'; ?>