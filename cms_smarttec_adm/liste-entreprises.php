<?php
include "connexion.php";

if(isset($_GET['identreprise'])){
	$identre = $_GET['identreprise'];
	$req = "DELETE FROM `entreprises` WHERE id_entreprise=$identre ";
	$exec = mysqli_query($conn,$req);
}

?>
<?php include "header.php"; ?>
<!-- /.main-menu -->
<?php include "sidebar.php"; ?>


<div id="wrapper">
	<div class="main-content">
    <div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Default</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else there</a></li>
							<li class="split"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->
		</div>
		<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
            <tr>
			<th>#</th>
                <th>Logo</th>
                <th>Raison Social</th>
                <th>Ville</th>
                <th>Tél</th>
                <th>E-mail</th>
                <th>Action</th>
            </tr>
						</thead>
						<tfoot>
            <tr>
				<th>#</th>
                <th>Logo</th>
                <th>Raison Social</th>
                <th>Ville</th>
                <th>Tél</th>
                <th>E-mail</th>
                <th>Action</th>
            </tr>
						</tfoot>
						<tbody>
<?php
$query = "SELECT * FROM `entreprises`";

$exec = mysqli_query($conn,$query);

while($array = mysqli_fetch_array($exec)){

?>	

                            <tr>
                                <td><?php echo $array['id_entreprise']; ?></td>
								<td><img src="../uploads/<?php echo $array['logo']; ?>" alt="<?php echo $array['rsociale']; ?>" style="width:100px;"/></td>
								<td><?php echo $array['rsociale']; ?></td>
								<td><?php echo $array['ville']; ?></td>
								<td><?php echo $array['tel']; ?></td>
								<td><?php echo $array['email']; ?></td>
								<td>
						  

						  <button type="button" data-remodal-target="remodal<?php echo $array['id_entreprise']; ?>" class="btn btn-rounded waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
				
						  <a href="modifier-entreprise.php?identreprise=<?php echo $array['id_entreprise']; ?>"><i class="btn btn-danger btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>
						  </td>
                        </tr></td>
							</tr>
<div class="remodal" data-remodal-id="remodal<?php echo $array['id_entreprise']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div class="remodal-content">
		<h2 id="modal1Title">Supprimer</h2>
		<p id="modal1Desc">
		Vous êtes sur de supprimer cette entreprise ?
		</p>
	</div>
	<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
	<a href="?identreprise=<?php echo $array['id_entreprise']; ?>" class="btn btn-primary">Supprimer</a>
</div>
                        </tbody>
                        
                        <?php } ?>
					</table>
</div>



<?php include "footer.php"; ?>