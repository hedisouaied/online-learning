<?php
include "connexion.php";


?>
<?php include "header.php";

                        
    if (isset($_GET['con_id'])) {
    $idc = $_GET['con_id'];
    $req = "DELETE FROM `coupon` WHERE ID=$idc ";
    $exec = mysqli_query($conn, $req);
    
     $up_old_coupon = "SELECT * FROM `panier` WHERE `coupon_ID` = ".$idc;
     $exec_up_old_coupon = mysqli_query($conn,$up_old_coupon);
     $check_up_old_coupon = mysqli_num_rows($exec_up_old_coupon);
     if($check_up_old_coupon != 0){
     while($array_old_coupon = mysqli_fetch_array($exec_up_old_coupon)){
         
         $req_up_vide = "UPDATE `panier` SET `coupon_ID`= 0 WHERE `ID` = ".$array_old_coupon['ID'];
         $exec_up_vide = mysqli_query($conn,$req_up_vide);
     }
     }
}
?>
<!-- /.main-menu -->
<div id="wrapper">
    <div class="main-content">
        <!-- /.col-lg-6 col-xs-12 -->
        <div class="col-lg-12 col-xs-12">
            <div class="box-content">
                <h4 class="box-title">Coupons</h4>
                <!-- /.box-title -->
                <table class="table table-striped margin-bottom-10 table-purchases">
                    <thead>
                        <tr>
                            <th style="width:40%;">Coupon code</th>
                            <th>formation</th>
                            <th>Type</th>
                            <th>Pourcentage</th>
                            <th>Date d'éxpiration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $query = "SELECT * FROM `coupon` ORDER BY ID DESC";

                        $exec = mysqli_query($conn, $query);

                        while ($array = mysqli_fetch_array($exec)) {
                            

                            if ($array['type_c'] == "e-learning") {

                                $query_el = "SELECT * FROM `cours` WHERE ID_c = " . $array['cours_ID'];
                                $exec_el = mysqli_query($conn, $query_el);
                                $array_el = mysqli_fetch_array($exec_el);
                            } elseif ($array['type_c'] == "direct") {

                                $req_dr = "SELECT * FROM events WHERE id = " . $array['cours_ID'] . " ";
                                $exec_dr = mysqli_query($conn, $req_dr);
                                $array_dr = mysqli_fetch_array($exec_dr);
                            } elseif ($array['type_c'] == "Téléchargements") {

                                $query_tl = "SELECT * FROM `doc_formation` WHERE ID = " . $array['cours_ID'];
                                $exec_tl = mysqli_query($conn, $query_tl);
                                $array_tl = mysqli_fetch_array($exec_tl);
                            }
                            


                        ?>
                            <tr>
                                <td><?php echo $array['code']; ?></td>
                                <td><?php if ($array['type_c'] == "e-learning") {
                                        echo $array_el['Name_c'];
                                    } elseif ($array['type_c'] == "direct") {
                                        echo $array_dr['title'];
                                    } elseif ($array['type_c'] == "Téléchargements") {
                                        echo $array_tl['Name'];
                                    } ?></td>
                                    
                                    <td><?php 
                                        echo $array['type_c'];
                                     ?></td>

                                
                                <td><?php echo $array['pourcentage'] ?> %</td>
                                <?php
                                $date_com = strtotime($array['expiration_end']);
                                $date_today = strtotime("now");
                                if($date_today < $date_com){
                                
                                ?>
                                <td>
                                <?php $dt = array();

                                    $dt = explode("-", $array['expiration_end']);
                                    $jour = $dt[2];
                                    $year = $dt[0];

                                    if ($dt[1] == "1") {

                                        $month = "janvier";
                                    } elseif ($dt[1] == "2") {

                                        $month = "février";
                                    } elseif ($dt[1] == "3") {

                                        $month = "mars";
                                    } elseif ($dt[1] == "4") {

                                        $month = "avril";
                                    } elseif ($dt[1] == "5") {

                                        $month = "mai";
                                    } elseif ($dt[1] == "6") {

                                        $month = "juin";
                                    } elseif ($dt[1] == "7") {

                                        $month = "julllet";
                                    } elseif ($dt[1] == "8") {

                                        $month = "août";
                                    } elseif ($dt[1] == "9") {

                                        $month = "septembre";
                                    } elseif ($dt[1] == "10") {

                                        $month = "octobre";
                                    } elseif ($dt[1] == "11") {

                                        $month = "novembre";
                                    } elseif ($dt[1] == "12") {

                                        $month = "décembre";
                                    } else {
                                        $month = "-";
                                    }
                                    ?>
                                    <?php echo $jour . " " . $month . "" . "," . $year; ?>
                                    </td>
                                <?php }else{ ?>
                                <td><span style="color: red">Expiré</span></td>
                                <?php } ?>
                            <td>
                               <button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                            </tr>
                            
                             <div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                    <div class="remodal-content">
                                        <h2 id="modal1Title">Supprimer</h2>
                                        <p id="modal1Desc">
                                            Vous êtes sur de supprimer cet Coupon ?
                                        </p>
                                    </div>
                                    <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                                    <a href="?con_id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
                                </div>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table -->
            </div>
            <!-- /.box-content -->
        </div>
    </div>
</div>
<?php include "footer.php"; ?>