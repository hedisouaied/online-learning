<?php
$pagetitle = "Liste Slider";
include "connexion.php";


if (isset($_GET['slidesup_id'])) {
	$idsli = $_GET['slidesup_id'];
	$query_un = "SELECT * FROM `slider` WHERE ID = " . $idsli;

	$exec_un = mysqli_query($conn, $query_un);

	$array_un = mysqli_fetch_array($exec_un);
	$req = "DELETE FROM `slider` WHERE ID=$idsli ";
	$exec = mysqli_query($conn, $req);

	if ($exec) {
		unlink('../uploads/sliders/' . $array_un['Image']);
	}
	header("location: liste-sliders.php");
}

?>
<?php include "header.php"; ?>



<div id="wrapper">

	<div class="main-content">
		<a class="btn btn-primary" href="ajout-slider.php">Ajout Slider</a>

		<table id="example" class="table table-striped table-bordered display" style="width:100%">
			<thead>
				<tr>
					<th>Image</th>
					<th>Nom</th>
					<th>Text</th>
					<th>Action</th>

				</tr>
			</thead>

			<tbody>
				<?php
				$query = "SELECT * FROM `slider`";

				$exec = mysqli_query($conn, $query);

				while ($array = mysqli_fetch_array($exec)) {

				?>

					<tr>
						<td><img src="../uploads/sliders/<?php echo $array['Image']; ?>" alt="<?php echo $array['Name']; ?>" style="width:200px; " />
						</td>
						<td><?php echo $array['Name']; ?></td>
						<td><?php echo $array['Text']; ?></td>
						<td>

							<button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>

							<a href="edit-slider.php?slidesup_id=<?php echo $array['ID']; ?>"><i style="color:#fff;background-color:#00aeff;" class="btn btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>
						</td>
					</tr>

					<div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
						<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
						<div class="remodal-content">
							<h2 id="modal1Title">Supprimer</h2>
							<p id="modal1Desc">
								Vous êtes sur de supprimer cette slider ?
							</p>
						</div>
						<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
						<a href="?slidesup_id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
					</div>
			</tbody>

		<?php } ?>
		</table>
	</div>



	<?php include "footer.php"; ?>