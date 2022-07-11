<?php
include "connexion.php";


if (isset($_GET['suprim_id'])) {
	$idpro = $_GET['suprim_id'];

	$query_un = "SELECT * FROM `cours` WHERE ID_c = " . $idpro;

	$exec_un = mysqli_query($conn, $query_un);

	$array_un = mysqli_fetch_array($exec_un);

	$query_ls = "SELECT * FROM `lesson` WHERE cours_id = " . $idpro;

	$exec_ls = mysqli_query($conn, $query_ls);

	while ($array_ls = mysqli_fetch_array($exec_ls)) {
		unlink('../uploads/cours/lessons/' . $array_ls['video']);
	}

	$req = "DELETE FROM `cours` WHERE ID_c= " . $idpro;
	$exec = mysqli_query($conn, $req);

	if ($exec) {
		unlink('../uploads/cours/video/' . $array_un['video']);
		unlink('../uploads/cours/img/' . $array_un['Image']);
	}
	header("location: liste-cours.php");
}

?>
<?php include "header.php"; ?>
<!-- /.main-menu -->
<?php include "sidebar.php"; ?>


<div id="wrapper">
	<div class="main-content">

		<table id="example" class="table table-striped table-bordered display" style="width:100%">
			<thead>
				<tr>
					<th>#ID</th>
					<th>Nom</th>
					<th>Date</th>
					<th>Ajouter des sections</th>
					<th>Ajouter des lessons</th>
					<th>Ajouter des quizs</th>
					<th>Modifier le cours</th>
					<th>Supprimer le cours</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>#ID</th>
					<th>Nom</th>
					<th>Date</th>
					<th>Ajouter des sections</th>
					<th>Ajouter des lessons</th>
					<th>Ajouter des quizs</th>
					<th>Modifier le cours</th>
					<th>Supprimer le cours</th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				$query = "SELECT * FROM `cours`";

				$exec = mysqli_query($conn, $query);

				while ($array = mysqli_fetch_array($exec)) {

				?>

					<tr style="text-align: center;">
						<td><?php echo $array['ID_c']; ?></td>
						<td><?php echo $array['Name_c']; ?></td>
						<td><?php echo $array['date']; ?></td>
						<td><a href="ajou-section.php?lesson_id=<?php echo $array['ID_c']; ?>"><i style="color:#fff;background-color:grey;" class="btn btn-warning btn-rounded waves-effect waves-light  fa fa-list-alt" aria-hidden="true"></i></a></td>
						</td>
						<td><a href="ajou-lesson.php?lesson_id=<?php echo $array['ID_c']; ?>"><i class="btn btn-success btn-rounded waves-effect waves-light fa fa-video-camera" aria-hidden="true"></i></a></td>
						<td><a href="ajout-quiz.php?lesson_id=<?php echo $array['ID_c']; ?>"><i style="color:#fff;background-color:#ed0b4c;" class="btn btn-warning btn-rounded waves-effect waves-light  fa fa-question" aria-hidden="true"></i></a></td>
						</td>
						<td><a href="edit-cours.php?suprim_id=<?php echo $array['ID_c']; ?>"><i class="btn btn-info btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a></td>
						<td>
							<button type="button" data-remodal-target="remodal<?php echo $array['ID_c']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>
						</td>
					</tr>


					<div class="remodal" data-remodal-id="remodal<?php echo $array['ID_c']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
						<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
						<div class="remodal-content">
							<h2 id="modal1Title">Supprimer</h2>
							<p id="modal1Desc">
								Vous êtes sur de supprimer ce cours ?
							</p>
						</div>
						<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
						<a href="?suprim_id=<?php echo $array['ID_c']; ?>" class="btn btn-primary">Supprimer</a>
					</div>


				<?php } ?>
			</tbody>
		</table>
	</div>



	<?php include "footer.php"; ?>