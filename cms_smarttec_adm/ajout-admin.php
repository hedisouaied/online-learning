<?php
include "connexion.php";
$msg = "";
if ($_POST) {

	// $logo = '';

	//2- Récuperation des variables
	$username = mysqli_real_escape_string($conn, $_POST['UserName']);
	$password = mysqli_real_escape_string($conn, $_POST['Password']);
	$email = mysqli_real_escape_string($conn, $_POST['Email']);
	$fullname = mysqli_real_escape_string($conn, $_POST['FullName']);
	$phone = mysqli_real_escape_string($conn, $_POST['Phone']);


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
			move_uploaded_file($file_tmp, "../uploads/avatars/" . $logo);
			//echo "Success";
		} else {
			print_r($errors);
		}
		$req = "INSERT INTO `users`(`UserName`, `Password`, `Email`, `FullName`, `Phone`, `Profile`, `Date`) VALUES('" . $username . "','" . $password . "','" . $email . "','" . $fullname . "','" . $phone . "','" . $logo . "',now())";
	} else {
		//3- Préparation de la requete
		$req = "INSERT INTO `users`(`UserName`, `Password`, `Email`, `FullName`, `Phone`, `Date`) VALUES('" . $username . "','" . $password . "','" . $email . "','" . $fullname . "','" . $phone . "',now())";
	}

	$exec = mysqli_query($conn, $req);

	if ($exec) {
		$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Admin a été ajouté.
</div>";
	} else {
		$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Admin non ajouté!!! 
</div>";
	}
}
$pagetitle = "Ajout Admin";

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
						<h4 class="box-title">Ajout Admin</h4>
						<!-- /.box-title -->
						<p><?php echo $msg; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">
								<div>
									<!-- /.dropdown js__dropdown -->
									<input type="file" name="logo" id="input-file-now" class="dropify" accept="image/png, image/jpeg, image/jpg" />
								</div>
								<br>
								<div class="form-group">
									<label for="exampleInputEmail1">Nom d'admin</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Votre admin username" name="UserName" required>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Mot de passe</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin password" name="Password" required>
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">E-mail</label>
									<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="Email" required>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Nom et Prénom</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="FullName" required>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Tel</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="Phone" required>
								</div>
								<br>

								<div class="checkbox margin-bottom-20">
									<input type="checkbox" id="chk-1" required><label for="chk-1">Check me out</label>
								</div>
								<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
								<a href="admin-list.php" class="btn btn-info btn-sm waves-effect waves-light">Retour</a>
							</form>
						</div>
						<!-- /.card-content -->
					</div>
					<!-- /.box-content -->
				</div>

			</div>


		</div>
	</div>

	<?php include 'footer.php'; ?>