<?php
include "connexion.php";
$msg = "";
$id_service = $_GET['id'];
if ($_POST) {

    // $logo = '';

    //2- Récuperation des variables
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $text = mysqli_real_escape_string($conn, $_POST['Text']);
    $poste = mysqli_real_escape_string($conn, $_POST['poste']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);

    $file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name']);
    $logo = "";
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
            move_uploaded_file($file_tmp, "../uploads/team/" . $logo);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }



    $file_name = mysqli_real_escape_string($conn, $_FILES['logo_s']['name']);
    $logo_s = "";
    if ($file_name) {
        $errors = array();
        $file_name = $_FILES['logo_s']['name'];
        $file_size = $_FILES['logo_s']['size'];
        $file_tmp = $_FILES['logo_s']['tmp_name'];
        $file_type = $_FILES['logo_s']['type'];
        $exp = explode('.', $_FILES['logo_s']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        $logo_s = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/team/" . $logo_s);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }
    $req = "INSERT INTO `feedback_services` (`Name`, `Text`, `Poste`, `rating`, `Image`, `logo`, `service_ID`) VALUES ('" . $name . "','" . $text . "','" . $poste . "','" . $rating . "','" . $logo . "','" . $logo_s . "','" . $id_service . "')";
    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Feedback a été ajouté.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Feedback non ajouté!!! 
</div>";
    }
}

?>


<?php include "header.php"; ?>
<!-- /.main-menu -->
<?php include "sidebar.php"; ?>
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">Ajout Feedback</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <div>
                                    <label for="exampleInputEmail1">Photo</label>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="logo" id="input-file-now" class="dropify" required />
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required placeholder="Entrer le Nom" name="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Poste</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required placeholder="Entrer le Nom" name="poste">
                                </div>
                                <div>
                                    <label for="exampleInputEmail1">Logo Société</label>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="logo_s" id="input-file-now" class="dropify" required />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Témoignage</label>
                                    <textarea required name="Text" class="form-control" placeholder="This textarea has a limit of 225 chars."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rating</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" required placeholder="Entrer le rating" name="rating">
                                </div>
                                <br>


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
    <?php include 'footer.php'; ?>