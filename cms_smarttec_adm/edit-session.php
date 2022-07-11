<?php
$pagetitle = "Modifier Session";
include "connexion.php";
$id_f = $_GET['suprim_id'];



$msg = "";
if ($_POST) {


    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);
    $zoom = mysqli_real_escape_string($conn, $_POST['zoom']);
    $form_id = mysqli_real_escape_string($conn, $_POST['form_id']);
    $desc = mysqli_real_escape_string($conn, $_POST['Description']);



    $req = "UPDATE `events` SET `title`='" . $title . "',`Description`='" . $desc . "',`start_event`='" . $start . "',`end_event`='" . $end . "',`zoom_link`='" . $zoom . "',`ID_f`='" . $form_id . "' WHERE id=" . $id_f . " ";



    //echo $req;

    //4- Execution de la requete
    $exec = mysqli_query($conn, $req);

    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Session a été modifiée.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Session non modifiée!!! 
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
                        <h4 class="box-title">Modifier Session</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <?php

                                $query1 = "SELECT * FROM events where id=$id_f ";


                                $exec1 = mysqli_query($conn, $query1);

                                while ($array = mysqli_fetch_array($exec1)) {
                                    $title = $array['title'];
                                    $start = $array['start_event'];
                                    $end = $array['end_event'];
                                    $zoom = $array['zoom_link'];
                                    $form = $array['ID_f'];
                                    $desc = $array['Description'];
                                }

                                ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titre De Session</label>
                                    <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Titre De cours" name="title" value="<?php echo $title; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control editor_yes" name="Description"><?php echo $desc; ?>
</textarea>
                                </div>

                                <label for="exampleInputEmail1">Date Debut</label>
                                <div class="input-group">
                                    <div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-clock-o"></i></label></div>
                                    <!-- /.input-group-btn -->
                                    <input required id="ig-3" type="date" class="form-control" placeholder="Prix" name="start" value="<?php echo $start; ?>">
                                </div>

                                <label for="exampleInputEmail1">Date Fin</label>
                                <div class="input-group">
                                    <div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-clock-o"></i></label></div>
                                    <!-- /.input-group-btn -->
                                    <input required id="ig-3" type="date" class="form-control" placeholder="Prix" name="end" value="<?php echo $end; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Nom de formation!
                                    </label>
                                    <select name="form_id" class="form-control" required>
                                        <option value="">sélectionnez une formations</option>
                                        <?php

                                        $query1 = "SELECT * FROM `formations_live` ";

                                        $exec1 = mysqli_query($conn, $query1);

                                        while ($array1 = mysqli_fetch_array($exec1)) {

                                            echo "<option ";
                                            if ($form == $array1['ID_f']) {
                                                echo 'selected';
                                            }
                                            echo " value='" . $array1['ID_f'] . "'>" . $array1['Name_f'] . "</option>";
                                        }


                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lien Zoom</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le lien zoom" name="zoom" value="<?php echo $zoom; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="liste-sessions.php?cal_id=<?php echo $form; ?>">Retour</a>
                            </form>
                        </div>
                        <!-- /.card-content -->
                    </div>
                    <!-- /.box-content -->
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row small-spacing -->

        </div>
        <!-- /.main-content -->
    </div>

    <?php include "footer.php"; ?>