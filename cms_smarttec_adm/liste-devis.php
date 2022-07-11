<?php 
include "connexion.php";
include 'header.php' ; 

if(isset($_GET['dv_id'])){
	$idv = $_GET['dv_id'];
	$req = "DELETE FROM `commande` WHERE ID=$idv ";
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
			<div class="col-xs-12">
				<div class="box-content">
					<table id="example-edit" class="display" style="width: 100%">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Prenom</th>
								<th>Email</th>
								<th>Phone</th>
                                <th>Service</th>
								<th>Message</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nom</th>
								<th>Prenom</th>
								<th>Email</th>
								<th>Phone</th>
                                <th>Service</th>
								<th>Message</th>
                                <th>Action</th>
							</tr>
						</tfoot>
						<tbody>
<?php
$query = "SELECT * FROM `commande`";

$exec = mysqli_query($conn,$query);

while($array = mysqli_fetch_array($exec)){

?>	
       
                            
							<tr>
     							<td><?php echo $array['Nom'] ; ?></td>
								<td><?php echo $array['Prenom'] ; ?></td>
                                <td><?php echo $array['Email'] ; ?></td>
                                <td><?php echo $array['Phone'] ; ?></td>
                                <td><?php echo $array['Secteur'] ; ?></td>
                                <td><?php echo $array['Message'] ; ?></td>
								
								<td>
                                    <button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light" ><i class="fa fa-trash" aria-hidden="true"></i></button>
				
						                                  </td>
							</tr>
                            
                             
							<div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div class="remodal-content">
		<h2 id="modal1Title">Supprimer</h2>
		<p id="modal1Desc">
		Vous êtes sur de supprimer ce devis ?
		</p>
	</div>
	<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
	<a href="?dv_id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
</div>
						
                        <?php } ?>
                            </tbody>
					</table>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->
		</div>
		<!-- /.row small-spacing -->		
		<footer class="footer">
			<ul class="list-inline">
				<li>2016 © HawDev.</li>
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
	<?php include 'footer.php'; ?>