<?php
$pagetitle = 'Ajouter une Commande';
include "connexion.php";

$msge = "";
if (isset($_POST['ajout-client-e-learning'])) {


    $client = mysqli_real_escape_string($conn, $_POST['client']);
    $cours = mysqli_real_escape_string($conn, $_POST['cours']);
    $type_p = "E-learning";
    $paid = 1;

    $check_u = "SELECT * FROM checkout WHERE ID_sess =" . $client . " AND ID_p = " . $cours . " AND type_p = 'E-learning' ";
    $exec_u = mysqli_query($conn, $check_u);
    $check_u = mysqli_num_rows($exec_u);
    if ($check_u !== 0) {
        $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Ce client à déja acheter ce cour!!! 
</div>";
    } else {

        $req = "INSERT INTO `checkout`(`ID_p`,`ID_sess`, `type_p`, `date`, `Paid`) VALUES('" . $cours . "','" . $client . "','" . $type_p . "', now(),'" . $paid . "')";
        $exec = mysqli_query($conn, $req);
        
        $req_id = "SELECT * FROM `checkout` ORDER BY `ID` DESC LIMIT 1";
            $exec_id = mysqli_query($conn, $req_id);
            $array_id = mysqli_fetch_array($exec_id);


            $req_inss = "INSERT INTO `steps`(`ID_checkout`) VALUES('" . $array_id['ID'] . "')";
            $exec_inss = mysqli_query($conn, $req_inss);

$req_c_p = "SELECT * FROM panier WHERE ID_sess =".$client." AND ID_p =".$cours." AND type_p = '".$type_p."' ";
$exec_c_p = mysqli_query($conn,$req_c_p);
$check_c_p = mysqli_num_rows($exec_c_p);
$array_c_p = mysqli_fetch_array($exec_c_p);
if($check_c_p !== 0){

        $req_del = "DELETE FROM `panier` WHERE ID= " . $array_c_p['ID'] . " ";
			$exec_del = mysqli_query($conn, $req_del);
}
        if ($exec) {
            
            $msge = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Client à été ajoutée avec succès.
</div>";
        } else {
            $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Client non ajoutée!!! 
</div>";
        }
    }
}

$msg = "";
if (isset($_POST['ajout-client-Telechargements'])) {


    $client = mysqli_real_escape_string($conn, $_POST['client']);
    $cours = mysqli_real_escape_string($conn, $_POST['cours']);
    $type_p = "Téléchargements";
    $paid = 1;

    $check_u = "SELECT * FROM checkout WHERE ID_sess =" . $client . " AND ID_p = " . $cours . " AND type_p = 'Téléchargements' ";
    $exec_u = mysqli_query($conn, $check_u);
    $check_u = mysqli_num_rows($exec_u);
    if ($check_u !== 0) {
        $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Ce client à déja acheter ce pack documentaires!!! 
</div>";
    } else {


        $req = "INSERT INTO `checkout`(`ID_p`,`ID_sess`, `type_p`, `date`, `Paid`) VALUES('" . $cours . "','" . $client . "','" . $type_p . "', now(),'" . $paid . "')";

        $exec = mysqli_query($conn, $req);

$req_c_p = "SELECT * FROM panier WHERE ID_sess =".$client." AND ID_p =".$cours." AND type_p = '".$type_p."' ";
$exec_c_p = mysqli_query($conn,$req_c_p);
$check_c_p = mysqli_num_rows($exec_c_p);
$array_c_p = mysqli_fetch_array($exec_c_p);
if($check_c_p !== 0){

        $req_del = "DELETE FROM `panier` WHERE ID= " . $array_c_p['ID'] . " ";
			$exec_del = mysqli_query($conn, $req_del);
}

        if ($exec) {
            $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Client à été ajoutée avec succès.
</div>";
        } else {
            $msg = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Client non ajoutée!!! 
</div>";
        }
    }
}

$msgd = "";
if (isset($_POST['ajout-client-Direct'])) {


    $client = mysqli_real_escape_string($conn, $_POST['client']);
    $cours = mysqli_real_escape_string($conn, $_POST['cours']);
    $type_p = "Direct";
    $paid = 1;

    $check_u = "SELECT * FROM checkout WHERE ID_sess =" . $client . " AND ID_p = " . $cours . " AND type_p = 'Direct' ";
    $exec_u = mysqli_query($conn, $check_u);
    $check_u = mysqli_num_rows($exec_u);
    if ($check_u !== 0) {
        $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Ce client à déja acheter cette formation!!! 
</div>";
    } else {

        $req = "INSERT INTO `checkout`(`ID_p`,`ID_sess`, `type_p`, `date`, `Paid`) VALUES('" . $cours . "','" . $client . "','" . $type_p . "', now(),'" . $paid . "')";

        $exec = mysqli_query($conn, $req);

        if ($exec) {
            $msgd = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Well done!</strong> Client à été ajoutée avec succès.
</div>";
        } else {
            $msgd = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Client non ajoutée!!! 
</div>";
        }
    }
}
?>
<!-- Select2 -->

<?php include "header.php"; ?>


<!-- /.main-menu -->
<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <div class="box-content">
                            <!-- /.dropdown js__dropdown -->
                            <div id="rootwizard">
                                <div class="tab-header">
                                    <div class="navbar">
                                        <div class="navbar-inner">
                                            <ul>
                                                <li><a href="#tab1" data-toggle="tab">E-learning</a></li>
                                                <li><a href="#tab2" data-toggle="tab">Pack Documentaires</a></li>
                                                <li><a href="#tab3" data-toggle="tab"> formation en Direct</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <p><?php echo $msg;
                                            echo $msge;
                                            echo $msgd; ?></p>
                                        <h1 class="box-title">Ajouter une commande E-learning</h1>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Clients
                                                </label>
                                                <select name="client" class="form-control select2_1" style="width: 100%;">
                                                    <option value="0">Sectionner un client</option>
                                                    <?php
                                                    $query1 = "SELECT * FROM `clients`";

                                                    $exec1 = mysqli_query($conn, $query1);

                                                    while ($array1 = mysqli_fetch_array($exec1)) {

                                                        echo "<option value='" . $array1['ID'] . "' >" . $array1['email'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Cours
                                                </label>
                                                <select name="cours" class="form-control select2_1" style="width: 100%;">
                                                    <option value="0">Sectionner un cour</option>
                                                    <?php
                                                    $query2 = "SELECT * FROM `cours`";

                                                    $exec2 = mysqli_query($conn, $query2);

                                                    while ($array2 = mysqli_fetch_array($exec2)) {

                                                        echo "<option value='" . $array2['ID_c'] . "' >" . $array2['Name_c'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="ajout-client-e-learning" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <h1 class="box-title">Ajouter une commande Pack Documentaires</h1>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Clients
                                                </label>
                                                <select name="client" class="form-control select2_1" style="width: 100%;">
                                                    <option value="0">Sectionner un client</option>
                                                    <?php
                                                    $query1 = "SELECT * FROM `clients`";

                                                    $exec1 = mysqli_query($conn, $query1);

                                                    while ($array1 = mysqli_fetch_array($exec1)) {

                                                        echo "<option value='" . $array1['ID'] . "' >" . $array1['email'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Cours
                                                </label>
                                                <select name="cours" class="form-control select2_1" style="width: 100%;">
                                                    <option value="0">Sectionner un pack</option>
                                                    <?php
                                                    $query2 = "SELECT * FROM `doc_formation`";

                                                    $exec2 = mysqli_query($conn, $query2);

                                                    while ($array2 = mysqli_fetch_array($exec2)) {

                                                        echo "<option value='" . $array2['ID'] . "' >" . $array2['Name'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="ajout-client-Telechargements" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <h1 class="box-title">Ajouter une commande de formation en Direct</h1>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Clients
                                                </label>
                                                <select name="client" class="form-control select2_1" style="width: 100%;">
                                                    <option value="0">Sectionner un client</option>
                                                    <?php
                                                    $query1 = "SELECT * FROM `clients`";

                                                    $exec1 = mysqli_query($conn, $query1);

                                                    while ($array1 = mysqli_fetch_array($exec1)) {

                                                        echo "<option value='" . $array1['ID'] . "' >" . $array1['email'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Formations
                                                </label>
                                                <select name="cours" class="form-control select2_1" style="width: 100%;">
                                                    <option value="0">Sectionner une formation</option>
                                                    <?php

                                                    $req_l = "SELECT * FROM events";
                                                    $exec_l = mysqli_query($conn, $req_l);
                                                    $array_l = mysqli_fetch_array($exec_l);

                                                    while ($array2 = mysqli_fetch_array($exec_l)) {

                                                        echo "<option value='" . $array2['id'] . "' >" . $array2['title'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="ajout-client-Direct" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-content -->
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>