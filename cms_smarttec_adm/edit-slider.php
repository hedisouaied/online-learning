<?php
$pagetitle = "Modifier Slider";
include "connexion.php";
$id_slid = $_GET['slidesup_id'];


$msg = "";
if ($_POST) {


	//2- Récuperation des variables
	$Name = mysqli_real_escape_string($conn, $_POST['Name']);
	$Text = mysqli_real_escape_string($conn, $_POST['text']);

	$file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name']);

	$query1 = "SELECT * FROM slider where ID =" . $_GET['slidesup_id'] . " ";


	$exec1 = mysqli_query($conn, $query1);

	$array12 = mysqli_fetch_array($exec1);

	$logo = $array12['Image'];

	if ($file_name) {
		$errors = array();
		$file_name = $_FILES['logo']['name'];
		$file_size = $_FILES['logo']['size'];
		$file_tmp = $_FILES['logo']['tmp_name'];
		$file_type = $_FILES['logo']['type'];
		$exp = explode('.', $_FILES['logo']['name']);
		$end_expl = end($exp);
		$file_ext = strtolower($end_expl);

		$expensions = array("jpeg", "jpg", "png","gif");

		
		unlink('../uploads/sliders/' . $logo);

		$logo = time() . '_' . $file_name;

		if (empty($errors) == true) {
			move_uploaded_file($file_tmp, "../uploads/sliders/" . $logo);
			//echo "Success";
		} else {
			print_r($errors);
		}



		$req = "UPDATE `slider` SET `Name`='" . $Name . "',`Text`='" . $Text . "',`Image`='" . $logo . "' WHERE ID=" . $id_slid . " ";
	} else {
		//3- Préparation de la requete
		$req = "UPDATE `slider` SET `Name`='" . $Name . "',`Text`='" . $Text . "' WHERE ID=" . $id_slid . " ";
	}




	//echo $req;

	//4- Execution de la requete
	$exec = mysqli_query($conn, $req);

	if ($exec) {
		$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Slider a été modifié.
</div>";
	} else {
		$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Slider non modifié!!! 
</div>";
	}
}
?>

<?php include "header.php"; ?>
<!-- /.main-menu -->
<?php include "sidebar.php"; ?>
<link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">
<div class="content">
	<div id="wrapper">
		<div class="main-content">
			<div class="row small-spacing">
				<div class="col-xs-9">
					<div class="box-content card white">
						<h4 class="box-title">Modifier Slider</h4>
						<!-- /.box-title -->
						<p><?php echo $msg; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">
								<?php

								$query1 = "SELECT * FROM slider where ID=$id_slid ";


								$exec1 = mysqli_query($conn, $query1);

								while ($array = mysqli_fetch_array($exec1)) {
									$name = $array['Name'];
									$text = $array['Text'];
									$img = $array['Image'];
								}

								?>

								<div>
									<!-- /.dropdown js__dropdown -->
									<input type="file" name="logo" id="input-file-now" class="dropify" />
									<img src="../uploads/sliders/<?php echo $img; ?>" alt="<?php echo $name; ?>" style="width:150px;" />
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Titre de Slider</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le secteur" name="Name" value="<?php echo $name ?>" required>
								</div>



								<div class="m-t-20">
									<label for="exampleInputEmail1">Description</label>

									<textarea name="text" class="form-control" required><?php echo $text ?></textarea>
								</div>
								<br>
								<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
								<a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="liste-sliders.php">Retour</a>
							</form>
						</div>
						<!-- /.card-content -->
					</div>
					<!-- /.box-content -->
				</div>
				<!-- /.col-lg-6 col-xs-12 -->


				<!-- /.col-lg-6 col-xs-12 -->


				<!-- /.col-xs-12 -->

				<!-- /.col-lg-6 col-xs-12 -->

				<!-- /.col-lg-6 col-xs-12 -->
			</div>

		</div>
		<!-- /.main-content -->
	</div>


	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/scripts/jquery.min.js"></script>
	<script src="assets/scripts/modernizr.min.js"></script>
	<script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="assets/plugin/nprogress/nprogress.js"></script>
	<script src="assets/plugin/sweet-alert/sweetalert.min.js"></script>
	<script src="assets/plugin/waves/waves.min.js"></script>
	<!-- Full Screen Plugin -->
	<script src="assets/plugin/fullscreen/jquery.fullscreen-min.js"></script>
	<!-- Dropify -->
	<script src="assets/plugin/dropify/js/dropify.min.js"></script>
	<script src="assets/scripts/fileUpload.demo.min.js"></script>

	<script src="assets/scripts/main.min.js"></script>
	<script src="assets/color-switcher/color-switcher.min.js"></script>
	<!-- Maxlength -->
	<script src="assets/plugin/maxlength/bootstrap-maxlength.min.js"></script>
	<!-- Demo Scripts -->
	<script src="assets/scripts/form.demo.min.js"></script>
	</body>

	</html>