<?php
include "connexion.php";
include 'header.php';

include 'sidebar.php';
?>

<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-12">
                <div class="box-content">
                    <table id="example-edit" class="display" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#NO</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#No</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM `services`";

                            $exec = mysqli_query($conn, $query);

                            while ($array = mysqli_fetch_array($exec)) {

                            ?>


                                <tr>

                                    <td><?php echo $array['ID']; ?></td>

                                    <td><?php echo $array['Name']; ?></td>
                                    <td><?php echo $array['Description']; ?></td>

                                    <td>
                                        <a href="edit-service.php?bl_id=<?php echo $array['ID']; ?>"><i style="color:#fff;background-color:#00aeff;" class="btn btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>

                                        <a href="list_feedback_services.php?bl_id=<?php echo $array['ID']; ?>"><i style="color:#fff;background-color:brown;" class="btn btn-rounded waves-effect waves-light fa fa-question" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>