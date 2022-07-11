<?php 
include "connexion.php";
include 'header.php' ; 

if(isset($_GET['con_id'])){
	$idc = $_GET['con_id'];
	$req = "DELETE FROM `contact` WHERE ID=$idc ";
	$exec = mysqli_query($conn,$req);
}
?>

<!-- /.fixed-navbar -->

<?php 
include 'sidebar.php' ; 
?>
<!-- #color-switcher -->

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
		    <form action="" method="POST">
			<div class="col-xs-12">
			    <?php 
			    if(isset($_POST['supp'])){
			        $array_supp = $_POST['selection'];
			        if(!empty($array_supp)){
			        foreach ($array_supp as $sp){
			            $req_selc_supp = "DELETE FROM `contact` WHERE ID= ".$sp;
	                    $exec_selc_supp = mysqli_query($conn,$req_selc_supp);
			        }
			        }
			    }
			    ?>
				<div class="box-content">
					<table id="example-edit" class="display" style="width: 100%">
						<thead>
							<tr>
							    <th>Select</th>
							    <th>Action</th>
								<th>informations</th>
								<th>Service</th>
								<th>Message</th>
								<th>Date</th>
                                
							</tr>
						</thead>
						<tfoot>
							<tr>
							    <th><button type="submit" class="btn btn-danger" name="supp">Supprimer</button></th>
							    <th>Action</th>
                                <th>informations</th>
								<th>Service</th>
								<th>Message</th>
								<th>Date</th>
							</tr>
						</tfoot>
						<tbody>
<?php
$query = "SELECT * FROM `contact` ORDER BY ID DESC";

$exec = mysqli_query($conn,$query);

while($array = mysqli_fetch_array($exec)){
    if( (filter_var($array['Message'],FILTER_SANITIZE_STRING)) == ""){
        	
	$req_de = "DELETE FROM `contact` WHERE ID= ".$array['ID'];
	$exec_de = mysqli_query($conn,$req_de);
    }

?>	
       
                            
							<tr>
							    <td><input type="checkbox" name="selection[]" value="<?php echo $array['ID']; ?>"></td>
							    <td>
                                    <button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light" ><i class="fa fa-trash" aria-hidden="true"></i></button>
				
						                                  </td>
     							<td>
     							    <p>- <?php echo filter_var($array['Nom'],FILTER_SANITIZE_STRING) ; ?> <?php echo filter_var($array['Prenom'],FILTER_SANITIZE_STRING) ; ?> </p>
     							    <p>- <?php echo filter_var($array['Email'],FILTER_SANITIZE_EMAIL) ; ?></p>
     							    <p>- <?php echo filter_var($array['Tel'],FILTER_SANITIZE_STRING) ; ?></p>
     							    </td>
							
                                
                                <td><?php echo filter_var($array['Service'],FILTER_SANITIZE_STRING) ; ?></td>
                                <td><?php echo filter_var($array['Message'],FILTER_SANITIZE_STRING) ; ?></td>
                                <td><?php echo $array['date'] ; ?></td>
                                
								
								
							</tr>
                            
                             
							<div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div class="remodal-content">
		<h2 id="modal1Title">Supprimer</h2>
		<p id="modal1Desc">
		Vous êtes sur de supprimer ce contact ?
		</p>
	</div>
	<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
	<a href="?con_id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
</div>
						
                        <?php } ?>
                            </tbody>
					</table>
				</div>
				<!-- /.box-content -->
			</div>
			</form>
			<!-- /.col-xs-12 -->
		</div>
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
	<?php include 'footer.php'; ?>