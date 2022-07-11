<?php
$pagetitle = 'Liste Sessions';
include "connexion.php";
?>
<?php include "header.php"; ?>
<!-- /.main-menu -->


<div id="wrapper">

    <div class="main-content">
       <div>
                    <a class="btn btn-primary" href="liste-formations.php">Liste des formations</a>
                </div>
        <br>
        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Modifier la session</th>
                    <th>Séances</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nom</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Modifier la session</th>
                    <th>Séances</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $query = "SELECT * FROM `events` WHERE ID_f = " . $_GET['cal_id'] . " ";

                $exec = mysqli_query($conn, $query);

                while ($array = mysqli_fetch_array($exec)) {

                ?>

                    <tr style="text-align: center;">
                        <td><?php echo $array['title'] ?></td>
                        <td><?php echo $array['start_event']; ?></td>
                        <td><?php echo $array['end_event']; ?></td>
                        <td><a href="edit-session.php?suprim_id=<?php echo $array['id']; ?>"><i class="btn btn-info btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a></td>
                        <td><a href="ajout-seances.php?session_id=<?php echo $array['id']; ?>"><i class="btn btn-success btn-rounded waves-effect waves-light fa fa-clock-o" aria-hidden="true"></i></a></td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>



    <?php include "footer.php"; ?>