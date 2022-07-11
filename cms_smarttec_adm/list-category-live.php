<?php
$pagetitle = "Categories live";
include "connexion.php";

if (isset($_GET['suprim_id'])) {


    $idcatli = $_GET['suprim_id'];

    $req = "DELETE FROM `category_live` WHERE ID=$idcatli ";
    $exec = mysqli_query($conn, $req);

    $req_child = "SELECT * FROM category_live WHERE Parent = " . $idcatli . " ";
    $exec_child = mysqli_query($conn, $req_child);
    while ($array_child = mysqli_fetch_array($exec_child)) {
        $reqq = "DELETE FROM `category_live` WHERE ID= " . $array_child['ID'];
        $execc = mysqli_query($conn, $reqq);
    }
    header("location:list-category-live.php");
}

?>
<?php include "header.php"; ?>
<!-- /.main-menu -->
<?php include "sidebar.php"; ?>


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-12">
                <div class="box-content">


                    <div class="col-xs-12">
                        <a class="btn btn-primary" href="ajout-categorie-live.php">Ajout Categorie</a>
                        <div class="box-content">

                            <h4 class="box-title">Categories</h4>
                            <!-- /.box-title -->
                            <!-- /.dropdown js__dropdown -->
                            <div id="accordion" class="js__ui_accordion">
                                <?php
                                $query = "SELECT * FROM `category_live` WHERE Parent = 0";

                                $exec = mysqli_query($conn, $query);

                                while ($array = mysqli_fetch_array($exec)) {

                                ?>

                                    <h3 class="accordion-title" style="padding: 20px;"><?php echo $array['Name']; ?>

                                    </h3>
                                    <div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                        <div class="remodal-content">
                                            <h2 id="modal1Title">Supprimer</h2>
                                            <p id="modal1Desc">
                                                Vous êtes sur de supprimer cette Categorie ?
                                            </p>
                                        </div>
                                        <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                                        <a href="?suprim_id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
                                    </div>
                                    <div class="accordion-content">
                                        <a href="edit-categorie-live.php?id=<?php echo $array['ID']; ?>" class="btn btn-info btn-xs waves-effect waves-light pull-right">Modifier</a>
                                        <a type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-danger btn-xs waves-effect waves-light pull-right">Supprimer</a>
                                        <p><?php echo $array['Description']; ?></p>

                                        <ul>
                                            <?php
                                            $query1 = "SELECT * FROM `category_live` WHERE Parent = " . $array['ID'];

                                            $exec1 = mysqli_query($conn, $query1);

                                            while ($array1 = mysqli_fetch_array($exec1)) {

                                            ?>

                                                <li style="padding: 10px;"><?php echo $array1['Name']; ?>
                                                    <a type="button" href="edit-categorie-live.php?id=<?php echo $array1['ID']; ?>" class="btn btn-info btn-xs waves-effect waves-light pull-right">Modifier</a>
                                                    <a type="button" data-remodal-target="remodal<?php echo $array1['ID']; ?>" class="btn btn-danger btn-xs waves-effect waves-light pull-right">Supprimer</a>
                                                </li>

                                                <div class="remodal" data-remodal-id="remodal<?php echo $array1['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                                    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                                    <div class="remodal-content">
                                                        <h2 id="modal1Title">Supprimer</h2>
                                                        <p id="modal1Desc">
                                                            Vous êtes sur de supprimer cette Categorie ?
                                                        </p>
                                                    </div>
                                                    <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                                                    <a href="?suprim_id=<?php echo $array1['ID']; ?>" class="btn btn-primary">Supprimer</a>
                                                </div>

                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php
                                }

                                ?>
                            </div>
                        </div>

                        <!-- /.box-content -->
                    </div>
                </div>
                <?php include 'footer.php'; ?>