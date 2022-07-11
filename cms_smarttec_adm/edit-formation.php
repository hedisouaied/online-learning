<?php
include "connexion.php";
$id_f = $_GET['suprim_id'];



$msg = "";
$imp_keys = "";
if ($_POST) {




    $query1 = "SELECT * FROM formations_live where ID_f=$id_f ";


    $exec1 = mysqli_query($conn, $query1);

    $array = mysqli_fetch_array($exec1);

    $logo = $array['Image'];
    $img1 = $array['video'];




    $Name_f = mysqli_real_escape_string($conn, $_POST['Name_f']);
    $Desc_f = mysqli_real_escape_string($conn, $_POST['Desc_f']);
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

    $req = "UPDATE `formations_live` SET `Name_f`='" . $Name_f . "',`Desc_f`='" . $Desc_f . "',`Image`='" . $logo . "',`video`='" . $img1 . "',`price`='" . $price . "',`cat_id`='" . $cat_id . "',`contenue1`='" . $contenue1 . "',`contenue2`='" . $contenue2 . "',`contenue3`='" . $contenue3 . "',`contenue4`='" . $contenue4 . "',`contenue5`='" . $contenue5 . "',`contenue6`='" . $contenue6 . "',`meta_keys`='" . $imp_keys . "' WHERE ID_f=" . $id_f . " ";



    //echo $req;

    //4- Execution de la requete
    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre formation a été modifié.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Formation non ajouté!!! 
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
                            <h4 class="box-title">Modifier Formation</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <?php

                                $query1 = "SELECT * FROM formations_live where ID_f=$id_f ";


                                $exec1 = mysqli_query($conn, $query1);

                                $array22 = mysqli_fetch_array($exec1);
                                    $name = $array22['Name_f'];
                                    $description = $array22['Desc_f'];
                                    $price = $array22['price'];
                                    $cat_id = $array22['cat_id'];
                                    $logo = $array22['Image'];
                                    $video = $array22['video'];
                                    $keys = $array22['meta_keys'];
                                    
                                    $key1 = explode(',',$keys);
                                

                                ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titre De formation</label>
                                    <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Titre De cours" name="Name_f" value="<?php echo $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea class="form-control editor_yes" name="Desc_f"><?php echo $description; ?></textarea>
                                </div>

                                <label for="exampleInputEmail1">Prix</label>
                                <div class="input-group">
                                    <div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-usd"></i></label></div>
                                    <!-- /.input-group-btn -->
                                    <input required id="ig-3" type="number" class="form-control" placeholder="Prix" name="price" value="<?php echo $price; ?>">
                                </div>
                                <br>
                              
                                <div class="form-group">
									<label for="exampleInputEmail1">Meta Keywords</label>
									<select class="select2_2 form-control" multiple="multiple" name="meta_keys[]">
									    <?php foreach($key1 as $k){ ?>
									    <option value="<?php echo $k; ?>" selected><?php echo $k; ?></option>
									    <?php } ?>
									</select>
								</div>
                                <div style="display: flex;">
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <label for="exampleInputEmail1">Image Thumbnail</label>
                                        <input type="file" name="logo" id="input-file-now" class="dropify" />
                                        <img src="../uploads/formations/img/<?php echo $logo; ?>" alt="<?php echo $name; ?>" style="width:200px;" />
                                    </div>
                                    <div style="flex: 1;">
                                        <!-- /.dropdown js__dropdown -->
                                        <label for="exampleInputEmail1">Video Preview</label>
                                        <input type="file" name="video" id="input-file-now" class="dropify" />
                                        <video style="width:200px;" controls>
                                            <source src="../uploads/formations/video/<?php echo $video; ?>" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Service!
                                    </label>
                                    <select name="cat_id" class="form-control" required>
                                        <option>sélectionnez une catégorie</option>
                                        <?php
                                        $query = "SELECT * FROM `category_live` WHERE Parent = 0";

                                        $exec = mysqli_query($conn, $query);

                                        while ($array = mysqli_fetch_array($exec)) {

                                            echo "<option style='color:white;background:#00aeff;' disabled value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";

                                            $query1 = "SELECT * FROM `category_live` WHERE Parent = " . $array['ID'];

                                            $exec1 = mysqli_query($conn, $query1);

                                            while ($array1 = mysqli_fetch_array($exec1)) {

                                                echo "<option ";
                                                if ($cat_id == $array1['ID']) {
                                                    echo 'selected';
                                                }
                                                echo " value='" . $array1['ID'] . "'>" . $array1['Name'] . "</option>";
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 1</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue1" value="<?= $array22['contenue1']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 2</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue2" value="<?= $array22['contenue2']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 3</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue3" value="<?= $array22['contenue3']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 4</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue4" value="<?= $array22['contenue4']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 5</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue5" value="<?= $array22['contenue5']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contenue de formation 6</label>
                                            <input type="text" class="form-control" placeholder="Contenue de formation" name="contenue6" value="<?= $array22['contenue6']; ?>">
                                        </div>
                                    </div>
                                
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="liste-formations.php">Retour</a>
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