<?php
include "connexion.php";
$msg = "";
if ($_POST) {

    $videos = array();
    $videos = $_FILES['logo']['name'];
    $i = count($videos);



    for ($j = 0; $j < $i; $j++) {

        $errors = array();
        $file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name'][$j]);

        $file_tmp = $_FILES['logo']['tmp_name'][$j];


        $logo = time() . '_' . $file_name;

        move_uploaded_file($file_tmp, "../uploads/cours/doc/" . $logo);



        // $req = "INSERT INTO `lesson` (`doc`) VALUES ('" . $logo . "')";

        $req = "UPDATE `lesson` SET `doc`='" . $logo . "' WHERE cours_id=" . $_GET['lesson_id'] . " ";



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
                        <h4 class="box-title">Ajouter un documents</h4>

                        <div class="box-content">
                            <!-- /.dropdown js__dropdown -->
                            <div id="rootwizard-pill">
                                <div class="tab-header pill">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <ul>
                                                <li><a href="#tab-pill1" data-toggle="tab">Ajout Documents</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab-pill1">
                                        <p><?php echo $msg; ?></p>
                                        <div class="card-content">
                                            <form method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="lesson_id" value="<?php echo $_GET['lesson_id']; ?>" />
                                                <div id="plus_inputt">
                                                    <!-- /.dropdown js__dropdown -->
                                                    <label for="exampleInputEmail1">Document</label>
                                                    <input required type="file" name="logo[]" id="input-file-now" class="dropify" />

                                                </div>
                                                <div>
                                                    <button type="button" class="plus_yyy"><i class="fa fa-plus"></i></button>
                                                </div>

                                                <br>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">
                                                        Videos!
                                                    </label>
                                                    <input type="hidden" name="lesson_id" value="<?php echo $_GET['lesson_id']; ?>" />
                                                    <select name="title" required="true" class="form-control">
                                                        <option value="">sélectionnez un lesson</option>
                                                        <?php
                                                        $query = "SELECT * FROM `lesson` WHERE cours_id = " . $_GET['lesson_id'] . " ";

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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        </form>
    </div>
</div>
</div>

</div>

</div>
<!-- /.main-content -->
</div>
</div>
</div>
<!--/#wrapper -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
<!-- ================================================== -->


<?php include "footer.php"; ?>