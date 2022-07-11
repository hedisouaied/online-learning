<?php
ob_start();
include "connexion.php";
$pagetitle = "Liste des formateurs";
include "header.php";

if (isset($_GET['do'])) {
    $do = $_GET['do'];
} else {
    $do = "manage";
}


if ($do == "manage") { //manage page  

    $query = "SELECT * FROM `recrute`";

    $exec = mysqli_query($conn, $query);



?>

    <div id="wrapper">
        <div class="main-content container">
            <div class="row small-spacing">

                <?php while ($row = mysqli_fetch_array($exec)) { ?>
                    <div class="col-md-10 col-xs-10">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box-content card">
                                    <div class="box-content  info js__card card-closed ">

                                        <h4 class="box-title with-control">
                                            <i class="fa fa-user ico"></i>
                                            <?php echo $row['Nom'] . " " . $row['Prenom']; ?>
                                            <span class="controls" style="right:97px;top:35px;">
                                                <button type="button" class="control fa fa-minus js__card_minus"></button>
                                            </span>
                                        </h4>
                                        <!-- /.box-title -->
                                        <div class="dropdown js__drop_down" style="top: 24px;right: 24px;">
                                            <a class="dropdown-icon glyphicon "><button type="button" data-remodal-target="remodal<?php echo $row['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button></a>

                                            <!-- /.sub-menu -->
                                        </div>


                                        <div class="remodal" data-remodal-id="remodal<?php echo $row['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                            <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                            <div class="remodal-content">
                                                <h2 id="modal1Title">Supprimer</h2>
                                                <p id="modal1Desc">
                                                    Vous êtes sur de supprimer ce formateur ?
                                                </p>
                                            </div>
                                            <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                                            <a href="recrute.php?do=delete&id=<?php echo $row['ID']; ?>" class="btn btn-primary">Supprimer</a>
                                        </div>

                                        <!-- /.dropdown js__dropdown -->
                                        <div class="js__card_content" style="display:none;">
                                            <div class="card-content">
                                                <div class="row recrute">
                                                    <div class="col-md-6">
                                                        <div class="row ">
                                                            <div class="col-xs-5"><label>Nom:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php echo $row['Nom']; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                    <!-- /.col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>Prènom:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php echo $row['Nom']; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <!-- /.col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>Email:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php echo $row['Email']; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                    <!-- /.col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>Pays:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php echo $row['Pays']; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>Téléphone:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php echo $row['Phone']; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                    <!-- /.col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>Fonction actuelle:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php echo $row['Fonction']; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                    <!-- /.col-md-6 -->

                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>CV:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><a target="_blank" href="../uploads/cv/<?php echo $row['CV']; ?>"><?php echo $row['CV']; ?></a></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                    <!-- /.col-md-6 -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>Outils de création:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php if ($row['Outil'] == 1) {
                                                                                        echo "Oui";
                                                                                    } else {
                                                                                        echo "Non";
                                                                                    }; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <!-- /.col-md-6 -->
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>Adresse:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php echo $row['Adresse']; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-xs-5"><label>Pourquoi rejoindre notre équipe:</label></div>
                                                            <!-- /.col-xs-5 -->
                                                            <div class="col-xs-7"><?php echo $row['Bute']; ?></div>
                                                            <!-- /.col-xs-7 -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                    <!-- /.col-md-6 -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>
                                        <!-- /.card-content -->
                                    </div>
                                </div>
                                <!-- /.box-content card -->
                            </div>


                        </div>

                    </div>
                <?php } ?>

            </div>

        </div>
        <!-- /.main-content -->
    </div>

<?php
} elseif ($do == "delete") {   //delete page

    echo ' <h1 class="text-center">Delete Member</h1> ';
    echo '<div class="container">';


    $userid =     isset($_GET['id']) && is_numeric($_GET['id']) ?  intval($_GET['id']) : 0;





    //$check = checkitems('ID', 'recrute', $userid);
    $idf = $userid;
    $req = "DELETE FROM `recrute` WHERE ID=$idf ";
    $exec = mysqli_query($conn, $req);
    echo '<div class="alert alert-success">Delete Done </div>';
    header('location:recrute.php');


    echo "</div>";
} else {
    header('location:recrute.php');
}


include "footer.php";
ob_end_flush();
?>