<?php
include "connexion.php";



if (isset($_GET['partner_id'])) {
    $idpart = $_GET['partner_id'];
    $query_un = "SELECT * FROM `partners` WHERE ID = " . $idpart;

    $exec_un = mysqli_query($conn, $query_un);

    $array_un = mysqli_fetch_array($exec_un);
    $req = "DELETE FROM `partners` WHERE ID=$idpart ";
    $exec = mysqli_query($conn, $req);

    if ($exec) {
        unlink('../uploads/part/' . $array_un['Image']);
    }
    header("location: liste-partenaires.php");
}

?>
<?php include "header.php"; ?>
<!-- /.main-menu -->


<div id="wrapper">
    <div class="main-content">

        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $query = "SELECT * FROM `partners`";

                $exec = mysqli_query($conn, $query);

                while ($array = mysqli_fetch_array($exec)) {

                ?>

                    <tr>
                        <td><?php echo $array['ID']; ?></td>
                        <td><img src="../uploads/part/<?php echo $array['Image']; ?>" alt="partners" style="width:200px; " />
                        </td>
                        <td>

                            <button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>


                        </td>
                    </tr>

                    <div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                        <div class="remodal-content">
                            <h2 id="modal1Title">Supprimer</h2>
                            <p id="modal1Desc">
                                Vous êtes sur de supprimer ce partenaire ?
                            </p>
                        </div>
                        <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                        <a href="?partner_id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
                    </div>
            </tbody>

        <?php } ?>
        </table>
    </div>



    <?php include "footer.php"; ?>