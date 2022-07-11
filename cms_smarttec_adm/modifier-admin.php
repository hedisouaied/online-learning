<?php
include "connexion.php";
$msg = "";
$id_U = $_GET["id_U"];
if($_POST){   
$exec = autoUpdate('users',$data,$conn,"id_U=".$id_U." ");

//echo $req;


if($exec){
	$msg ="<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre admin a été modifié.
</div>";
}else{
	$msg ="<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> admin non modifier!!! 
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
<?php




$exec = autoSelect('users','all',$conn,'id_U='.$id_U.'');

while($array = mysqli_fetch_array($exec)){
	$ss = $array['ss'];
	$email = $array['email'];
	$pp = $array['pp'];
}

?>
				<div class="box-content card white">
					<h4 class="box-title">Modifier Admin</h4>
                    <!-- /.box-title -->
                    <p><?php echo $msg ; ?></p>
					<div class="card-content">
						<form method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputEmail1">Nom</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer your offre nom" name="ss" value="<?php echo $ss ; ?>">
                            </div>
							
							<div class="form-group">
								<label for="exampleInputEmail1">E-mail</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer your offre nom" name="email" value="<?php echo $email ; ?>">
                            </div>
							<div class="form-group">
								<label for="exampleInputEmail1">Mot de passe</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer your offre nom" name="pp" value="<?php echo $pp ; ?>">
                            </div>
                            </br>
                            
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