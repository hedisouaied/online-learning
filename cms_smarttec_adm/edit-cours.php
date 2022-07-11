<?php
$pagetitle = 'Modifier Cours';
include "connexion.php";

if ((isset($_GET['suprim_id'])) && (is_numeric($_GET['suprim_id']))) {

	$id_c = $_GET['suprim_id'];



	$msg = "";
	if ($_POST) {




		$query1 = "SELECT * FROM cours where ID_c=$id_c ";


		$exec1 = mysqli_query($conn, $query1);

		$array = mysqli_fetch_array($exec1);

		$logo = $array['Image'];
		$img1 = $array['video'];

		$Name_c = mysqli_real_escape_string($conn, $_POST['Name_c']);
		$Desc_c = mysqli_real_escape_string($conn, $_POST['Desc_c']);
		$price = mysqli_real_escape_string($conn, $_POST['price']);
		$cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);


	// start emplode text values
	if (array($_POST['whaty'])) {

		$imp = mysqli_real_escape_string($conn,implode(",", $_POST['whaty']));
	}
	// end emplode text values

	// start emplode text values
	if (array($_POST['meta_keys'])) {

		$imp_keys = mysqli_real_escape_string($conn,implode(",", $_POST['meta_keys']));
	}
	// end emplode text values


		if (!empty($_FILES['logo']['name'])) {
			$errors = array();
			$file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name']);
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
				move_uploaded_file($file_tmp, "../uploads/cours/img/" . $logo);
				//echo "Success";
			} else {
				print_r($errors);
			}
		}


		if (!empty($_FILES['video']['name'])) {
			$errors = array();
			$file_name1 = mysqli_real_escape_string($conn, $_FILES['video']['name']);
			$file_size = $_FILES['video']['size'];
			$file_tmp = $_FILES['video']['tmp_name'];
			$file_type = $_FILES['video']['type'];
			$exp = explode('.', $_FILES['video']['name']);
			$end_expl = end($exp);
			$file_ext = strtolower($end_expl);

			$expensions = array("jpeg", "jpg", "png");





			$img1 = time() . '_' . $file_name1;

			if (empty($errors) == true) {
				move_uploaded_file($file_tmp, "../uploads/cours/video/" . $img1);
				//echo "Success";
			} else {
				print_r($errors);
			}
		}

		$req = "UPDATE `cours` SET `Name_c`='" . $Name_c . "',`Desc_c`='" . $Desc_c . "',`Image`='" . $logo . "',`video`='" . $img1 . "',`price`='" . $price . "',`whatyou`='" . $imp . "',`cat_id`='" . $cat_id . "',`meta_keys`='" . $imp_keys . "' WHERE ID_c=" . $id_c . " ";



		//echo $req;

		//4- Execution de la requete
		$exec = mysqli_query($conn, $req);

		if ($exec) {
			$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre réalisation a été ajouté.
</div>";
		} else {
			$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Réalisation non ajouté!!! 
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
							<h4 class="box-title">Modifier Cours</h4>
							<!-- /.box-title -->
							<p><?php echo $msg; ?></p>
							<div class="card-content">
								<form method="POST" enctype="multipart/form-data">
									<?php

									$query1 = "SELECT * FROM cours where ID_c=$id_c ";


									$exec1 = mysqli_query($conn, $query1);

									$check_cour = mysqli_num_rows($exec1);
									if ($check_cour == 0) {
										header('location:liste-cours.php');
									}

									$array = mysqli_fetch_array($exec1);
									$name = $array['Name_c'];
									$description = $array['Desc_c'];
									$price = $array['price'];
									$cat_id = $array['cat_id'];
									$logo = $array['Image'];
									$video = $array['video'];
									$keys = $array['meta_keys'];
									$key1 = explode(',',$keys);


									?>

									<div class="form-group">
										<label for="exampleInputEmail1">Titre De Cours</label>
										<input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Titre De cours" name="Name_c" value="<?php echo $name; ?>">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Description</label>
										<textarea required class="form-control editor_yes" name="Desc_c"><?php echo $description; ?></textarea>
									</div>

									<label for="exampleInputEmail1">Prix</label>
									<div class="input-group">
										<div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-usd"></i></label></div>
										<!-- /.input-group-btn -->
										<input required id="ig-3" type="number" class="form-control" placeholder="Prix" name="price" value="<?php echo $price; ?>">
									</div>
									<br>
									<div class="form-group">
									<label for="exampleInputEmail1">Meta Keywords</label>
									<select class="select2_2 form-control" multiple="multiple" name="meta_keys[]">
									    <?php foreach($key1 as $k){ ?>
									    <option value="<?php echo $k; ?>" selected><?php echo $k; ?></option>
									    <?php } ?>
									</select>
								</div>
									<div style="display: flex;">
										<div style="flex: 1;">
											<!-- /.dropdown js__dropdown -->
											<label for="exampleInputEmail1">Image Thumbnail</label>
											<input type="file" name="logo" id="input-file-now" class="dropify" accept="image/png,image/jpeg,image/jpg" />
											<img src="../uploads/cours/img/<?php echo $logo; ?>" alt="<?php echo $keys; ?>" style="width:200px;" />
										</div>
										<div style="flex: 1;">
											<!-- /.dropdown js__dropdown -->
											<label for="exampleInputEmail1">Video Preview</label>
											<input type="file" name="video" id="input-file-now" class="dropify" accept="video/mp4,video/x-m4v,video/*" />
											<video style="width:200px;" controls>
												<source src="../uploads/cours/video/<?php echo $video; ?>" type="video/mp4">
											</video>
										</div>
									</div>
									<div id="whaty">
										<?php
										$str = $array['whatyou'];
										$arrw = explode(",", $str);
										$ttt = 0;
										foreach ($arrw as $arr) {

										?>

											<div class="form-group">
												<label for="exampleInputEmail1">What you will learn</label>
												<input required type="text" class="form-control" placeholder="entrez ce que l'élève apprendra" name="whaty[]" value="<?php echo $arr; ?>">
												<?php if ($ttt !== 0) { ?>
													<button title="Ajouter une autre réponse" type="button" class="plus_sw btn btn-danger btn-block"><i class="fa fa-minus"></i></button>
												<?php } ?>
											</div>
										<?php
											$ttt++;
										} ?>
									</div>
									<div>
										<button title="Ajouter une autre formaulaire" type="button" class="plus_ww btn btn-success btn-block"><i class="fa fa-plus"></i></button>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">
											Categorie
										</label>
										<select name="cat_id" class="form-control" required>
											<?php
											$query = "SELECT * FROM `category` WHERE Parent = 0";

											$exec = mysqli_query($conn, $query);

											while ($array = mysqli_fetch_array($exec)) {

												echo "<option style='color:white;background:#00aeff;' disabled value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";

												$query1 = "SELECT * FROM `category` WHERE Parent = " . $array['ID'];

												$exec1 = mysqli_query($conn, $query1);

												while ($array1 = mysqli_fetch_array($exec1)) {

													echo "<option ";
													if ($cat_id == $array1['ID']) {
														echo 'selected';
													}
													echo " value='" . $array1['ID'] . "'>" . $array1['Name'] . "</option>";
												}
											}

											?>
										</select>
									</div>
									<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
									<a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="liste-cours.php">Retour</a>
								</form>
							</div>
							<!-- /.card-content -->
						</div>
						<!-- /.box-content -->
					</div>
					<!-- /.col-lg-6 col-xs-12 -->

					<!-- /.col-lg-6 col-xs-12 -->
				</div>

			</div>
			<!-- /.main-content -->
		</div>
	<?php
	include 'footer.php';
} else {
	header('location:liste-cours.php');
}
	?>