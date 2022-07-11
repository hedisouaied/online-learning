<?php
$pagetitle = "Ajout Cours";
include "connexion.php";

$msg = "";
if ($_POST) {

	// $logo = '';

	//2- Récuperation des variables
	$Name_c = mysqli_real_escape_string($conn, $_POST['Name_c']);
	$Desc_c = mysqli_real_escape_string($conn, $_POST['Desc_c']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	$level = mysqli_real_escape_string($conn, $_POST['level']);
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


	$logo = "";
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

	$img1 = "";

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


	$req = "INSERT INTO `cours`(`Name_c`,`Desc_c`, `Image`, `video`,`price`,`cat_id`, `meta_keys`, `level`, `whatyou`, `date`) VALUES ('" . $Name_c . "','" . $Desc_c . "','" . $logo . "','" . $img1 . "','" . $price . "','" . $cat_id . "','" . $imp_keys . "','" . $level . "','" . $imp . "',now())";


	$exec = mysqli_query($conn, $req);

	if ($exec) {
		$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Cours a été ajouté.
</div>";
	} else {
		$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Cours non ajouté!!! 
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
						<h4 class="box-title">Ajout cours</h4>
						<!-- /.box-title -->
						<p><?php echo $msg; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">

								<div class="form-group">
									<label for="exampleInputEmail1">Titre De Cours</label>
									<input required type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Le Titre De cours" name="Name_c">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Description</label>
									<textarea required class="form-control editor_yes" name="Desc_c"> </textarea>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Niveau: exemple (debutant,expert...)</label>
									<input required type="text" class="form-control" placeholder="Entrer le niveau de cours" name="level">
								</div>
								<label for="exampleInputEmail1">Prix</label>
								<div class="input-group">
									<div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-usd"></i></label></div>
									<!-- /.input-group-btn -->
									<input required id="ig-3" type="number" class="form-control" placeholder="Prix" name="price">
								</div>
								<br>
								<div class="form-group">
									<label for="exampleInputEmail1">Meta Keywords</label>
									<select required class="select2_2 form-control" multiple="multiple" name="meta_keys[]">
									</select>
								</div>
								<div style="display: flex;">
									<div style="flex: 1;">
										<!-- /.dropdown js__dropdown -->
										<label for="exampleInputEmail1">Image Thumbnail</label>
										<input accept="image/png,image/jpeg,image/jpg" type="file" name="logo" id="input-file-now" class="dropify" required />
									</div>
									<div style="flex: 1;">
										<!-- /.dropdown js__dropdown -->
										<label for="exampleInputEmail1">Video Preview</label>
										<input accept="video/mp4,video/x-m4v,video/*" type="file" name="video" id="input-file-now" class="dropify" required />
									</div>

								</div>

								<br>


								<div class="form-group">
									<label for="exampleInputEmail1">
										Category!
									</label>
									<select name="cat_id" class="form-control" required>
										<option value="">sélectionnez un service</option>
										<?php
										$query = "SELECT * FROM `category` WHERE Parent = 0";

										$exec = mysqli_query($conn, $query);

										while ($array = mysqli_fetch_array($exec)) {

											echo "<option style='color:white;background:#00aeff;' disabled value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";

											$query1 = "SELECT * FROM `category` WHERE Parent = " . $array['ID'];

											$exec1 = mysqli_query($conn, $query1);

											while ($array1 = mysqli_fetch_array($exec1)) {

												echo "<option value='" . $array1['ID'] . "'>" . $array1['Name'] . "</option>";
											}
										}

										?>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">What you will learn</label>
									<input required type="text" class="form-control" placeholder="entrez ce que l'élève apprendra" name="whaty[]">
								</div>
								<div class="row">
									<div class="col-md-12" style="margin-bottom: 20px;">

										<div id="whaty"></div>
									</div>
								</div>
								<div>
									<button title="Ajouter une autre formaulaire" type="button" class="plus_ww btn btn-success btn-block"><i class="fa fa-plus"></i></button>
								</div>
								<br>
								<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
							</form>
						</div>
						<!-- /.card-content -->
					</div>
					<!-- /.box-content -->
				</div>
				<!-- /.col-lg-6 col-xs-12 -->

			</div>

		</div>
		<!-- /.main-content -->
	</div>
	<!--/#wrapper -->

	<?php
	include 'footer.php';
	?>