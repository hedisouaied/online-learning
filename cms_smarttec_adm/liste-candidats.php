<?php
include "connexion.php";

if(isset($_GET['id_candidat'])){
	$id_candidat = $_GET['id_candidat'];
	$req = "DELETE FROM `candidats` WHERE id_candidat=$id_candidat ";
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
                <th>Nom et Prénom</th>
                <th>Ville</th>
				<th>Numero de Téléphone</th>
				<th>E-mail</th>
            </tr>
						</thead>
						<tfoot>
            <tr>
				<th>#</th>
                <th>Nom et Prénom</th>
                <th>Ville</th>
				<th>Numero de Téléphone</th>
				<th>E-mail</th>
            </tr>
						</tfoot>
						<tbody>
<?php

//$exec = autoSelect('candidats','id_candidat^nom_c^prenom_c^ville_c^tel_c^email_c',$conn);
$exec = autoSelect('candidats','all',$conn);

//$exec = autoSelectAll('candidats',$conn);

while($array = mysqli_fetch_array($exec)){

?>

                            <tr>
                                <td><?php echo $array['id_candidat']; ?></td>
								  <td><?php echo $array['nom']; ?> <?php echo $array['prenom']; ?></td>
								  <td><?php echo $array['prenom']; ?></td>
								  <td><?php echo $array['email']; ?></td>
								<td>
						  

						  <button type="button" data-remodal-target="remodal<?php echo $array['id_candidat']; ?>" class="btn btn-rounded waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
				
						  <a href="modifier-candidats.php?idcandidat=<?php echo $array['id_candidat']; ?>"><i class="btn btn-danger btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>
						  </td>
                        </tr></td>
							</tr>
<div class="remodal" data-remodal-id="remodal<?php echo $array['id_candidat']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div class="remodal-content">
		<h2 id="modal1Title">Supprimer</h2>
		<p id="modal1Desc">
		Vous êtes sur de supprimer cette entreprise ?
		</p>
	</div>
	<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
	<a href="?id_candidat=<?php echo $array['id_candidat']; ?>" class="btn btn-primary">Supprimer</a>
</div>
                        </tbody>
                        
                        <?php } ?>
					</table>
</div>



<?php include "footer.php"; ?>