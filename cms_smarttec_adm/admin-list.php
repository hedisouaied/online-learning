<?php
$pagetitle = "Liste D'admins";
include "connexion.php";
include 'header.php';

if (isset($_GET['user_id'])) {
	$idus = $_GET['user_id'];
	$req = "DELETE FROM `users` WHERE UserID=$idus ";
	$exec = mysqli_query($conn, $req);
}
?>



<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
			<div class="col-xs-12">
				<a class="btn btn-primary" href="ajout-admin.php">Ajout Admin</a>
				<div class="box-content">
					<table id="example-edit" class="display" style="width: 100%">
						<thead>
							<tr>
								<th>Image</th>
								<th>Nom d'admin</th>
								<th>Email</th>
								<th>Nom et Prénom</th>
								<th>Phone</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Image</th>
								<th>Nom d'admin</th>
								<th>Email</th>
								<th>Nom et Prénom</th>
								<th>Phone</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php
							$query = "SELECT * FROM `users` WHERE UserID != " . $_SESSION['id'];

							$exec = mysqli_query($conn, $query);

							while ($array = mysqli_fetch_array($exec)) {

							?>


								<tr>
									<?php if (!empty($array['Profile'])) {
									?>

										<td><img style="width:70px;height:70px;" src="../uploads/avatars/<?php echo $array['Profile']; ?>"></td>
									<?php } else {

									?>
										<td><img style="width:70px;height:70px;" src="../uploads/avatars/unk.jpeg"></td>
									<?php } ?>


									<td><?php echo $array['UserName']; ?></td>
									<td><?php echo $array['Email']; ?></td>
									<td><?php echo $array['FullName']; ?></td>
									<td><?php echo $array['Phone']; ?></td>
									<td><?php echo $array['Date']; ?></td>

									<td>
										<button type="button" data-remodal-target="remodal<?php echo $array['UserID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>

										<a href="edit-admin.php?user_id=<?php echo $array['UserID']; ?>"><i style="color:#fff;background-color:#00aeff;" class="btn btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>
									</td>
								</tr>


								<div class="remodal" data-remodal-id="remodal<?php echo $array['UserID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
									<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
									<div class="remodal-content">
										<h2 id="modal1Title">Supprimer</h2>
										<p id="modal1Desc">
											Vous êtes sur de supprimer cet admin ?
										</p>
									</div>
									<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
									<a href="?user_id=<?php echo $array['UserID']; ?>" class="btn btn-primary">Supprimer</a>
								</div>

							<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->
		</div>

	</div>

</div>
<?php include 'footer.php'; ?>