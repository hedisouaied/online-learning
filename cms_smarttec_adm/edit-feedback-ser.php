<?php
include "connexion.php";
$idf = $_GET['fd_id'];


$msg = "";
if ($_POST) {


    //2- Récuperation des variables
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $text = mysqli_real_escape_string($conn, $_POST['Text']);
    $poste = mysqli_real_escape_string($conn, $_POST['poste']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);




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
            move_uploaded_file($file_tmp, "../uploads/team/" . $logo);
            //echo "Success";
        } else {
            print_r($errors);
        }
        $req = "UPDATE `feedback_services` SET `Name`='" . $name . "',`Text`='" . $text . "',`Poste`='" . $poste . "',`rating`='" . $rating . "',`Image`='" . $logo . "' WHERE ID=" . $idf . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `feedback_services` SET `Name`='" . $name . "',`Text`='" . $text . "',`Poste`='" . $poste . "',`rating`='" . $rating . "' WHERE ID=" . $idf . " ";
    }

    $exec = mysqli_query($conn, $req);


    $file_name = mysqli_real_escape_string($conn, $_FILES['logo_s']['name']);

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
        $req = "UPDATE `feedback_services` SET `Name`='" . $name . "',`Text`='" . $text . "',`Poste`='" . $poste . "',`rating`='" . $rating . "',`logo`='" . $logo_s . "' WHERE ID=" . $idf . " ";
    } else {
        //3- Préparation de la requete
        $req = "UPDATE `feedback_services` SET `Name`='" . $name . "',`Text`='" . $text . "',`Poste`='" . $poste . "',`rating`='" . $rating . "' WHERE ID=" . $idf . " ";
    }

    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre feedback a été modifié.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> feedback non modifié!!! 
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
                        <h4 class="box-title">Modifier Membre</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <?php

                                $query1 = "SELECT * FROM feedback_services where ID=$idf ";


                                $exec1 = mysqli_query($conn, $query1);

                                while ($array = mysqli_fetch_array($exec1)) {
                                    $Name = $array['Name'];
                                    $Text = $array['Text'];
                                    $poste = $array['Poste'];
                                    $rating = $array['rating'];
                                    $img = $array['Image'];
                                    $logo = $array['logo'];
                                }

                                ?>
                                <div>
                                    <label for="exampleInputEmail1">Image</label>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="logo" id="input-file-now" class="dropify" />
                                    <img src="../uploads/team/<?php echo $img; ?>" alt="<?php echo $Name; ?>" style="width:150px;" />
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Votre nom" name="Name" value="<?php echo $Name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Poste</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Votre poste" name="poste" value="<?php echo $poste ?>">
                                </div>
                                <div>
                                    <label for="exampleInputEmail1">Logo de la société</label>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="logo_s" id="input-file-now" class="dropify" />
                                    <img src="../uploads/team/<?php echo $logo; ?>" alt="<?php echo $Name; ?>" style="width:150px;" />
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">feedback</label>
                                    <textarea name="Text" class="form-control" placeholder="This textarea has a limit of 225 chars."><?php echo $Text; ?></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rating</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="rating" value="<?php echo $rating ?>">
                                </div>
                                <br>

                                <div class="checkbox margin-bottom-20">
                                    <input type="checkbox" id="chk-1"><label for="chk-1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="list-services.php">Retour</a>
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
    <?php include 'footer.php' ?>