<?php
include 'connexion.php';
$dec = "SELECT * FROM `events` WHERE id > " . $_GET['id'] . ' LIMIT 1 ';

$ece_d = mysqli_query($conn, $dec);
$yy_id = mysqli_fetch_array($ece_d);
//echo $yy_id['id'];


$pagetitle = 'Modifier lesson';
$msg = "";
if ($_POST) {


    $section_id = mysqli_real_escape_string($conn, $_POST['section_id']);

    $event_id = $_POST['event_id'];

    $req = "UPDATE `events` SET `ID_f`='" . $section_id . "' WHERE id=" . $event_id . " ";



    //echo $req;

    //4- Execution de la requete
    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre lesson a été modifié.
</div>";
        header("location:liste-sessions.php");
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> lesson non modifié!!! 
</div>";
    }
}
?>

<?php include "header.php"; ?>
<!-- /.main-menu -->

<!-- Form Wizard -->
<link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">

<link rel="stylesheet" href="assets/plugin/form-wizard/prettify.css">
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">Selectionner la formation de la session <?php echo $yy_id['title']; ?> </h4>


                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">



                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Section!
                                    </label>
                                    <input type="hidden" name="event_id" value="<?php echo $yy_id['id']; ?>" />
                                    <select name="section_id" class="form-control" required>
                                        <option value="">sélectionnez une section</option>
                                        <?php
                                        $query = "SELECT * FROM `formations_live` ";

                                        $exec = mysqli_query($conn, $query);

                                        while ($array = mysqli_fetch_array($exec)) {

                                            echo "<option value='" . $array['ID_f'] . "'  >" . $array['Name_f'] . "</option>";
                                        }

                                        ?>
                                    </select>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box-content -->
    </div>

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

<!-- /.row small-spacing -->

</div>
<!-- /.main-content -->
</div>


<?php include "footer.php"; ?>