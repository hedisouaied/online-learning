<?php
include "connexion.php";
$msg = "";
if($_POST){

$n=10; 
function getName($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}  
   
//2- Récuperation des variables
$img =mysqli_real_escape_string($conn,$_POST['img']);
$title1 =mysqli_real_escape_string($conn,$_POST['title1']);
$title2 =mysqli_real_escape_string($conn,$_POST['title2']);
$card_title1 =mysqli_real_escape_string($conn,$_POST['card_title1']);
$card_title2 =mysqli_real_escape_string($conn,$_POST['card_title2']);

	$file_name =mysqli_real_escape_string($conn,$_FILES['img']['name']);

if($file_name){
    $errors= array();
    $file_name = $_FILES['img']['name'];
    $file_size =$_FILES['img']['size'];
    $file_tmp =$_FILES['img']['tmp_name'];
    $file_type=$_FILES['img']['type'];
    $exp = explode('.',$_FILES['img']['name']);
    $end_expl = end($exp);
    $file_ext=strtolower($end_expl);
    
    $expensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$expensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }
    
    $img = getName($n).'_'.$file_name;
    
    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"../uploads/".$img);
       //echo "Success";
    }else{
       print_r($errors);
    }
    //3- Préparation de la requete
$req = "INSERT INTO `index_services`(`img`, `title1`, `title2`, `card_title1`, `card_title2`) VALUES ('".$img."','".$title1."','".$title2."','".$card_title1."','".$card_title2."')";
 } else{
     //3- Préparation de la requete
$req = "INSERT INTO `index_services`(`title1`, `title2`, `card_title1`, `card_title2`) VALUES ('".$title1."','".$title1."','".$card_title1."','".$card_title2."')";
 }


//echo $req;


//4- Execution de la requete
$exec = mysqli_query($conn,$req);
if($exec){
	$msg ="<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Votre entreprise a été ajouté.
</div>";
}else{
	$msg ="<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Entreprise non ajouté!!! 
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
					<h4 class="box-title">Ajout Entreprise</h4>
                    <!-- /.box-title -->
                    <p><?php echo $msg ; ?></p>
					<div class="card-content">
						<form method="POST"   enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleInputEmail1">title1</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your title1" name="title1">
                            </div>
                            <div class="form-group">
								<label for="exampleInputEmail1">title2</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your title2" name="title2">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">card_title1</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your card title2" name="card_title1">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">card_title2</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your card title2" name="card_title2">
							</div>
							<div class="form-group">
								<label for="exampleInputFile">File input</label>
								<input type="file" id="exampleInputFile" name="img">

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