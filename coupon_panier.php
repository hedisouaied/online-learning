<?php 
include './connexion.php';

$ids = $_GET['ids'];

$array_ids = explode(',',$ids);


$i = 0;
foreach($array_ids as $ids){
    $req_cp = "SELECT * FROM coupon WHERE ID=".$ids;
    $exec_cp = mysqli_query($conn,$req_cp);
    $array_cp = mysqli_fetch_array($exec_cp);
    
    $date_now = time();
    $date_coupon = strtotime($array_cp['expiration_end']);
        
        
            if(($array_cp['used'] == 1) || ($date_now >= $date_coupon)){
                $i = 1;
                 $up_old_coupon = "SELECT * FROM `panier` WHERE `coupon_ID` = ".$array_cp['ID'];
                         $exec_up_old_coupon = mysqli_query($conn,$up_old_coupon);
                         $check_up_old_coupon = mysqli_num_rows($exec_up_old_coupon);
                         if($check_up_old_coupon != 0){
                         while($array_old_coupon = mysqli_fetch_array($exec_up_old_coupon)){
                             
                             $req_up_vide = "UPDATE `panier` SET `coupon_ID`= 0 WHERE `ID` = ".$array_old_coupon['ID'];
                             $exec_up_vide = mysqli_query($conn,$req_up_vide);
                         }
                         }
            }
 
}

if($i == 0){
    echo "exist";
}else{
  echo  "doesn't exist";
}