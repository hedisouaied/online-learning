<?php
include "connexion.php";
$id_q = $_GET['eq_id'];


$msg = "";
if ($_POST) {


	//2- Récuperation des variables
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$phrase = mysqli_real_escape_string($conn,$_POST['phrase']);



	$file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name']);

	if ($file_name) {
		$errors = array();
		$file_name = $_FILES['logo']['name'];
		$file_size = $_FILES['logo']['size'];
		$file_tmp = $_FILES['logo']['tmp_name'];
		$file_type = $_FILES['logo']['type'];
		$exp = explode('.', $_FILES['logo']['name']);
		$end_expl = end($exp);
		$file_ext = strtolower($end_expl);

		$expensions = array("jpeg", "jpg", "png");

		if (in_array($file_ext, $expensions) === false) {
			$errors[] = "extension not allowed, please choose a JPEG or PNG file.";
		}


		$logo = time() . '_' . $file_name;

		if (empty($errors) == true) {
			move_uploaded_file($file_tmp, "../uploads/team/" . $logo);
			//echo "Success";
		} else {
			print_r($errors);
		}
		$req = "UPDATE `team` SET `name`='" . $name . "',`title`='" . $title . "',`phrase`='" . $phrase . "',`image`='" . $logo . "' WHERE ID=" . $id_q . " ";
	} else {
		//3- Préparation de la requete
		$req = "UPDATE `team` SET `name`='" . $name . "',`title`='" . $title . "',`phrase`='" . $phrase . "' WHERE ID=" . $id_q . " ";
	}

	$exec = mysqli_query($conn, $req);

	if ($exec) {
		$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Formateur a été modifié.
</div>";
	} else {
		$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Formateur non modifié!!! 
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
						<h4 class="box-title">Formateur Membre</h4>
						<!-- /.box-title -->
						<p><?php echo $msg; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">
								<?php

								$query1 = "SELECT * FROM team where ID=$id_q ";


								$exec1 = mysqli_query($conn, $query1);

								while ($array = mysqli_fetch_array($exec1)) {
									$name = $array['name'];
									$title = $array['title'];
									$phrase = $array['phrase'];
									$img = $array['image'];
								}

								?>
								<div>
									<!-- /.dropdown js__dropdown -->
									<input type="file" name="logo" id="input-file-now" class="dropify" />
									<img src="../uploads/team/<?php echo $img; ?>" alt="<?php echo $name; ?>" style="width:150px;" />
								</div>
								<br>
								<div class="form-group">
									<label for="exampleInputEmail1">Nom</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Votre admin username" name="name" value="<?php echo $name ?>">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Spécialité</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin password" name="title" value="<?php echo $title ?>">
								</div>
								<br>
                            <div class="form-group">
								<label>BIO</label>
								<textarea  class="form-control" name="phrase"><?php echo $phrase ?></textarea>
                            </div>
								<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
								<a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="equipe-list.php">Retour</a>
							</form>
						</div>
						<!-- /.card-content -->
					</div>
					<!-- /.box-content -->
				</div>

			</div>
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