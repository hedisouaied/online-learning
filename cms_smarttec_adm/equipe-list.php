<?php
include "connexion.php";
include 'header.php';

if (isset($_GET['eq_id'])) {
	$idq = $_GET['eq_id'];
	$req = "DELETE FROM `team` WHERE ID=$idq ";
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
								<th>Nom et Prénom</th>
								<th>Spécialité</th>
								<th>BIO</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Image</th>
								<th>Nom et Prénom</th>
								<th>Spécialité</th>
								<th>BIO</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php
							$query = "SELECT * FROM `team`";

							$exec = mysqli_query($conn, $query);

							while ($array = mysqli_fetch_array($exec)) {

							?>


								<tr id="delete<?php echo $array['ID']; ?>">
									<?php if (!empty($array['image'])) {
									?>

										<td><img style="width:70px;height:70px;" src="../uploads/team/<?php echo $array['image']; ?>"></td>
									<?php } else {

									?>
										<td><img style="width:70px;height:70px;" src="../uploads/avatars/k.jpeg"></td>
									<?php } ?>


									<td><?php echo $array['name']; ?></td>
									<td><?php echo $array['title']; ?></td>
									<td><?php echo $array['phrase']; ?></td>

									<td>
										<a href="edit-membre.php?eq_id=<?php echo $array['ID']; ?>"><i style="color:#fff;background-color:#00aeff;" class="btn btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>


										<button type="button" onclick="deleteAjax(<?php echo $array['ID']; ?>)" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>
									</td>

								</tr>



						</tbody>
					<?php } ?>
					</table>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->
		</div>
		<!-- /.row small-spacing -->
	</div>
	<!-- /.main-content -->
</div>
<script type="text/javascript">
	function deleteAjax(ID) {

		if (confirm('are You sure?')) {

			$.ajax({

				type: 'post',
				url: 'delete_team.php',
				data: {
					delete_id: ID
				},
				success: function(data) {

					$('#delete' + ID).fadeOut();

				}

			});

		}


	}
</script>
<!--/#wrapper -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
<!-- 
	================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php include 'footer.php'; ?>