<?php
include "connexion.php";
$msg = "";
if($_POST){


   
//2- Récuperation des variables

$title1 =mysqli_real_escape_string($conn,$_POST['title1']);
$para1 =mysqli_real_escape_string($conn,$_POST['para1']);
$title2 =mysqli_real_escape_string($conn,$_POST['title2']);
$para2 =mysqli_real_escape_string($conn,$_POST['para2']);
$title3 =mysqli_real_escape_string($conn,$_POST['title3']);
$para3 =mysqli_real_escape_string($conn,$_POST['para3']);

$req = "INSERT INTO `index_lettre`(`title1`, `para1`, `title2`, `para2`, `title3`, `para3`) VALUES ('".$title1."','".$para1."','".$title2."','".$para2."','".$title3."','".$para3."')";

//echo $req;

//4- Execution de la requete
$exec = mysqli_query($conn,$req);
if($exec){
	$msg ="<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre Texte a été ajouté.
</div>";
}else{
	$msg ="<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Texte non ajouté!!! 
</div>";
}

}
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
					<h4 class="box-title">Add Index Lettre</h4>
                    <!-- /.box-title -->
                    <p><?php echo $msg ; ?></p>
					<div class="card-content">
						<form method="POST"   enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputEmail1">Lettre Title</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer your offre nom" name="title1">
                            </div>
							<div class="m-t-20">
                            <label for="exampleInputEmail1">Description</label>
									
									<textarea name="para1" id="textarea" class="form-control" maxlength="225" rows="2" placeholder="This textarea has a limit of 225 chars."></textarea>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Contact Title</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer location" name="title2">
                            </div>
							<div class="m-t-20">
                            <label for="exampleInputEmail1">Contact Information</label>
									
									<textarea name="para2" id="textarea" class="form-control" maxlength="225" rows="2" placeholder="This textarea has a limit of 225 chars."></textarea>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Type de contrat</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer location" name="title3">
                            </div>
                            <div class="m-t-20">
                            <label for="exampleInputEmail1">Description</label>
									
									<textarea name="para3" id="textarea" class="form-control" maxlength="225" rows="2" placeholder="This textarea has a limit of 225 chars."></textarea>
							</div>
							
                            
							<div class="checkbox margin-bottom-20">
								<input type="checkbox" id="chk-1"><label for="chk-1">Check me out</label> 
							</div>
							<button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Submit</button>
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
				<li>2016 © NinjaAdmin.</li>
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</footer>
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php include "footer.php"; ?>