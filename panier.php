<?php
ob_start();
$pagetitle = "Panier";


include 'header.php';
if (!isset($_SESSION['client'])) {
    header('location:index.php');
}
if (isset($_POST['id_supp'])) {
    $idf = $_POST['id_supp'];
    $req = "DELETE FROM `panier` WHERE ID = $idf ";
    $exec = mysqli_query($conn, $req);
    header("location:panier.php");
}
$msg_coupon = "";
$array_ids_coupon = array();
if(isset($_POST['coupon'])){
    $coupon = mysqli_real_escape_string($conn,$_POST['coupon']);
    
    $req_coupon = "SELECT * FROM coupon where code = '".$coupon."' AND (type_c = 'E-learning' OR type_c = 'Téléchargements') LIMIT 1";
    $exec_coupon = mysqli_query($conn,$req_coupon);
    $array_coupon = mysqli_fetch_array($exec_coupon);
    $count_coupon = mysqli_num_rows($exec_coupon);
    if($count_coupon != 0){
        $date_now = time();
        $date_coupon = strtotime($array_coupon['expiration_end']);
        if($date_now <= $date_coupon){
            if($array_coupon['used'] == 0){
                $req_check_coupon = "SELECT * FROM panier WHERE ID_sess = ".$_SESSION['id']." AND ID_p = ".$array_coupon['cours_ID']." AND type_p = '".$array_coupon['type_c']."' "; 
                
                
                $exec_check_coupon = mysqli_query($conn,$req_check_coupon);
                $check_check_coupon = mysqli_num_rows($exec_check_coupon);
                
                
                if($check_check_coupon != 0){
                    $array_check_coupon= mysqli_fetch_array($exec_check_coupon);
                    $req_up_coupon = "UPDATE `panier` SET `coupon_ID`=" . $array_coupon['ID'] . " WHERE `ID` = ".$array_check_coupon['ID'];
                    echo $req_up_coupon;
                    $exec_up_coupon = mysqli_query($conn,$req_up_coupon);
                    $msg_coupon = "<div class='alert alert-success'>Ce coupon a été bien appliqué!!</div>";
                    
                }else{
                     $msg_coupon = "<div class='alert alert-danger'>Ce coupon n'est applicable pour ces produits de votre panier!!</div>";
                }
                
            }else{
                $msg_coupon = "<div class='alert alert-danger'>Ce coupon déjà utilisé!!</div>";
            }
        }else{
            $msg_coupon = "<div class='alert alert-danger'>Ce coupon a été expiré!!</div>";
        }
    }else{
        $msg_coupon = "<div class='alert alert-danger'>Ce coupon n'existe pas!!</div>";
    }
}


?>

<div class="page-section container page__container" style="margin-top: 69px;">


    <div class="page-separator">
        <div class="page-separator__text">Mon Panier</div>
    </div>

    <div class="card table-responsive">
        <?php $req = "SELECT * FROM panier WHERE ID_sess = " . $_SESSION['id'] . " ";
                $exec = mysqli_query($conn, $req);
                $check_button = mysqli_num_rows($exec);
                if($check_button !== 0){ ?>



        <table class="table table-flush table-nowrap">
            <thead>
                <tr>
				    <th class="text-center">Action</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Type</th>
					<th class="text-center">Date</th>
                    <th class="text-center">Prix</th>
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php
                
                $prix_tot = 0;
                while ($array = mysqli_fetch_array($exec)) {

                    if ($array['type_p'] == "E-learning") {
                        $req_e = "SELECT * FROM cours WHERE ID_c = " . $array['ID_p'] . " ";
                        $exec_e = mysqli_query($conn, $req_e);
                        $array_e = mysqli_fetch_array($exec_e);
                    } elseif ($array['type_p'] == "Téléchargements") {

                        $req_d = "SELECT * FROM doc_formation WHERE ID = " . $array['ID_p'] . " ";
                        $exec_d = mysqli_query($conn, $req_d);
                        $array_d = mysqli_fetch_array($exec_d);
                    } else {
                        $req_l = "SELECT * FROM events WHERE id = " . $array['ID_p'] . " ";
                        $exec_l = mysqli_query($conn, $req_l);
                        $array_l = mysqli_fetch_array($exec_l);
                        $req_ll = "SELECT * FROM formations_live WHERE ID_f = " . $array_l['ID_f'] . " ";
                        $exec_ll = mysqli_query($conn, $req_ll);
                        $array_ll = mysqli_fetch_array($exec_ll);
                    }

                ?>

                    <tr>
                        <td class="text-center">
                            <div class="d-inline-flex align-items-center">
                                <form action="" method="POST">
                                    <input type="hidden" value="<?php echo $array['ID']; ?>" name="id_supp" />
                                    <input class="btn btn-sm btn-outline-secondary mr-16pt" type="submit" value="supprimer" />
                                </form>
                            </div>
                        </td>
                        <td class="text-center"><?php
                                                if ($array['type_p'] == "E-learning") {
                                                    echo '<img src="uploads/cours/img/' . $array_e['Image'] . '" class="avatar-img rounded" style="width: 80px;height: 50px;" alt="lesson">';
                                                } elseif ($array['type_p'] == "Téléchargements") {
                                                    echo '<img src="uploads/formations/' . $array_d['Image'] . '" class="avatar-img rounded" style="width: 80px;height: 50px;" alt="lesson">';
                                                } else {
                                                    echo '<img src="uploads/formations/img/' . $array_ll['Image'] . '" class="avatar-img rounded" style="width: 80px;height: 50px;" alt="lesson">';
                                                }

                                                ?></td>
                        <td class="text-center"><?php
                                                if ($array['type_p'] == "E-learning") {
                                                    echo $array_e['Name_c'];
                                                } elseif ($array['type_p'] == "Téléchargements") {
                                                    echo $array_d['Name'];
                                                } else {
                                                    echo $array_l['title'];
                                                }

                                                ?></td>
                        <td class="text-center"><?php echo $array['type_p']; ?></td>

                        <td class="text-center"><?php echo $array['date']; ?></td>
                        <td class="text-center"><?php
                                                if ($array['type_p'] == "E-learning") {
                                                    if($array['coupon_ID'] != '0'){
                                                        
                                                        $array_ids_coupon[]= $array['coupon_ID'];
                                                        
                                                        $req_show_price_coupon = "SELECT * FROM coupon WHERE ID = ".$array['coupon_ID'];
                                                        $exec_show_price_coupon = mysqli_query($conn,$req_show_price_coupon);
                                                        $array_show_price_coupon = mysqli_fetch_array($exec_show_price_coupon);
                                                        
                                                         echo ($array_e['price']- ( ($array_e['price']*$array_show_price_coupon['pourcentage']) /100) )."$ <del>". $array_e['price'] . " $</del>";
                                                    $prix_tot = $prix_tot + ($array_e['price']- ( ($array_e['price']*$array_show_price_coupon['pourcentage']) /100) );
                                                        
                                                    }else{
                                                        echo $array_e['price'] . " $";
                                                    $prix_tot = $prix_tot + $array_e['price'];
                                                    }
                                                    
                                                    
                                                    
                                                } elseif ($array['type_p'] == "Téléchargements") {
                                                  
                                                  if($array['coupon_ID'] != '0'){
                                                        $array_ids_coupon[]= $array['coupon_ID'];
                                                        
                                                        $req_show_price_coupon = "SELECT * FROM coupon WHERE ID = ".$array['coupon_ID'];
                                                        $exec_show_price_coupon = mysqli_query($conn,$req_show_price_coupon);
                                                        $array_show_price_coupon = mysqli_fetch_array($exec_show_price_coupon);
                                                        
                                                         echo ($array_d['Price']- ( ($array_d['Price']*$array_show_price_coupon['pourcentage']) /100) )."$ <del>". $array_d['Price'] . " $</del>";
                                                    $prix_tot = $prix_tot + ($array_d['Price']- ( ($array_d['Price']*$array_show_price_coupon['pourcentage']) /100) );
                                                        
                                                    }else{  
                                                    echo $array_d['Price'] . " $";
                                                    $prix_tot = $prix_tot + $array_d['Price'];
                                                    }
                                                    
                                                } else {
                                                    $array_ids_coupon[]= $array['coupon_ID'];
                                                    
                                                    if($array['coupon_ID'] != '0'){
                                                        
                                                        $req_show_price_coupon = "SELECT * FROM coupon WHERE ID = ".$array['coupon_ID'];
                                                        $exec_show_price_coupon = mysqli_query($conn,$req_show_price_coupon);
                                                        $array_show_price_coupon = mysqli_fetch_array($exec_show_price_coupon);
                                                        
                                                         echo ($array_ll['price']- ( ($array_ll['price']*$array_show_price_coupon['pourcentage']) /100) )."$ <del>". $array_ll['price'] . " $</del>";
                                                    $prix_tot = $prix_tot + ($array_ll['price']- ( ($array_ll['price']*$array_show_price_coupon['pourcentage']) /100) );
                                                        
                                                    }else{ 
                                                    
                                                    echo $array_ll['price'] . " $";
                                                    $prix_tot = $prix_tot + $array_ll['price'];
                                                    }
                                                }

                                                ?></td>
                    </tr>


                <?php } ?>
                <tr>
                    <td colspan="5"></td>
                    <td class="text-center page-separator__text" style="float: right;width:90%">
                        Total : <?php echo $prix_tot . " $"; ?>
                    </td>
                </tr>
            </tbody>
        </table>
<?php
}else{
                
              ?>
              <div class="col-md-12">
                                <div class="_1o7LM">

                                    <div style="margin: auto;">
                                        <div style="text-align: center;">
                                            <img alt="" role="presentation" src="public/images/404.png" style="width: 300px;">
                                        </div>
                                        <div style="text-align: center;">
                                            <h2 class="JlgbC">Il n'Y a pas de formations ni cours ajoutés au panier</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
              <?php
                
                } 
                ?>
    </div>

    <?php if ($check_button !== 0) { ?>
        <div class="row">
            <form class="col-md-6" method="POST">
                <div class="form-group" style="width: 50%;">
                    <?php echo $msg_coupon; ?>
                <input class="form-control" type="text" name="coupon" placeholder="Coupon de réduction" style="width: 65%;border: solid 2px;display:inline;">
                <button class="btn btn-primary" name="apply_coupon">Apply</button>
                </div>
            </form>
           <?php
		   
		   
 

function thmx_currency_convert($amount){
    $url = 'https://api.exchangerate-api.com/v4/latest/USD';
    $json = file_get_contents($url);
    $exp = json_decode($json);

    $convert = $exp->rates->TND;

    return $convert * $amount;
}

$amount = $prix_tot*1000;

$convert_taux = thmx_currency_convert(1);




 
 

						$NumSite = 'MAR774';
						$Password = 'oh$jwI63';
						$Amount_tn = $prix_tot*1000*$convert_taux;
						$Amount = $prix_tot*1000;
						$Devise = 'USD';
						$orderId = date('ymdHis');
						$signture = sha1($NumSite.$Password.$orderId.$Amount_tn.$Devise);
						
						$Amount_d = $prix_tot*100;
						
						$fullname = $_SESSION['name'];
						$fullname_exp = explode(" ", $fullname);
						$nom = $fullname_exp[0];
						$prenom = $fullname_exp[1];
						
						$email = $_SESSION['email'];
						$country = $_SESSION['country'];
						$phone = $_SESSION['phone'];
						
						
						?>
						
						
            <form class="col-md-6" method="POST" action="https://www.gpgcheckout.com/Paiement/Validation_paiement.php">
			<div style="display:none;">
			<input type="text" name="NumSite" value="<?php echo $NumSite;?>"><br /><br />
						<input type="text" name="Password" value="<?php echo md5($Password);?>"><br /><br />
						<input type="text" name="orderID" value="<?php echo $orderId ;?>"><br /><br /><input type="text" name="Amount" value="<?php echo $Amount_tn;?>"><br /><br />
						<input type="text" name="Currency" value="<?php echo $Devise;?>"><br /><br />
						<input type="text" name="Language" value="fr"><br /><br />
						<input type="text" name="EMAIL" value="<?php echo $email;?>"><br /><br />
						<input type="text" name="CustLastName" value="<?php echo $nom; ?>"><br /><br />
						<input type="text" name="CustFirstName" value="<?php echo $prenom; ?>"><br /><br />
						<input type="text" name="CustAddress" value="<?php echo $country; ?>"><br /><br />
						 
						<input type="text" name="CustTel" value="<?php echo $phone; ?>"><br /><br />
						<input type="text" name="PayementType" value="1"><br /><br />
						<input type="text" name="MerchandSession" value=""><br /><br />
						<input type="text" name="orderProducts" value="a<?php echo $_SESSION['id']; ?>"><br /><br />
						<input type="text" name="signature" value="<?php echo $signture;?>"><br /><br />
						<input type="text" name="AmountSecond" value="<?php echo $Amount_d;?>"><br /><br />
						<input type="text" name="vad" value="176200003"><br /><br />
						<input type="text" name="Terminal" value="004"><br /><br />
						<input type="text" name="TauxConversion" value="2.7"><br /><br />
						<!--<input type="text" name="BatchNumber" value=" "><br /><br />
						<input type="text" name="MerchantReference" value=" "><br /><br />
						<input type="text" name="Reccu_Num" value=""><br /><br />
						<input type="text" name="Reccu_ExpiryDate " value=""><br /><br />
						<input type="text" name="Reccu_Frecuency " value=" "><br /><br />-->
						</div>
						
                <input type="submit" class="btn  btn-accent btn--raised mb-16pt" style="float: right;margin-right: 1%;margin-top: 1%;" value="Commandez" name="checkout">
        </div>
    <?php } ?>
</div>

<?php

include 'footer.php';
ob_end_flush();

?>
<?php 

if(!empty($array_ids_coupon)){
    $coupon_ids_s = implode(',',$array_ids_coupon);

?>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.2.min.js"></script>

<script>
    function get_fb_success(){
    
    var feedback = $.ajax({
        type: "POST",
        url: "coupon_panier.php?ids=<?php echo $coupon_ids_s; ?>",
        async: false,
    }).success(function(){
        setTimeout(function(){get_fb_success();}, 2000);
    }).responseText;
    
    if(feedback == "doesn't exist"){
   window.location.href= './panier.php';
    }
}



$(function(){
    get_fb_success();
});
</script>
<?php } ?>