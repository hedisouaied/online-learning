<?php

$pagetitle = "Modifier Admin";
include "connexion.php";

if ((isset($_GET['user_id'])) && (is_numeric($_GET['user_id']))) {
	$id_u = $_GET['user_id'];


	$msg = "";
	if ($_POST) {


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
			$req = "UPDATE `users` SET `UserName`='" . $username . "',`Password`='" . $password . "',`Email`='" . $email . "',`FullName`='" . $fullname . "',`Phone`='" . $phone . "',`Profile`='" . $logo . "' WHERE UserID=" . $id_u . " ";
		} else {
			//3- Préparation de la requete
			$req = "UPDATE `users` SET `UserName`='" . $username . "',`Password`='" . $password . "',`Email`='" . $email . "',`FullName`='" . $fullname . "',`Phone`='" . $phone . "' WHERE UserID=" . $id_u . " ";
		}

		$exec = mysqli_query($conn, $req);

		if ($exec) {
			$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Cet Admin a été modifié.
</div>";
		} else {
			$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Admin non modifié!!! 
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
							<h4 class="box-title">Modifier Admin</h4>
							<!-- /.box-title -->
							<p><?php echo $msg; ?></p>
							<div class="card-content">
								<form method="POST" enctype="multipart/form-data">
									<?php

									$query1 = "SELECT * FROM users where UserID=$id_u ";


									$exec1 = mysqli_query($conn, $query1);

									$check_admin = mysqli_num_rows($exec1);
									if ($check_admin == 0) {
										header("location:admin-list.php");
									}

									while ($array = mysqli_fetch_array($exec1)) {
										$username = $array['UserName'];
										$password = $array['Password'];
										$fullname = $array['FullName'];
										$phone = $array['Phone'];
										$email = $array['Email'];
										$img = $array['Profile'];
									}

									?>
									<div>
										<!-- /.dropdown js__dropdown -->
										<input type="file" name="logo" id="input-file-now" class="dropify" />
										<img src="../uploads/avatars/<?php echo $img; ?>" alt="<?php echo $fullname; ?>" style="width:150px;" />
									</div>
									<br>
									<div class="form-group">
										<label for="exampleInputEmail1">Nom d'admin</label>
										<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Votre admin username" name="UserName" value="<?php echo $username ?>" required>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Mot de passe</label>
										<input type="password" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin password" name="Password" value="<?php echo $password ?>" required>
									</div>

									<div class="form-group">
										<label for="exampleInputEmail1">E-mail</label>
										<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="Email" value="<?php echo $email ?>">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Nom et Prénom</label>
										<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="FullName" value="<?php echo $fullname ?>" required>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Tel</label>
										<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="Phone" value="<?php echo $phone ?>" required>
									</div>
									<br>


									<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
									<a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="admin-list.php">Retour</a>
								</form>
							</div>
							<!-- /.card-content -->
						</div>
						<!-- /.box-content -->
					</div>

				</div>


			</div>
		</div>

	<?php
	include 'footer.php';
} else {
	header('location:admin-list.php');
}
	?>