<?php
include "connexion.php";
$msg = "";
if ($_POST) {

	// $logo = '';

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
		$req = "INSERT INTO `feedback`(`Name`, `Text`, `Image`) VALUES ('" . $name . "','" . $text . "','" . $logo . "')";
	}
	//echo $req ;
	$exec = mysqli_query($conn, $req);

	if ($exec) {
		$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Feedback a été ajouté.
</div>";
	} else {
		$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Feedback non ajouté!!! 
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
						<h4 class="box-title">Ajout Feedback</h4>
						<!-- /.box-title -->
						<p><?php echo $msg; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">
								<div>
									<!-- /.dropdown js__dropdown -->
									<input type="file" name="logo" id="input-file-now" class="dropify" required />
								</div>
								<br>
								<div class="form-group">
									<label for="exampleInputEmail1">Nom</label>
									<input type="text" class="form-control" id="exampleInputEmail1" required placeholder="Entrer le Nom" name="Name">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Témoignage</label>
									<textarea required name="Text" class="form-control" placeholder="This textarea has a limit of 225 chars."></textarea>
								</div>

								<br>


								<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Submit</button>
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
	<?php include 'footer.php'; ?>