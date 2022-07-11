<?php

$pagetitle = "Sections";
include "connexion.php";

$msg = "";
if (isset($_POST['ajout'])) {


    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $order = mysqli_real_escape_string($conn, $_POST['order']);

    $query = "SELECT * FROM `section` WHERE course_id = " . $_GET['lesson_id'] . " ";

    $exec = mysqli_query($conn, $query);
    $zz = 0;
    while ($array = mysqli_fetch_array($exec)) {
        if ($array['orderr'] == $order) {
            $zz++;
        }
    }
    if ($zz == 0) {

        $req = "INSERT INTO `section`(`title`, `course_id`, `orderr`) VALUES ('" . $title . "','" . $_GET['lesson_id'] . "','" . $order . "')";


        $exec = mysqli_query($conn, $req);
        if ($exec) {
            $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> section a été ajouté avec succès.
</div>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> section non ajouté!!! 
</div>";
        }
    } else {
        $taken = "<div class='alert alert-danger alert-dismissible' role='alert'> 
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>cet order ajouté </strong> est existé!!! 
    </div>";
    }
}
$msg = "";
if (isset($_POST['modifier'])) {


    $title = mysqli_real_escape_string($conn, $_POST['titre']);
    $order = mysqli_real_escape_string($conn, $_POST['order']);
    $id = $_POST['id'];

    $query = "SELECT * FROM `section` WHERE course_id = " . $_GET['lesson_id'] . " AND ID != $id ";

    $exec = mysqli_query($conn, $query);
    $zz = 0;
    while ($array = mysqli_fetch_array($exec)) {
        if ($array['orderr'] == $order) {
            $zz++;
        }
    }
    if ($zz == 0) {

        $req = "UPDATE `section` SET `title`='" . $title . "',`orderr`='" . $order . "' WHERE ID=" . $id . " ";



        $exec = mysqli_query($conn, $req);
        if ($exec) {
            $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> section à été modifié avec succès.
</div>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> section non modifié!!! 
</div>";
        }
    } else {
        $takenn = "<div class='alert alert-danger alert-dismissible' role='alert'> 
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>cet order modifié </strong> est existé!!! 
    </div>";
    }
}

if (isset($_GET['supp_id'])) {
    $idsec = $_GET['supp_id'];
    $req = "DELETE FROM `section` WHERE ID=$idsec ";
    $exec = mysqli_query($conn, $req);
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
                        <h4 class="box-title">Ajouter Sections</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom de section</label>
                                    <input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer la section" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section Order</label>
                                    <?php
                                    if (isset($taken)) {
                                        echo $taken;
                                    }

                                    ?>
                                    <input required type="number" class="form-control" placeholder="Entrer l'ordre de section'" name="order">
                                </div>

                                <button type="submit" name="ajout" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="liste-cours.php">Retour</a>
                            </form>
                        </div>
                        <?php
                        $sec = "SELECT * FROM cours WHERE ID_c = " . $_GET['lesson_id'] . " ";
                        $sec_exec = mysqli_query($conn, $sec);
                        $sec_array = mysqli_fetch_array($sec_exec);
                        $check_sec = mysqli_num_rows($sec_exec);
                        if ($check_sec == 0) {
                            header('location:liste-cours.php');
                        }
                        ?>
                        <h1 class="text-center">Liste des sections de <?php echo $sec_array['Name_c']; ?> </h1>
                        <?php
                        $query = "SELECT * FROM `section` WHERE course_id = " . $_GET['lesson_id'] . " order BY orderr ASC ";

                        $exec = mysqli_query($conn, $query);

                        while ($array = mysqli_fetch_array($exec)) { ?>
                            <div class="col-lg-6 col-md-6 col-xs-12">

                                <div class="box-content bordered info js__card">
                                    <h4 class="box-title with-control">
                                        <?php echo $array['title'] ?>

                                        <span class="controls" style="right:87px;">
                                            <button type="button" class="control fa fa-minus js__card_minus"></button>
                                        </span>
                                    </h4>
                                    <div class="dropdown js__drop_down">
                                        <a style="color: #000!important;" href="?lesson_id=<?php echo $_GET['lesson_id']; ?>&supp_id=<?php echo $array['ID']; ?>" class=""> Supprimer</a>
                                    </div>
                                    <!-- /.box-title -->

                                    <div class="js__card_content">
                                        <form method="post">
                                            <label for="exampleInputEmail1">Section Nom</label>
                                            <input required type="text" class="form-control" placeholder="Entrer l'ordre de section'" name="titre" value="<?php echo $array['title'] ?>">
                                            <label for="exampleInputEmail1">Section Order</label>
                                            <?php
                                            if (isset($takenn)) {
                                                if ($id ==  $array['ID']) {
                                                    echo $takenn;
                                                }
                                            }
                                            ?>
                                            <input required type="number" class="form-control" placeholder="Entrer l'ordre de section'" name="order" value="<?php echo $array['orderr'] ?>">

                                            <input type="hidden" name="id" value="<?php echo $array['ID'] ?>" />
                                            <input type="submit" name="modifier" class="btn btn-primary" value="modifier">

                                        </form>

                                    </div>
                                </div>

                                <!-- /.box-content -->
                            </div>
                        <?php
                        }
                        ?>
                        <!-- /.card-content -->
                    </div>
                    <!-- /.box-content -->
                </div>
            </div>
        </div>
        <?php

        include 'footer.php';
        ?>