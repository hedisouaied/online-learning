<?php
$pagetitle = 'Ajouter un coupon';
include "connexion.php";

$msge = "";
$msg = "";
$msgd = "";
if (isset($_POST['ajout-coupon-e-learning'])) {

    $type = "e-learning";
    $coupon_c = mysqli_real_escape_string($conn, $_POST['coupon_c']);
    $cours_c = mysqli_real_escape_string($conn, $_POST['cours']);
    $date_exp_c = mysqli_real_escape_string($conn, $_POST['date_exp']);
    $pourcentage = mysqli_real_escape_string($conn, $_POST['pourcentage']);



    $check_c = "SELECT * FROM `coupon` WHERE `code` ='" . $coupon_c . "'";
    $exec_c = mysqli_query($conn, $check_c);
    $check_coupon = mysqli_num_rows($exec_c);

    if ($check_coupon != 0) {
        $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Ce coupon a déja existé!!! </div>";
    } else {

        $req_ins = "INSERT INTO `coupon` (`code`, `cours_ID`, `expiration_end`, `type_c`, `pourcentage`) VALUES('" . $coupon_c . "','" . $cours_c . "','" . $date_exp_c . "','" . $type . "','" . $pourcentage . "')";
        $exec_ins = mysqli_query($conn, $req_ins);
        if ($exec_ins) {
 $msge = "<div class='alert alert-success alert-dismissible' role='alert'>
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
 <strong>Well done!</strong> Coupon à été ajoutée avec succès.</div>";
 } else {
$msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Oh snap!</strong> Coupon non ajoutée!!! 
                                </div>";
                                            }
    }
}

if (isset($_POST['ajout-coupon-direct'])) {

    $type = "direct";
    $coupon_d = mysqli_real_escape_string($conn, $_POST['coupon_d']);
    $cours_d = mysqli_real_escape_string($conn, $_POST['cours']);
    $date_exp_d = mysqli_real_escape_string($conn, $_POST['date_exp']);
    $pourcentage = mysqli_real_escape_string($conn, $_POST['pourcentage']);



    $check_c = "SELECT * FROM `coupon` WHERE `code` ='" . $coupon_c . "'";
    $exec_c = mysqli_query($conn, $check_c);
    $check_coupon = mysqli_num_rows($exec_c);

    if ($check_coupon != 0) {
        $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Ce coupon a déja existé!!! </div>";
    } else {

        $req_ins = "INSERT INTO `coupon` (`code`, `cours_ID`, `expiration_end`, `type_c`, `pourcentage`) VALUES('" . $coupon_d . "','" . $cours_d . "','" . $date_exp_d . "','" . $type . "','" . $pourcentage . "')";
        $exec_ins = mysqli_query($conn, $req_ins);
        if ($exec_ins) {
 $msge = "<div class='alert alert-success alert-dismissible' role='alert'>
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
 <strong>Well done!</strong> Coupon à été ajoutée avec succès.</div>";
 } else {
$msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Oh snap!</strong> Coupon non ajoutée!!! 
                                </div>";
                                            }
    }
}

if (isset($_POST['ajout-coupon-pack'])) {

    $type = "Téléchargements";
    $coupon_d = mysqli_real_escape_string($conn, $_POST['coupon_d']);
    $cours_d = mysqli_real_escape_string($conn, $_POST['cours']);
    $date_exp_d = mysqli_real_escape_string($conn, $_POST['date_exp']);
    $pourcentage = mysqli_real_escape_string($conn, $_POST['pourcentage']);



    $check_c = "SELECT * FROM `coupon` WHERE `code` ='" . $coupon_c . "'";
    $exec_c = mysqli_query($conn, $check_c);
    $check_coupon = mysqli_num_rows($exec_c);

    if ($check_coupon != 0) {
        $msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Oh snap!</strong> Ce coupon a déja existé!!! </div>";
    } else {

        $req_ins = "INSERT INTO `coupon` (`code`, `cours_ID`, `expiration_end`, `type_c`, `pourcentage`) VALUES('" . $coupon_d . "','" . $cours_d . "','" . $date_exp_d . "','" . $type . "','" . $pourcentage . "')";
        $exec_ins = mysqli_query($conn, $req_ins);
        if ($exec_ins) {
 $msge = "<div class='alert alert-success alert-dismissible' role='alert'>
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
 <strong>Well done!</strong> Coupon à été ajoutée avec succès.</div>";
 } else {
$msge = "<div class='alert alert-danger alert-dismissible' role='alert'> 
<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>Oh snap!</strong> Coupon non ajoutée!!! 
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
                                                <li><a href="#tab2" data-toggle="tab"> formation en Direct</a></li>
                                                <li><a href="#tab3" data-toggle="tab"> Pack documentaire</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <p><?php echo $msg;
                                            echo $msge;
                                            echo $msgd; ?></p>
                                        <h1 class="box-title">Ajouter un coupon E-learning</h1>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Coupon code
                                                </label>
                                            <input type="text" class="form-control"  placeholder="Entrer le Coupon code" name="coupon_c" required>
                                            </div>
                                            <label for="exampleInputEmail1">
                                                    Pourcentage de remise
                                                </label>
                                            <div class="input-group">
                                                
                                                <div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-percent"></i></label></div>
                                            <input type="number" max="100" min="0" id="ig-3" class="form-control"  placeholder="Entrer le Coupon code" name="pourcentage" required>
                                            </div>
                                            <br>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des Cours
                                                </label>
                                                <select required name="cours" class="form-control">
                                                    <option value="">Sectionner un cour</option>
                                                    <?php
                                                    $query2 = "SELECT * FROM `cours`";

                                                    $exec2 = mysqli_query($conn, $query2);

                                                    while ($array2 = mysqli_fetch_array($exec2)) {

                                                        echo "<option value='" . $array2['ID_c'] . "' >" . $array2['Name_c'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="date" name="date_exp" />
                                            </div>
                                            <button type="submit" name="ajout-coupon-e-learning" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                            
                                        </form>
                                       

                                    </div>

                                    <div class="tab-pane" id="tab2">
                                        <h1 class="box-title">Ajouter un coupon de formation en Direct</h1>
                                         <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Coupon code
                                                </label>
                                            <input type="text" class="form-control"  placeholder="Entrer le Coupon code" name="coupon_d" required>
                                            </div>
                                            <label for="exampleInputEmail1">
                                                    Pourcentage de remise
                                                </label>
                                            <div class="input-group">
                                                
                                                <div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-percent"></i></label></div>
                                            <input type="number" max="100" min="0" id="ig-3" class="form-control"  placeholder="Entrer le Coupon code" name="pourcentage" required>
                                            </div>
                                            <br>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des sessions
                                                </label>
                                                <select required name="cours" class="form-control">
                                                    <option value="">Sectionner une session</option>
                                                    <?php
                                                    $query2 = "SELECT * FROM `events`";

                                                    $exec2 = mysqli_query($conn, $query2);

                                                    while ($array2 = mysqli_fetch_array($exec2)) {

                                                        echo "<option value='" . $array2['id'] . "' >" . $array2['title'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="date" name="date_exp" />
                                            </div>
                                            <button type="submit" name="ajout-coupon-direct" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                            
                                        </form>
                                       
                                    </div>
                                    
                                     <div class="tab-pane" id="tab3">
                                        <h1 class="box-title">Ajouter un coupon de pack documentaire</h1>
                                         <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Coupon code
                                                </label>
                                            <input type="text" class="form-control"  placeholder="Entrer le Coupon code" name="coupon_d" required>
                                            </div>
                                            <label for="exampleInputEmail1">
                                                    Pourcentage de remise
                                                </label>
                                            <div class="input-group">
                                                
                                                <div class="input-group-btn"><label for="ig-3" class="btn btn-default"><i class="fa fa-percent"></i></label></div>
                                            <input type="number" max="100" min="0" id="ig-3" class="form-control"  placeholder="Entrer le Coupon code" name="pourcentage" required>
                                            </div>
                                            <br>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                    Liste Des packs
                                                </label>
                                                <select required name="cours" class="form-control">
                                                    <option value="">Sectionner un pack</option>
                                                    <?php
                                                    $query2 = "SELECT * FROM `doc_formation`";

                                                    $exec2 = mysqli_query($conn, $query2);

                                                    while ($array2 = mysqli_fetch_array($exec2)) {

                                                        echo "<option value='" . $array2['ID'] . "' >" . $array2['Name'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="date" name="date_exp" />
                                            </div>
                                            <button type="submit" name="ajout-coupon-pack" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                            
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

<script>
    $('#select_formation').change(function(){
         //get the selected value
    var selectedValue = this.value;

    //make the ajax call
    $.ajax({
        url: 'fetch_sessions_select.php',
        type: 'POST',
        data: {option : selectedValue},
        success: function(res) {
          //  alert(res);
            $('#div_session').html(res);
        }
    });
    });
</script>