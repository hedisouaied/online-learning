<?php
$pagetitle = 'Formation en direct';
include "connexion.php";

if (isset($_GET['suprim_id'])) {
    $idf = $_GET['suprim_id'];
    $req = "DELETE FROM `formations_live` WHERE ID_f=$idf ";
    $exec = mysqli_query($conn, $req);
}

?>
<?php include "header.php"; ?>
<!-- /.main-menu -->
<style>
    .bootstrap-touchspin-prefix{
        display: none;
    }
</style>

<div id="wrapper">
    <div class="main-content">

        <table class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Ordre de formation</th>
                    <th>Date</th>
                    <th>Modifier le cours</th>
                    <th>Ajouter des quizs</th>
                    <th>calendrier</th>
                    <th>Sessions</th>
                    <th>Supprimer le cours</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Ordre de formation</th>
                    <th>Date</th>
                    <th>Modifier le cours</th>
                    <th>Ajouter des quizs</th>
                    <th>calendrier</th>
                    <th>Sessions</th>
                    <th>Supprimer le cours</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                $query = "SELECT * FROM `formations_live`";

                $exec = mysqli_query($conn, $query);

                while ($array = mysqli_fetch_array($exec)) {

                ?>

                    <tr style="text-align: center;">
                        <td><img src="../uploads/formations/img/<?php echo $array['Image']; ?>" alt="<?php echo $array['Name_f']; ?>" style="width:100px; " /></td>
                        <td><?php echo $array['Name_f']; ?></td>
                        <td>
                            <form method="POST" action="" class="form_order">
                                <input type="hidden" name="id" value="<?php echo $array['ID_f']; ?>">
							<input id="demo2" type="text" required value="<?php echo $array['ordre_f']; ?>" name="demo2" class="col-md-8 form-control">
							<button type="submit" class="btn">Enregistrer</button>
							</form>
						</td>
                        <td><?php echo $array['date']; ?></td>
                        <td><a href="edit-formation.php?suprim_id=<?php echo $array['ID_f']; ?>"><i class="btn btn-info btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a></td>
                        <td><a href="ajou-quiz-live.php?cours_id=<?php echo $array['ID_f']; ?>"><i style="color:#fff;background-color:#ed0b4c;" class="btn btn-warning btn-rounded waves-effect waves-light  fa fa-question" aria-hidden="true"></i></a></td>
                        <td><a href="calendrier.php?cal_id=<?php echo $array['ID_f']; ?>"><i class="btn btn-success btn-rounded waves-effect waves-light fa fa-clock-o" aria-hidden="true"></i></a></td>
                        <td><a href="liste-sessions.php?cal_id=<?php echo $array['ID_f']; ?>"><i class="btn btn-warning btn-rounded waves-effect waves-light fa fa-clock-o" aria-hidden="true"></i></a></td>

                        <td>
                            <button type="button" data-remodal-target="remodal<?php echo $array['ID_f']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>


                    <div class="remodal" data-remodal-id="remodal<?php echo $array['ID_f']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                        <div class="remodal-content">
                            <h2 id="modal1Title">Supprimer</h2>
                            <p id="modal1Desc">
                                Vous êtes sur de supprimer cette formation ?
                            </p>
                        </div>
                        <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                        <a href="?suprim_id=<?php echo $array['ID_f']; ?>" class="btn btn-primary">Supprimer</a>
                    </div>


                <?php } ?>
            </tbody>
        </table>
    </div>



    <?php include "footer.php"; ?>
    <script>
        $('.form_order').on('submit',function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();

		$.ajax({

			url: "update_order_ajax.php",
			method: "POST",
			data:form_data,
			dataType: "JSON",
			success: function(data) {
				alert(data.error);
			}

		});
	});
    </script>