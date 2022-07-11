<?php
include "connexion.php";
include 'header.php';

if (isset($_GET['fd_id'])) {
	$idf = $_GET['fd_id'];
	$req = "DELETE FROM `feedback` WHERE ID=$idf ";
	$exec = mysqli_query($conn, $req);
}
?>

<!-- /.fixed-navbar -->

<?php
include 'sidebar.php';
?>
<!-- #color-switcher -->

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<table id="example-edit" class="display" style="width: 100%">
						<thead>
							<tr>
								<th>Image</th>
								<th>Nom</th>
								<th>feedback</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Image</th>
								<th>Nom</th>
								<th>feedback</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php
							$query = "SELECT * FROM `feedback`";

							$exec = mysqli_query($conn, $query);

							while ($array = mysqli_fetch_array($exec)) {

							?>


								<tr>
									<?php if (!empty($array['Image'])) {
									?>

										<td><img style="width:70px;height:70px;" src="../uploads/team/<?php echo $array['Image']; ?>"></td>
									<?php } else {

									?>
										<td><img style="width:70px;height:70px;" src="../uploads/avatars/k.jpeg"></td>
									<?php } ?>


									<td><?php echo $array['Name']; ?></td>
									<td><?php echo $array['Text']; ?></td>

									<td>
										<button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>

										<a href="edit-feedback.php?fd_id=<?php echo $array['ID']; ?>"><i style="color:#fff;background-color:#00aeff;" class="btn btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>
									</td>
								</tr>


								<div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
									<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
									<div class="remodal-content">
										<h2 id="modal1Title">Supprimer</h2>
										<p id="modal1Desc">
											Vous êtes sur de supprimer ce membre ?
										</p>
									</div>
									<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
									<a href="?fd_id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
								</div>

							<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->
		</div>
		<!-- /.row small-spacing -->
		<footer class="footer">
			<ul class="list-inline">
				<li>2016 © HawDev.</li>
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</footer>
	</div>
	<!-- /.main-content -->
</div>
<!--/#wrapper -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
<!-- 
	================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include 'footer.php'; ?>