<?php
include 'connexion.php';
$id_f = $_POST['option'];

$req = "SELECT * FROM events WHERE ID_f=".$id_f;
$exec = mysqli_query($conn,$req);
$msg='                                                <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des sessions
                                                </label><select required name="session_f" class="form-control">';
while($array=mysqli_fetch_array($exec)){
    $msg.='<option value="'.$array['id'].'">'.$array['title'].'</option>';
}
$msg .='</select></div>';

echo $msg;