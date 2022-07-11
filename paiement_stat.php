<?php
include "connexion.php";
$message = "";
foreach ($_POST as $key => $value) {
    //$message .= "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
    if (htmlspecialchars($key) == "PAYID") {
        $payid =  htmlspecialchars($value);
    }
    if (htmlspecialchars($key) == "TransStatus") {
        $TransStatus =  htmlspecialchars($value);
    }
    if (htmlspecialchars($key) == "Currency") {
        $currency =  htmlspecialchars($value);
    }
    if (htmlspecialchars($key) == "CustLastName") {
        $CustLastName =  htmlspecialchars($value);
    }
    if (htmlspecialchars($key) == "CustFirstName") {
        $CustFirstName =  htmlspecialchars($value);
    }
    if (htmlspecialchars($key) == "CustTel") {
        $CustTel =  htmlspecialchars($value);
    }
    if (htmlspecialchars($key) == "EMAIL") {
        $email =  htmlspecialchars($value);
    }

    if (htmlspecialchars($key) == "orderProducts") {
        $orderProducts =  htmlspecialchars($value);
    }
    if (htmlspecialchars($key) == "MerchandSession") {
        $MerchandSession =  htmlspecialchars($value);
    }
}

if ($orderProducts[0] == "b") {
    
    
    $orderProducts = ltrim($orderProducts, 'b');
    $exp_orderProducts = explode('-',$orderProducts);
    
    
    
    
    $req_direct = "SELECT * FROM checkout WHERE ID = " . $exp_orderProducts[0] . " ";
    $exec_direct = mysqli_query($conn, $req_direct);
    $num_rows = mysqli_num_rows($exec_direct);
    
    
    
if ($TransStatus == "00") {
    if ($num_rows == 1) {
        if(count($exp_orderProducts) > 1){
        $req_up_coupon = "UPDATE `coupon` SET `used`= 1 WHERE `ID` = ".$exp_orderProducts[1];
        $exec_up_coupon = mysqli_query($conn,$req_up_coupon);
    }
        $req_up = "UPDATE `checkout` SET Paid = 1 WHERE ID = '" . $exp_orderProducts[0] . "' ";
        $exec_up = mysqli_query($conn, $req_up);
    }
}




} else {
    //$to = 'boukhris-yassine@live.fr, ';
    
    $to = $email;

    $MerchandSession = $orderProducts;
    $MerchandSession = ltrim($MerchandSession, 'a');
    
    // Sujet
    $subject = "Votre commande :: $CustLastName $CustFirstName ";



    // message
    $message = "
        <!doctype html>
<html>
<head>
    <meta charset=\"utf-8\">
    <title>commande e-smarttec.com.com</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 10px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 5px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 10px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    </style>
</head>

<body>
    <div class=\"invoice-box\">
        <table cellpadding=\"0\" cellspacing=\"0\">
            <tr class=\"top\">
                <td colspan=\"6\">
                    <table>
                        <tr>
                            <td class=\"title\">
                                <img alt='e-smarttec logo' src=\"https://e-smarttec.com/uploads/logo/black.svg\" style=\"width:100%; width: 120px;\">
                            </td>
                            
                            <td style='vertical-align: inherit; text-align: right;'>
                                Commande N°: $payid<br>
                                Créer le : " . date("d-m-Y") . "<br>
                                Client : $CustLastName $CustFirstName
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class=\"information\">
                <td colspan=\"6\">
                    <table>
                    
                        <tr>
                            <td  style=\" font-weight: bold; padding-bottom: 0;font-size:13px;\"> http://e-smarttec.com/</td>
                            <td  style=\" border-bottom: 1px solid #ddd; font-weight: bold; padding-bottom: 0;\"> Détail de Client </td>
                            <td  style=\" border-bottom: 1px solid #ddd; font-weight: bold; padding-bottom: 0;\"> Adresse de client </td>
                        </tr>
                        <tr>
                            <td style=\" font-weight: bold;font-size:15px; \">
                                Avenue Louis Braille,  <br>Tunis 1002 <br> Tunisie <br>
                            </td>
                            <td >
                                 Nom: $CustLastName, <br> Prénom: $CustFirstName.<br> Téléphone: $CustTel  <br> E-mail: $email <br>
                            </td>
                            <td >
                                Adresse:  , <br> Ville:  .<br> Code postal:   <br> Pays:   <br>
                            </td>
                        </tr>
                        <tr class=\"information\">
                <td colspan=\"6\">
                    <table>";




    if ($TransStatus == "00") {
        $pay_etat = "Paiement avec succès";
    }
    if ($TransStatus == "05") {
        $pay_etat = "Paiement Refusé";
    }
    if ($TransStatus == "06") {
        $pay_etat = "Paiement annulé";
    }

    $message .= "
        
                        <tr>
                            <td  style = \" border-bottom: 1px solid #ddd; font-weight: bold; padding-bottom: 0;\" > Payement </td>
                            <td style = \" border-bottom: 1px solid #ddd;  padding-bottom: 0;\">   $pay_etat </td>
                        </tr>
                    ";


    $message .= "
                    </table>
                </td>
            </tr>
            <tr class=\"information\">
                <td colspan=\"6\">
                    <table>
                        <tr class=\"heading\">
                            <td colspan='3' >
                                N° de Commande
                            </td>
                            <td colspan='3'>
                                Date de Commande
                            </td>
                        </tr>
                        <tr class=\"details\">
                            <td colspan='3' >
                                $payid
                            </td>
                            <td colspan='3' >
                                " . date("d-m-Y") . "
                            </td>
                        </tr>
                        <tr class=\"heading\">
                            <td colspan='2'>
                                Image
                            </td>
                            <td colspan='2'>
                                Nom
                            </td>
                            <td colspan='2'>
                                Type
                            </td>
                            <td colspan='1'>
                                Date
                            </td>
                            <td colspan='1'>
                                Prix Unitaire 
                            </td>
                        </tr>
                        ";


    $req = "SELECT * FROM panier WHERE ID_sess = " . $MerchandSession . " ";
    $exec = mysqli_query($conn, $req);
    $check_button = mysqli_num_rows($exec);
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


        if ($array['type_p'] == "E-learning") {
            $img = '<img src="https://e-smarttec.com/uploads/cours/img/' . $array_e['Image'] . '" class="avatar-img rounded" style="width: 80px;height: 50px;" alt="lesson">';
        } elseif ($array['type_p'] == "Téléchargements") {
            $img = '<img src="https://e-smarttec.com/uploads/formations/img/' . $array_d['Image'] . '" class="avatar-img rounded" style="width: 80px;height: 50px;" alt="lesson">';
        } else {
            $img = '<img src="https://e-smarttec.com/uploads/formations/img/' . $array_ll['Image'] . '" class="avatar-img rounded" style="width: 80px;height: 50px;" alt="lesson">';
        }


        if ($array['type_p'] == "E-learning") {
            $nom = $array_e['Name_c'];
        } elseif ($array['type_p'] == "Téléchargements") {
            $nom = $array_d['Name'];
        } else {
            $nom = $array_l['title'];
        }


        if ($array['type_p'] == "E-learning") {
            $price = $array_e['price'] . " $";
            $prix_tot = $prix_tot + $array_e['price'];
        } elseif ($array['type_p'] == "Téléchargements") {
            $price = $array_d['Price'] . " $";
            $prix_tot = $prix_tot + $array_d['Price'];
        } else {
            $price = $array_ll['price'] . " $";
            $prix_tot = $prix_tot + $array_ll['price'];
        }

        $message .= "<tr>
                            <td colspan='2'>
                                " . $img . "
                            </td>
                            <td colspan='2'>
                                " . $nom . "
                            </td>
                            <td colspan='2'>
                                " . $array['type_p'] . "
                            </td>
                            <td colspan='1'>
                                " . $array['date'] . "
                            </td>
                            <td colspan='1'>
                                " . $price . "
                            </td>
                        </tr>";
    }

    $message .= "
                       <tr class=\"total\">
                            <td colspan=\"5\"></td>
                            <td colspan=\"3\" style=' border-bottom: 2px solid #eee; font-weight: bold;'>
                               Total: " . number_format($prix_tot, 2, ',', ' ') . " $
                            </td>
                        </tr>
                        ";

    $message .= "
                        
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </div>
        </body>
        </html>";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: ' . $_SERVER['SERVER_NAME'] . ' <noreply@' . $_SERVER['SERVER_NAME'] . '>' . "\r\n";

    mail($to, $subject, $message, $headers);



    $req = "SELECT * FROM panier WHERE ID_sess = " . $MerchandSession . " ";
    $exec = mysqli_query($conn, $req);

    while ($array = mysqli_fetch_array($exec)) {

        if ($TransStatus == "00") {
            $req_ins = "INSERT INTO `checkout`(`ID_p`,`ID_sess`, `type_p`, `date`, `Paid`) VALUES('" . $array['ID_p'] . "','" . $array['ID_sess'] . "','" . $array['type_p'] . "', now(),'1')";
            $exec_ins = mysqli_query($conn, $req_ins);
            
            
            if($array['coupon_ID'] != 0){
                
            $req_show_price_coupon = "SELECT * FROM coupon WHERE ID = ".$array['coupon_ID'];
             $exec_show_price_coupon = mysqli_query($conn,$req_show_price_coupon);
             $check_cp = mysqli_num_rows($exec_show_price_coupon);
             
             if($check_cp != 0){
                 
                 $array_show_price_coupon = mysqli_fetch_array($exec_show_price_coupon);
                 
                 $req_up_coupon = "UPDATE `coupon` SET `used`= 1 WHERE `ID` = ".$array_show_price_coupon['ID'];
                 $exec_up_coupon = mysqli_query($conn,$req_up_coupon);
                 
                 $up_old_coupon = "SELECT * FROM panier WHERE coupon_ID =".$array['coupon_ID'];
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
            
            
            
            if ($array['type_p'] == "E-learning") {
                $req_id = "SELECT * FROM `checkout` ORDER BY `ID` DESC LIMIT 1";
                $exec_id = mysqli_query($conn, $req_id);
                $array_id = mysqli_fetch_array($exec_id);


                $req_inss = "INSERT INTO `steps`(`ID_checkout`) VALUES('" . $array_id['ID'] . "')";
                $exec_inss = mysqli_query($conn, $req_inss);
            }
            if ($exec_ins) {

                $req_del = "DELETE FROM `panier` WHERE ID_sess = " . $MerchandSession . " ";
                $exec_del = mysqli_query($conn, $req_del);
            }
        }
    }
}
