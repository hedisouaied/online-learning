<?php
include "connexion.php";
include 'header.php';
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
								<th>Nom</th>
								<th>Commentaire</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nom</th>
								<th>Commentaire</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php
							$query = "SELECT * FROM `comment`";

							$exec = mysqli_query($conn, $query);

							while ($array = mysqli_fetch_array($exec)) {

							?>


								<tr id="delete<?php echo $array['comment_id']; ?>">
									<td><?php echo $array['comment_sender_name']; ?></td>
									<td><?php echo $array['comment']; ?></td>

									<td>
										<button type="button" onclick="deleteAjax(<?php echo $array['comment_id']; ?>)" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
	function deleteAjax(comment_id) {

		if (confirm('are You sure?')) {

			$.ajax({

				type: 'post',
				url: 'delete_comment.php',
				data: {
					delete_id: comment_id
				},
				success: function(data) {

					$('#delete' + comment_id).hide();

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