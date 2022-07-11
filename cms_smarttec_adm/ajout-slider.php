<?php
$pagetitle = "Ajout Slider";
include "connexion.php";
$msg = "";
if ($_POST) {


	//2- Récuperation des variables
	$Name = mysqli_real_escape_string($conn, $_POST['Name']);
	$Text = mysqli_real_escape_string($conn, $_POST['text']);

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

		$expensions = array("jpeg", "jpg", "png", "gif");

	
		$logo = time() . '_' . $file_name;

		if (empty($errors) == true) {
			move_uploaded_file($file_tmp, "../uploads/sliders/" . $logo);
			//echo "Success";
		} else {
			print_r($errors);
		}
		$req = "INSERT INTO `slider`(`Name`, `Text`,`Image`) VALUES('" . $Name . "','" . $Text . "','" . $logo . "')";





		//echo $req;

		//4- Execution de la requete
		$exec = mysqli_query($conn, $req);

		if ($exec) {
			$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Slider a été ajouté.
</div>";
		} else {
			$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Slider non ajouté!!! 
</div>";
		}
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
						<h4 class="box-title">Ajouter Slider</h4>
						<!-- /.box-title -->
						<p><?php echo $msg; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">

								<div>
									<!-- /.dropdown js__dropdown -->
									<input required type="file" name="logo" id="input-file-now" class="dropify" />
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Titre de Slider</label>
									<input required type="text" class="form-control" id="exampleInputEmail1" name="Name">
								</div>



								<div class="m-t-20">
									<label for="exampleInputEmail1">Description Slider</label>

									<textarea required name="text" id="textarea" class="form-control"></textarea>
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

			</div>


		</div>
		<!-- /.main-content -->
	</div>



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