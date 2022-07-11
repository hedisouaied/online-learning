<?php
$pagetitle = "Modifier Categorie E-learning";
include "connexion.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {



	$msg = "";
	if ($_POST) {


		$idd = mysqli_real_escape_string($conn, $_POST['ID']);
		$name = mysqli_real_escape_string($conn, $_POST['Name']);
		$icon = mysqli_real_escape_string($conn, $_POST['icon']);
		$desc = mysqli_real_escape_string($conn, $_POST['Description']);
		$parent = mysqli_real_escape_string($conn, $_POST['Parent']);


		$req = "UPDATE `category` SET `Name`='" . $name . "',`icon`='" . $icon . "',`Description`='" . $desc . "',`Parent`='" . $parent . "' WHERE ID=" . $idd . " ";

		$exec = mysqli_query($conn, $req);
		if ($exec) {
			$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Categorie à été modifié avec succès.
</div>";
		} else {
			$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Categorie non modifié!!! 
</div>";
		}
	}



	$query = "SELECT * FROM `category` WHERE ID = " . $_GET['id'];

	$exec = mysqli_query($conn, $query);
	$check_cat = mysqli_num_rows($exec);
	if ($check_cat == 0) {
		header('location:list-category.php');
	}
	$arra = mysqli_fetch_array($exec);
?>

	<?php include "header.php"; ?>
	<!-- /.main-menu -->
	<?php include "sidebar.php"; ?>
	<div class="content">
		<div id="wrapper">
			<div class="main-content">
				<div class="row small-spacing">
					<div class="col-xs-9">
						<div class="box-content card white">
							<h4 class="box-title">Modifier Categorie</h4>
							<!-- /.box-title -->
							<p><?php echo $msg; ?></p>
							<div class="card-content">
								<form method="POST" enctype="multipart/form-data">
									<div class="form-group">
										<label for="exampleInputEmail1">Nom de categorie </label>
										<input type="text" required class="form-control" id="exampleInputEmail1" placeholder="Entrer le nom de categorie" value="<?php echo $arra['Name']; ?>" name="Name">
										<input type="hidden" name="ID" value="<?php echo $arra['ID']; ?>" />
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Material Icons </label>
										<input type="text" required class="form-control" id="exampleInputEmail1" placeholder="Entrer le code de l'icone" value="<?php echo $arra['icon']; ?>" name="icon">
										<div class='alert alert-success alert-dismissible'>
											<strong>Les codes de fontawesome icons sont disponisble</strong><a href="https://fontawesome.com/v5.15/icons/" target="_blank"> <strong> ici</strong></a>
										</div>
									</div>
									<div class="m-t-20">
										<label for="exampleInputEmail1">Description</label>

										<textarea name="Description" class="form-control" placeholder="Entrer la description"><?php echo $arra['Description']; ?></textarea>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">
											Parent!
										</label>
										<select name="Parent" class="form-control">
											<option value="0">None</option>
											<?php
											$query = "SELECT * FROM `category` WHERE Parent = 0";

											$exec = mysqli_query($conn, $query);

											while ($array = mysqli_fetch_array($exec)) {

												echo "<option ";

												if ($arra['Parent'] == $array['ID']) {
													echo "selected ";
												}

												echo " value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";
											}

											?>
										</select>
									</div>
									<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
									<a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="list-category.php">Retour</a>
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
	<?php

	include "footer.php";
} else {
	header('location:list-category.php');
} ?>