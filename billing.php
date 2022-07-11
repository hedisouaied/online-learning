<?php
ob_start();
$pagetitle = "Billing";
include 'header.php';

if (!isset($_SESSION['client'])) {
    header('location:index.php');
}


function thmx_currency_convert($amount)
{
    $url = 'https://api.exchangerate-api.com/v4/latest/USD';
    $json = file_get_contents($url);

    $convert = $exp->rates->TND;

    return $convert * $amount;
}

$amount = $prix_tot * 1000;

$convert_taux = thmx_currency_convert(1);

if($convert_taux == 0 ){ $convert_taux = 2.7; }

$NumSite = 'MAR774';
$Password = 'oh$jwI63';

$Devise = 'USD';
$orderId = date('ymdHis');



$fullname = $_SESSION['name'];
$fullname_exp = explode(" ", $fullname);
$nom = $fullname_exp[0];
$prenom = $fullname_exp[1];

$email = $_SESSION['email'];
$country = $_SESSION['country'];
$phone = $_SESSION['phone'];


if (!isset($_GET['id']) && is_numeric($_GET['id'])) {
    header('location:index.php');
}
$req_ffff = "SELECT * FROM checkout WHERE ID = " . $_GET['id'] ;
$exec_ffff = mysqli_query($conn, $req_ffff);
$check_ffff = mysqli_num_rows($exec_ffff);
if($check_ffff != 0){

$array_ffff = mysqli_fetch_array($exec_ffff);

$req_fin = "SELECT * FROM events WHERE id = " . $array_ffff['ID_p'] . " ";
$exec_fin = mysqli_query($conn, $req_fin);
$array_fin = mysqli_fetch_array($exec_fin);

$req_for = "SELECT * FROM formations_live WHERE ID_f = " . $array_fin['ID_f'] . " ";
$exec_for = mysqli_query($conn, $req_for);
$array_for = mysqli_fetch_array($exec_for);




$coupon_zero = 0;
$msg_coupon = "";
$array_ids_coupon = array();
if(isset($_POST['coupon'])){
    $coupon = mysqli_real_escape_string($conn,$_POST['coupon']);
    
    $req_coupon = "SELECT * FROM coupon where code = '".$coupon."' AND type_c = 'Direct' LIMIT 1";
    $exec_coupon = mysqli_query($conn,$req_coupon);
    $array_coupon = mysqli_fetch_array($exec_coupon);
    $count_coupon = mysqli_num_rows($exec_coupon);
    if($count_coupon != 0){
        $date_now = time();
        $date_coupon = strtotime($array_coupon['expiration_end']);
        if($date_now <= $date_coupon){
            if($array_coupon['used'] == 0){
            
                
                
                if($array_coupon['cours_ID'] == $array_ffff['ID_p']){
                   
                    $msg_coupon = "<div class='alert alert-success'>Ce coupon a été bien appliqué!!</div>";
                    $coupon_zero = 1;
                    
                }else{
                     $msg_coupon = "<div class='alert alert-danger'>Ce coupon n'est applicable pour cette formation!!</div>";
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

if($coupon_zero == 0){
    $prix_tot = $array_for['price'];
}else{
    $prix_tot = $array_for['price']- ( ($array_for['price']*$array_coupon['pourcentage']) /100);
}
?>
                <div class="page-section bg-primary border-bottom-2" style="padding-top: 9rem;">
                    <div class="container page__container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-8 mb-24pt mb-lg-0">
                                        <p class="text-white-70 mb-0"><strong>Preparer pour</strong></p>
                                        <h2 class="text-white"><?php echo $_SESSION['name']; ?></h2>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-white-70 mb-0"><strong>Preparer par</strong></p>
                                        <h2 class="text-white">Smarttec.</h2>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- // END BEFORE Page Content -->

                <!-- Page Content -->

                <div class="page-section container page__container">
                    <div class="page-separator">
                        <div class="page-separator__text">Details de commande</div>
                    </div>

                    <div class="card table-responsive mb-24pt">
                        
                        <table class="table table-flush table--elevated">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th style="width: 60px;"
                                        class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="mb-0"><strong><?php echo $array_for['Name_f']; ?></strong></p>
                                        <p class="text-50">Session:<?php echo $array_fin['title']; ?> </p>
                                    </td>
                                    <td class="text-right"><strong><?php if($coupon_zero == 0){echo "$". $array_for['price'];}else{ echo ($array_for['price']- ( ($array_for['price']*$array_coupon['pourcentage']) /100) )."$<br> <del>". $array_for['price'] . " $</del>"; } ?></strong></td>
                                </tr>
                               
                            </tbody>
                        </table>

                        <table class="table table-flush">
                            <tfoot>
                               
                                <tr>
                                    <td class="text-70">
                                        <form class="col-md-6" method="POST">
                                            <div class="form-group" style="width: 50%;">
                                                <?php echo $msg_coupon; ?>
                                            <input class="form-control" type="text" name="coupon" placeholder="Coupon de réduction" style="width: 65%;border: solid 2px;display:inline;">
                                            <button class="btn btn-primary" name="apply_coupon">Apply</button>
                                            </div>
                                        </form>
                                    </td>
                                    <?php
                                    $Amount_tn = $prix_tot * 1000 * $convert_taux;
                                    $Amount = $prix_tot * 1000;
                                    $signture = sha1($NumSite . $Password . $orderId . $Amount_tn . $Devise);

                                    $Amount_d = $prix_tot * 100;
                                    ?>
                                    <td style="width: 60px;" class="text-right">
                                           <form method="POST" action="https://www.gpgcheckout.com/Paiement/Validation_paiement.php">
                                                <?php 
                                                if($coupon_zero == 0){
                                                ?>
                                                <input type="hidden" value="b<?php echo $array_ffff['ID']; ?>" name="orderProducts" />
                                                <?php }else{ ?>
                                                <input type="hidden" value="b<?php echo $array_ffff['ID']; ?>-<?php echo $array_coupon['ID']; ?>" name="orderProducts" />
                                                <?php } ?>
                                                <div style="display:none;">
                                                <input type="text" name="NumSite" value="<?php echo $NumSite; ?>"><br /><br />
                                                <input type="text" name="Password" value="<?php echo md5($Password); ?>"><br /><br />
                                                <input type="text" name="orderID" value="<?php echo $orderId; ?>"><br /><br />
                                                <input type="text" name="Amount" value="<?php echo $Amount_tn; ?>"><br /><br />
                                                <input type="text" name="Currency" value="<?php echo $Devise; ?>"><br /><br />
                                                <input type="text" name="Language" value="fr"><br /><br />
                                                <input type="text" name="EMAIL" value="<?php echo $email; ?>"><br /><br />
                                                <input type="text" name="CustLastName" value="<?php echo $nom; ?>"><br /><br />
                                                <input type="text" name="CustFirstName" value="<?php echo $prenom; ?>"><br /><br />
                                                <input type="text" name="CustAddress" value="<?php echo $country; ?>"><br /><br />
            
                                                <input type="text" name="CustTel" value="<?php echo $phone; ?>"><br /><br />
                                                <input type="text" name="PayementType" value="1"><br /><br />
                                                <input type="text" name="MerchandSession" value=""><br /><br />
                                                <!-- <input type="text" name="orderProducts" value=""><br /><br /> -->
                                                <input type="text" name="signature" value="<?php echo $signture; ?>"><br /><br />
                                                <input type="text" name="AmountSecond" value="<?php echo $Amount_d; ?>"><br /><br />
                                                <input type="text" name="vad" value="176200003"><br /><br />
                                                <input type="text" name="Terminal" value="004"><br /><br />
                                                <input type="text" name="TauxConversion" value="2.7"><br /><br />
                                                <!--<input type="text" name="BatchNumber" value=" "><br /><br />
                                            	<input type="text" name="MerchantReference" value=" "><br /><br />
                                            	<input type="text" name="Reccu_Num" value=""><br /><br />
                                            	<input type="text" name="Reccu_ExpiryDate " value=""><br /><br />
                                            	<input type="text" name="Reccu_Frecuency " value=" "><br /><br />-->
                                            </div>
            
                                                <input class="ml-4pt btn btn-block btn-link text-secondary border-1 border-secondary" style="float: right;" type="submit" value="Payer" name="payments">
            
                                         </form>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>

                <!-- // END Page Content -->
                
<?php 
}else{
    header('location:index.php');
}
include 'footer.php';
ob_end_flush();
?>


<?php 

if($coupon_zero != 0){
    $coupon_ids_s = $array_coupon['ID'];

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
   window.location.href= '<?php echo $_SERVER["REQUEST_URI"]; ?>';
    }
}



$(function(){
    get_fb_success();
});
</script>
<?php } ?>