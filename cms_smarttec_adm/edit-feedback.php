<?php
include "connexion.php";
$idf = $_GET['fd_id'];


$msg = "";
if ($_POST) {


	//2- Récuperation des variables
	$name = mysqli_real_escape_string($conn, $_POST['Name']);
	$text = mysqli_real_escape_string($conn, $_POST['Text']);



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

		if ($file_size > 2097152) {
			$errors[] = 'File size must be excately 2 MB';
		}

		$logo = time() . '_' . $file_name;

		if (empty($errors) == true) {
			move_uploaded_file($file_tmp, "../uploads/team/" . $logo);
			//echo "Success";
		} else {
			print_r($errors);
		}
		$req = "UPDATE `feedback` SET `Name`='" . $name . "',`Text`='" . $text . "',`Image`='" . $logo . "' WHERE ID=" . $idf . " ";
	} else {
		//3- Préparation de la requete
		$req = "UPDATE `feedback` SET `Name`='" . $name . "',`Text`='" . $text . "' WHERE ID=" . $idf . " ";
	}

	$exec = mysqli_query($conn, $req);

	if ($exec) {
		$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre feedback a été modifié.
</div>";
	} else {
		$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> feedback non modifié!!! 
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
						<h4 class="box-title">Modifier Membre</h4>
						<!-- /.box-title -->
						<p><?php echo $msg; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">
								<?php

								$query1 = "SELECT * FROM feedback where ID=$idf ";


								$exec1 = mysqli_query($conn, $query1);

								while ($array = mysqli_fetch_array($exec1)) {
									$Name = $array['Name'];
									$Text = $array['Text'];
									$img = $array['Image'];
								}

								?>
								<div>
									<!-- /.dropdown js__dropdown -->
									<input type="file" name="logo" id="input-file-now" class="dropify" />
									<img src="../uploads/team/<?php echo $img; ?>" alt="<?php echo $Name; ?>" style="width:150px;" />
								</div>
								<br>
								<div class="form-group">
									<label for="exampleInputEmail1">Nom</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Votre nom" name="Name" value="<?php echo $Name ?>">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">feedback</label>
									<textarea name="Text" class="form-control" placeholder="This textarea has a limit of 225 chars."><?php echo $Text; ?></textarea>

								</div>

								<br>

								<div class="checkbox margin-bottom-20">
									<input type="checkbox" id="chk-1"><label for="chk-1">Check me out</label>
								</div>
								<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
								<a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="feedback-list.php">Retour</a>
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
			<!-- /.row -->
			<div class="row">

				<!-- /.col-lg-4 ol-xs-12 -->

				<!-- /.col-lg-4 col-xs-12 -->
				<div class="col-lg-4 ol-xs-12">

					<!-- /.box-content card white -->
				</div>
				<!-- /.col-lg-4 col-xs-12 -->
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