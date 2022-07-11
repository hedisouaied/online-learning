<?php
include "connexion.php";
include 'header.php';

if (isset($_GET['con_id'])) {
    $idc = $_GET['con_id'];
    $req = "DELETE FROM `certificate` WHERE ID=$idc ";
    $exec = mysqli_query($conn, $req);
}
?>
<style>
    .modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 0;
        background-color: #000;
    }
</style>
<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-12">
                <div class="box-content">
                    <table id="example-edit" class="display" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Nom & Prenom</th>
                                <th>Formation</th>
                                <th>Code Certificat</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nom & Prenom</th>
                                <th>Formation</th>
                                <th>Code Certificat</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM `certificate` WHERE Type = 'Direct'";

                            $exec = mysqli_query($conn, $query);

                            while ($array = mysqli_fetch_array($exec)) {

                            ?>


                                <tr>
                                    <td><?php $req_user = "SELECT * FROM clients WHERE ID = " . $array['ID_sess'] . " ";
                                        $exec_user = mysqli_query($conn, $req_user);
                                        $array_user = mysqli_fetch_array($exec_user);
                                        echo $array_user['fullname'] ?></td>
                                    <td><?php $req_cour = "SELECT * FROM formations_live WHERE ID_f = " . $array['ID_cours'] . " ";
                                        $exec_cour = mysqli_query($conn, $req_cour);
                                        $array_cour = mysqli_fetch_array($exec_cour);
                                        echo $array_cour['Name_f'] ?></td>
                                    <td><?php echo $array['code_certif']; ?></td>
                                    <td><?php echo $array['date_certif']; ?></td>


                                    <td>
                                        <button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                        <a href="downloadcertif.php?code=<?php echo $array['code_certif']; ?>&user=<?php echo $array_user['ID'] ?>&cours=<?php echo $array_cour['ID_f']; ?>&pdf=<?php echo $array['PDF']; ?>" class="btn btn-rounded btn-info waves-effect waves-light"><i class="fa fa-download"></i></a>


                                        <a type="button" data-toggle="modal" data-target="#example<?php echo $array['ID']; ?>Modal" class="btn btn-rounded btn-success waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="example<?php echo $array['ID']; ?>Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div style="margin: 7rem auto;" class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">certificat</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <img src="../test_certif/certificate/<?php echo $array['code_certif'] . $array_user['ID'] . $array_cour['ID_f'] . '.jpg' ?>" alt="" />

                                        </div>
                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>

                                        </div>
                                    </div>
                                </div>

                                <div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                    <div class="remodal-content">
                                        <h2 id="modal1Title">Supprimer</h2>
                                        <p id="modal1Desc">
                                            Vous êtes sur de supprimer cette certificat ?
                                        </p>
                                    </div>
                                    <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                                    <a href="?con_id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
                                </div>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col-xs-12 -->
        </div>

    </div>
    <!-- /.main-content -->
</div>

<?php include 'footer.php'; ?>