
<table id="example-edit" class="display" style="width: 100%">
						<thead>
							<tr>
								<th>Image</th>
								<th>Nom</th>
								<th>Poste</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Image</th>
								<th>Nom</th>
								<th>Poste</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
<?php

//fetch_comment.php

$connect = new PDO('mysql:host=localhost;dbname=tnconnect', 'root', '');

$query = "
SELECT * FROM team 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
?>

                            
							<tr>
                                <?php if(!empty($row['image'])){ ?>
                                
								<td><img style="width:70px;height:70px;" src="../uploads/team/<?php echo $row['image'] ; ?>" ></td>
                                <?php }
                                else{
                                
                                ?>
                                <td><img style="width:70px;height:70px;" src="../uploads/avatars/k.jpeg" ></td>
                                <?php } ?>

                                
								<td><?php echo $row['name'] ; ?></td>
								<td><?php echo $row['title'] ; ?></td>
								
								<td>
						  <a href="edit-membre.php?eq_id=<?php echo $row['ID']; ?>"><i style="color:#fff;background-color:#00aeff;" class="btn btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>
                                    <button type="button" data-remodal-target="remodal<?php echo $row['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                                
							</tr>
                            
                             
							<div class="remodal" data-remodal-id="remodal<?php echo $row['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div class="remodal-content">
		<h2 id="modal1Title">Supprimer</h2>
		<p id="modal1Desc">
		Vous êtes sur de supprimer ce membre ?
		</p>
	</div>
	<button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
	<a href="?eq_id=<?php echo $row['ID']; ?>" class="btn btn-primary">Supprimer</a>
</div>
<?php
}



?>
                            
                            </tbody>
					</table>