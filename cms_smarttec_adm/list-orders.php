<?php
include "connexion.php";


?>
<?php include "header.php";

if( isset($_GET['aa']) ){
                            
                            $iddd = $_GET['id'];
                            
                            $req_up = "UPDATE `checkout` SET `Paid`= 1 WHERE ID= " . $iddd . " ";
                            $exec_up = mysqli_query($conn,$req_up);
                        header("location: list-orders.php");

                        }
                        
    if (isset($_GET['con_id'])) {
    $idc = $_GET['con_id'];
    $req = "DELETE FROM `checkout` WHERE ID=$idc ";
    $exec = mysqli_query($conn, $req);
}
?>
<!-- /.main-menu -->
<div id="wrapper">
    <div class="main-content">
        <!-- /.col-lg-6 col-xs-12 -->
        <div class="col-lg-12 col-xs-12">
            <div class="box-content">
                <h4 class="box-title">Commandes</h4>
                <!-- /.box-title -->
                <table class="table table-striped margin-bottom-10 table-purchases">
                    <thead>
                        <tr>
                            <th style="width:40%;">Formations</th>
                            <th>Type</th>
                            <th>Prix</th>
                            <th>Clients</th>
                            <th>Date</th>
                            <th>État</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $query = "SELECT * FROM `checkout` ORDER BY ID DESC";

                        $exec = mysqli_query($conn, $query);

                        while ($array = mysqli_fetch_array($exec)) {
                            

                            if ($array['type_p'] == "E-learning") {

                                $query_el = "SELECT * FROM `cours` WHERE ID_c = " . $array['ID_p'];
                                $exec_el = mysqli_query($conn, $query_el);
                                $array_el = mysqli_fetch_array($exec_el);
                            } elseif ($array['type_p'] == "Direct") {

                                $req_dr = "SELECT * FROM events WHERE id = " . $array['ID_p'] . " ";
                                $exec_dr = mysqli_query($conn, $req_dr);
                                $array_dr = mysqli_fetch_array($exec_dr);
                            } elseif ($array['type_p'] == "Téléchargements") {

                                $query_tl = "SELECT * FROM `doc_formation` WHERE ID = " . $array['ID_p'];
                                $exec_tl = mysqli_query($conn, $query_tl);
                                $array_tl = mysqli_fetch_array($exec_tl);
                            }
                            $req_clients = "SELECT * FROM clients WHERE ID = " . $array['ID_sess'];
                            $exec_clients = mysqli_query($conn, $req_clients);
                            $array_clients = mysqli_fetch_array($exec_clients);


                        ?>
                            <tr>

                                <td><?php if ($array['type_p'] == "E-learning") {
                                        echo $array_el['Name_c'];
                                    } elseif ($array['type_p'] == "Direct") {
                                        echo $array_dr['title'];
                                    } elseif ($array['type_p'] == "Téléchargements") {
                                        echo $array_tl['Name'];
                                    } ?></td>
                                    
                                    <td><?php 
                                        echo $array['type_p'];
                                     ?></td>

                                <td>$ <?php if ($array['type_p'] == "E-learning") {
                                            echo $array_el['price'];
                                        } elseif ($array['type_p'] == "Direct") {
                                            $req_lv_price = "SELECT * FROM formations_live WHERE ID_f =" . $array_dr['ID_f'];
                                            $exec_lv_price = mysqli_query($conn, $req_lv_price);
                                            $array_lv_price = mysqli_fetch_array($exec_lv_price);
                                            echo $array_lv_price['price'];
                                        } elseif ($array['type_p'] == "Téléchargements") {
                                            echo $array_tl['Price'];
                                        } ?></td>
                                <td><?php echo $array_clients['fullname'] ?></td>
                                <td><?php $dt = array();

                                    $dt = explode("-", $array['date']);
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
                                    ?><?php echo $jour . " " . $month . "" . "," . $year; ?></td>
                                <?php if ($array['Paid'] == 1) {
                                    echo '<td class="text-success">Payée</td>';
                                } else {
                                    echo '<td><a  class="text-warning confirm" href="list-orders.php?id='. $array['ID'].'&aa=1">En attente</a></td>';
                                    
                                } ?>
                                <td>
                               <button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                            </tr>
                            
                             <div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                    <div class="remodal-content">
                                        <h2 id="modal1Title">Supprimer</h2>
                                        <p id="modal1Desc">
                                            Vous êtes sur de supprimer cette commande ?
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
<script>

$(function(){
    
    
    
    "use strict";
    $("[placeholder]").focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });
    
    
    
    $("input").each(function(){
        
        if($(this).attr('required') === 'required'){
            
            $(this).after(("<span class='asterisk'>*</span>"));
            
        }
        
    });
    
    
    $(".show-pass").hover(function(){
        
        $(".password").attr('type','text');
        
    },function(){
        
       $(".password").attr('type','password'); 
        
    });
    
    
    
    $(".confirm").click(function(){
        
        return confirm("Vous-êtes Sûr de modifier l'état de cette commande comme payée ?");
        
    });
    
    
    $(".cat h3").click(function(){
        
        $(this).next(".full-view").fadeToggle(200);
        
    });
    
    
    $(".ordering span").click(function(){
        
        $(this).addClass('active').siblings('span').removeClass('active') ;
        
        if($(this).data('view')==='full'){
            $(".cat .full-view").fadeIn(500);
        }
        else{
           $(".cat .full-view").fadeOut(500); 
        }
        
    });
    
    
    $(".toggle-info").click(function(){
        
        $(this).toggleClass("selected").parent().next(".panel-body").fadeToggle(200);
        
        if($(this).hasClass("selected")){
            
            $(this).html("<i class='fa fa-minus fa-lg'></i>");
            
        }
        else{
            
           $(this).html("<i class='fa fa-plus fa-lg'></i>"); 
            
        }
        
    });
    
    
});
    
</script>