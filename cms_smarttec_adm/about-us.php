<?php
include "connexion.php";
$msg = "";
if (isset($_POST['about1'])) {


	//2- Récuperation des variables
	$text = mysqli_real_escape_string($conn, $_POST['Text']);
	$addres = mysqli_real_escape_string($conn, $_POST['Addres']);
	$email = mysqli_real_escape_string($conn, $_POST['Email']);
	$phone = mysqli_real_escape_string($conn, $_POST['Phone']);



	$req = "UPDATE `about` SET `Text`='" . $text . "',`Addres`='" . $addres . "',`Email`='" . $email . "',`Phone`='" . $phone . "' WHERE ID=1 ";

	$exec = mysqli_query($conn, $req);

	if ($exec) {
		$msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre informations a été modifier.
</div>";
	} else {
		$msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> informations non modifier!!! 
</div>";
	}
}

$msg1 = "";
if (isset($_POST['about2'])) {

    // $logo = '';

    //2- Récuperation des variables

    $desc = mysqli_real_escape_string($conn, $_POST['desc1']);



    $logo1 = "";
    if (!empty($_FILES['logo1']['name'])) {
        $errors = array();
        $file_name = mysqli_real_escape_string($conn, $_FILES['logo1']['name']);
        $file_size = $_FILES['logo1']['size'];
        $file_tmp = $_FILES['logo1']['tmp_name'];
        $file_type = $_FILES['logo1']['type'];
        $exp = explode('.', $_FILES['logo1']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }


        $logo1 = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../uploads/about/" . $logo1);
            //echo "Success";
        } else {
            print_r($errors);
        }
        $req = "UPDATE `about` SET `photo1`='" . $logo1 . "',`desc1`='" . $desc . "' WHERE ID=1 ";
    }else{
        $req = "UPDATE `about` SET `desc1`='" . $desc . "' WHERE ID=1 ";
    }


	$exec = mysqli_query($conn, $req);

	if ($exec) {
		$msg1 = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre informations a été modifier.
</div>";
	} else {
		$msg1 = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> informations non modifier!!! 
</div>";
	}
}


?>


<?php include "header.php"; ?>

<div class="content">
	<div id="wrapper">
		<div class="main-content">
			<div class="row small-spacing">
				<div class="col-xs-9">
					<div class="box-content card white">
						<h4 class="box-title">Ajout about</h4>
						<!-- /.box-title -->
						<p><?php echo $msg; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">
								<?php

								$query1 = "SELECT * FROM about where ID=1 ";


								$exec1 = mysqli_query($conn, $query1);

								while ($array = mysqli_fetch_array($exec1)) {
									$text = $array['Text'];
									$phone = $array['Phone'];
									$email = $array['Email'];
									$addres = $array['Addres'];
								}

								?>
								<br>
								<div class="m-t-20">
									<label for="exampleInputEmail1">Description</label>

									<textarea name="Text" id="textarea" class="form-control editor_yes" maxlength="1000" rows="2" placeholder="This textarea has a limit of 225 chars."><?php echo $text; ?></textarea>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Phone</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="Phone" value="<?php echo $phone ?>">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">E-mail</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="Email" value="<?php echo $email ?>">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Adresse</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer votre admin E-mail" name="Addres" value="<?php echo $addres ?>">
								</div>
								<br>

								<div class="checkbox margin-bottom-20">
									<input type="checkbox" id="chk-1"><label for="chk-1">Check me out</label>
								</div>
								<button type="submit" name="about1" class="btn btn-primary btn-sm waves-effect waves-light">Submit</button>
							</form>
						</div>
						<!-- /.card-content -->
					</div>
					<!-- /.box-content -->
				</div>
			</div>

<div class="row small-spacing">
				<div class="col-xs-9">
					<div class="box-content card white">
						<h4 class="box-title">Ajout about 2</h4>
						<!-- /.box-title -->
						<p><?php echo $msg1; ?></p>
						<div class="card-content">
							<form method="POST" enctype="multipart/form-data">
								<?php

								$query1 = "SELECT * FROM about where ID=1 ";


								$exec1 = mysqli_query($conn, $query1);

							    $array = mysqli_fetch_array($exec1);
									$photo = $array['photo1'];
									$desc = $array['desc1'];
									
								

								?>
                                <div>
                                    <label for="exampleInputEmail1">Photo</label>
                                    <!-- /.dropdown js__dropdown -->
                                    <input type="file" name="logo1" id="input-file-now" class="dropify" />
                                    <img src="../uploads/about/<?php echo $photo; ?>" alt="<?php echo $photo; ?>" style="width:150px;" />
                                </div>
                                <br>
								<div class="m-t-20">
									<label for="exampleInputEmail1">Description</label>

									<textarea name="desc1" id="textarea" class="form-control editor_yes"><?php echo $desc; ?></textarea>
								</div>

								<button type="submit" name="about2" class="btn btn-primary btn-sm waves-effect waves-light">Submit</button>
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