<?php
$pagetitle = 'Ajouter Categorie';
include "connexion.php";

$msg = "";
if ($_POST) {


    //2- Récuperation des variables
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $icon = mysqli_real_escape_string($conn, $_POST['icon']);
    $desc = mysqli_real_escape_string($conn, $_POST['Description']);
    $parent = mysqli_real_escape_string($conn, $_POST['Parent']);


    //3- Préparation de la requete
    $req = "INSERT INTO `category_live`(`Name` , `icon` , `Description` , `Parent`) VALUES ('" . $name . "','" . $icon . "','" . $desc . "','" . $parent . "')";

    //echo $req;

    //4- Execution de la requete
    $exec = mysqli_query($conn, $req);
    if ($exec) {
        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> categorie à été ajoutée avec succès.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> categorie non ajoutée!!! 
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
                        <h4 class="box-title">Ajouter categorie pour live Formation</h4>
                        <!-- /.box-title -->
                        <p><?php echo $msg; ?></p>
                        <div class="card-content">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom de categorie</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le nom" name="Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Material Icons</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le code de l'icone" name="icon" required>
                                    <div class='alert alert-success alert-dismissible'>
                                        <strong>Les codes de fontawesome sont disponisble</strong><a href="https://fontawesome.com/v5.15/icons/" target="_blank"> <strong> ici</strong></a>
                                    </div>
                                </div>
                                <div class="m-t-20">
                                    <label for="exampleInputEmail1">Description</label>

                                    <textarea name="Description" class="form-control" placeholder="Entrer Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Parent!
                                    </label>
                                    <select name="Parent" class="form-control">
                                        <option value="0">None</option>
                                        <?php
                                        $query = "SELECT * FROM `category_live` WHERE Parent = 0";

                                        $exec = mysqli_query($conn, $query);

                                        while ($array = mysqli_fetch_array($exec)) {

                                            echo "<option value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="list-category-live.php">Retour</a>
                            </form>
                        </div>
                        <!-- /.card-content -->
                    </div>
                    <!-- /.box-content -->
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>