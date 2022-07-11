<?php
$pagetitle = "Ajout Formation En Direct";
include "connexion.php";

$msg = "";
$imp_keys = "";
if ($_POST) {

    // $logo = '';

    //2- Récuperation des variables
    $Name_c = mysqli_real_escape_string($conn, $_POST['Name_f']);
    $Desc_c = mysqli_real_escape_string($conn, $_POST['Desc_f']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $contenue1 = mysqli_real_escape_string($conn, $_POST['contenue1']);
    $contenue2 = mysqli_real_escape_string($conn, $_POST['contenue2']);
    $contenue3 = mysqli_real_escape_string($conn, $_POST['contenue3']);
    $contenue4 = mysqli_real_escape_string($conn, $_POST['contenue4']);
    $contenue5 = mysqli_real_escape_string($conn, $_POST['contenue5']);
    $contenue6 = mysqli_real_escape_string($conn, $_POST['contenue6']);

// start emplode text values
	if (array($_POST['meta_keys'])) {

		$imp_keys = mysqli_real_escape_string($conn,implode(",", $_POST['meta_keys']));
	}
	// end emplode text values


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



        $logo = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/formations/img/" . $logo);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }

    $img1 = "";

    if (!empty($_FILES['video']['name'])) {
        $errors = array();
        $file_name1 = mysqli_real_escape_string($conn, $_FILES['video']['name']);
        $file_size = $_FILES['video']['size'];
        $file_tmp = $_FILES['video']['tmp_name'];
        $file_type = $_FILES['video']['type'];
        $exp = explode('.', $_FILES['video']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");





        $img1 = time() . '_' . $file_name1;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/formations/video/" . $img1);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }


    $req = "INSERT INTO `formations_live`(`Name_f`,`Desc_f`, `Image`, `video`,`price`,`cat_id`, `meta_keys`, `contenue1`, `contenue2`, `contenue3`, `contenue4`, `contenue5`, `contenue6`, `date`) VALUES('" . $Name_c . "','" . $Desc_c . "','" . $logo . "','" . $img1 . "','" . $price . "','" . $cat_id . "','" . $imp_keys . "','" . $contenue1 . "','" . $contenue2 . "','" . $contenue3 . "','" . $contenue4 . "','" . $contenue5 . "','" . $contenue6 . "',now())";


    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Formation a été ajouté.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Formation non ajoutée!!! 
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
                        <h4 class="box-title">Ajout Formations</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titre De Formations</label>
                                    <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Titre De cours" name="Name_f">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea required class="form-control editor_yes" name="Desc_f"> </textarea>
                                </div>

                                <label for="exampleInputEmail1">Prix</label>
                                <div class="input-group">
                                    <div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-usd"></i></label></div>
                                    <!-- /.input-group-btn -->
                                    <input required id="ig-3" type="number" class="form-control" placeholder="Prix" name="price">
                                </div>
                                <br>
                                <div class="form-group">
									<label for="exampleInputEmail1">Meta Keywords</label>
									<select class="select2_2 form-control" multiple="multiple" name="meta_keys[]">
									</select>
								</div>
                                <div style="display: flex;">
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <label for="exampleInputEmail1">Image Thumbnail</label>
                                        <input accept="image/png,image/jpeg,image/jpg" type="file" name="logo" id="input-file-now" class="dropify" required />
                                    </div>
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <label for="exampleInputEmail1">Video Preview</label>
                                        <input accept="video/mp4,video/x-m4v,video/*" type="file" name="video" id="input-file-now" class="dropify" required />
                                    </div>

                                </div>
                                <br>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Category!
                                    </label>
                                    <select name="cat_id" class="form-control" required>
                                        <option value="">sélectionnez un service</option>
                                        <?php
                                        $query = "SELECT * FROM `category_live` WHERE Parent = 0";

                                        $exec = mysqli_query($conn, $query);

                                        while ($array = mysqli_fetch_array($exec)) {

                                            echo "<option style='color:white;background:#00aeff;' disabled value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";

                                            $query1 = "SELECT * FROM `category_live` WHERE Parent = " . $array['ID'];

                                            $exec1 = mysqli_query($conn, $query1);

                                            while ($array1 = mysqli_fetch_array($exec1)) {

                                                echo "<option value='" . $array1['ID'] . "'>" . $array1['Name'] . "</option>";
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 1</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue1" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 2</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 3</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue3">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 4</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue4">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 5</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue5">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 6</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue6">
                                        </div>
                                    </div>
                                
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