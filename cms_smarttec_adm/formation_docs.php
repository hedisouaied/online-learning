<?php
include "connexion.php";
$pagetitle = "Pack docs";

include "header.php";

if (isset($_GET['do'])) {
    $do = $_GET['do'];
} else {
    $do = "manage";
};


if ($do == "manage") {

    //manage page  


    $req = "SELECT * FROM doc_formation ";
    $stmt = mysqli_query($conn, $req);


?>

    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-12">
                    <a class="btn btn-primary" href="formation_docs.php?do=add">Ajout Pack docs</a>

                    <div class="box-content">
                        <table id="example-edit" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Nom de Pack</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Categorie</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                while ($array = mysqli_fetch_array($stmt)) {

                                ?>


                                    <tr>
                                        <?php if (!empty($array['Image'])) {  ?>

                                            <td><img style="width:70px;height:70px;" src="../uploads/formations/<?php echo $array['Image']; ?>"></td>
                                        <?php } else {

                                        ?>
                                            <td><img style="width:70px;height:70px;" src="../uploads/avatars/4.jpg"></td>
                                        <?php } ?>


                                        <td><?php echo $array['Name']; ?></td>
                                        <td><?php echo $array['Description']; ?></td>
                                        <td><?php echo $array['Price']; ?></td>
                                        <td><?php
                                            $req_scc = 'SELECT * FROM categories_docs WHERE ID=' . $array['Cat_ID'] . " LIMIT 1";
                                            $scc = mysqli_query($conn, $req_scc);
                                            $parray = mysqli_fetch_array($scc);

                                            echo $parray['Name'];


                                            ?></td>
                                        <td><?php echo $array['Date']; ?></td>

                                        <td>
                                            <button type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-rounded btn-danger waves-effect waves-light"><i class="fa fa-trash" aria-hidden="true"></i></button>

                                            <a href="formation_docs.php?do=edit&id=<?php echo $array['ID']; ?>"><i style="color:#fff;background-color:#00aeff;" class="btn btn-rounded waves-effect waves-light fa fa-pencil" aria-hidden="true"></i></a>

                                            <a href="formation_docs.php?do=photos&itemid=<?php echo $array['ID']; ?>"><i style="color:#fff;background-color:#00ff00;" class="btn btn-rounded waves-effect waves-light fa fa-file" aria-hidden="true"></i></a>

                                        </td>
                                    </tr>


                                    <div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                        <div class="remodal-content">
                                            <h2 id="modal1Title">Supprimer</h2>
                                            <p id="modal1Desc">
                                                Vous êtes sur de supprimer ce Pack ?
                                            </p>
                                        </div>
                                        <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                                        <a href="formation_docs.php?do=delete&id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
                                    </div>
                                <?php } ?>

                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Nom de Pack</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Categorie</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                    <!-- /.box-content -->
                </div>
                <!-- /.col-xs-12 -->
            </div>

        </div>
    </div>


<?php
} elseif ($do == "add") { //add page 
?>

    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-9">
                    <div class="box-content card white">
                        <h4 class="box-title">Ajouter Pack doc</h4>
                        <!-- /.box-title -->
                        <div class="card-content">
                            <form method="POST" action="?do=insert" enctype="multipart/form-data">
                                <div>

                                    <!-- /.dropdown js__dropdown -->
                                    <label for="exampleInputEmail1">Image Preview</label>
                                    <input type="file" name="avatar" required id="input-file-now" class="dropify" accept="image/*" />
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom Pack</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom Pack" name="username" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea class="form-control editor_yes" id="" placeholder="Description" name="desc"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Prix</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Prix" name="prix" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Categorie
                                    </label>
                                    <select name="parent" class="form-control" required>
                                        <option value="">sélectionnez une Categorie</option>
                                        <?php
                                        $req = "SELECT * FROM `categories_docs` WHERE Parent = 0";
                                        $query = mysqli_query($conn, $req);



                                        while ($array = mysqli_fetch_array($query)) {

                                            echo "<option style='color:white;background:#00aeff;' disabled value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";

                                            $req1 = "SELECT * FROM `categories_docs` WHERE Parent = " . $array['ID'] . " ";

                                            $query1 = mysqli_query($conn, $req1);


                                            while ($array1 = mysqli_fetch_array($query1)) {

                                                echo "<option value='" . $array1['ID'] . "'>" . $array1['Name'] . "</option>";
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                            </form>
                        </div>
                        <!-- /.card-content -->
                    </div>
                </div>

            </div>


        </div>
    </div>

    <?php   } elseif ($do == "insert") { //insert page

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $avatar = $_FILES['avatar'];

        $avatarname = $avatar['name'];
        $avatarsize = $avatar['size'];
        $avatartmp = $avatar['tmp_name'];
        $avatartype = $avatar['type'];

        $avatarallowedextension = array("jpeg", "jpg", "png", "gif");

        $avatarextension = strtolower($avatarname);
        $avatarextension = explode(".", $avatarextension);
        $avatarextension = end($avatarextension);


        $user   = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $pass   = mysqli_escape_string($conn,$_POST['desc']);
        $email  = $_POST['prix'];
        $phone   = $_POST['parent'];

        //  $hashpass   = sha1($_POST['password']); 




        $formserrors = array();

        if (!empty($avatarname) && !in_array($avatarextension, $avatarallowedextension)) {
            $formserrors[] = "<div class='alert alert-danger'>Image most be with allowed <strong>extension</strong></div>";
        }

        if (empty($user)) {
            $formserrors[] = "<div class='alert alert-danger'>User name can't be <strong>empty</strong></div>";
        }

       
        if (empty($email)) {
            $formserrors[] = "<div class='alert alert-danger'>Email can't be <strong>empty</strong></div>";
        }
        foreach ($formserrors as $errors) {
            echo $errors;
        }

        if (empty($formserrors)) {

            $image = rand(0, 10000000) . "_" . time() . '.' . $avatarextension;

            move_uploaded_file($avatartmp, "../uploads/formations//" . $image);

            $req = "INSERT INTO doc_formation(Name,Description,Price,Cat_ID,Date,Image)
                                    VALUES('" . $user . "', '" . $pass . "', '" . $email . "','" . $phone . "',now(),'" . $image . "')";

            $stmt = mysqli_query($conn, $req);

            header('location:formation_docs.php');
        }
    } else {

        echo '<div class="container">';
        refresh("sorry you can't come here directly", 4);
    };

    echo "</div>";
} elseif ($do == "edit") {  //edit page  


    $userid =     isset($_GET['id']) && is_numeric($_GET['id']) ?  intval($_GET['id']) : 0;



    $req = "SELECT * from doc_formation where ID=" . $userid . " limit 1";


    $stmt = mysqli_query($conn, $req);
    $row = mysqli_fetch_array($stmt);


    if (mysqli_num_rows($stmt) > 0) {
    ?>
        <div id="wrapper">
            <div class="main-content">
                <div class="row small-spacing">
                    <div class="col-xs-9">
                        <div class="box-content card white">
                            <h4 class="box-title">Modifier Pack doc</h4>

                            <div class="card-content">
                                <form method="POST" action="?do=update" enctype="multipart/form-data">

                                    <div>
                                        <!-- /.dropdown js__dropdown -->
                                        <label for="exampleInputEmail1">Image Preview</label>
                                        <input type="file" name="avatar" id="input-file-now" class="dropify" accept="image/*" />
                                        <img src="../uploads/formations/<?php echo $row['Image']; ?>" alt="<?php echo $row['AdminName']; ?>" style="width:150px;" />
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom Pack doc</label>

                                        <input type="hidden" value="<?php echo $row['ID'] ?>" name="userid">

                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Nom de Pack" name="username" value="<?php echo $row['Name'] ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea class="form-control editor_yes" id="exampleInputEmail1" placeholder="Entrer Description" name="desc"><?php echo $row['Description'] ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Prix</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le prix de Pack" name="prix" value="<?php echo $row['Price'] ?>">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Categories!
                                        </label>
                                        <select name="parent" class="form-control" required>
                                            <option>sélectionnez une Categorie</option>
                                            <?php

                                            $req_g = "SELECT * FROM `categories_docs` WHERE Parent = 0";
                                            $query = mysqli_query($conn, $req_g);


                                            while ($array = mysqli_fetch_array($query)) {

                                                echo "<option style='color:white;background:#00aeff;' disabled value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";

                                                $req_p = "SELECT * FROM `categories_docs` WHERE Parent = " . $array['ID'] . " ";

                                                $query1 = mysqli_query($conn, $req_p);




                                                while ($array1 = mysqli_fetch_array($query1)) {

                                                    echo "<option ";
                                                    if ($row['Cat_ID'] == $array1['ID']) {
                                                        echo 'selected';
                                                    }
                                                    echo " value='" . $array1['ID'] . "'>" . $array1['Name'] . "</option>";
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                                    <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="formation_docs.php">Retour</a>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


    <?php
    } else {
        header('location:formation_docs.php');
    }
} elseif ($do == "update") { //update page

    echo ' <h1 class="text-center"> Edit Member </h1> ';
    echo '<div class="container">';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id     = $_POST['userid'];
        $req_img = 'SELECT * FROM doc_formation WHERE ID = ' . $id . ' ';

        $vim = mysqli_query($conn, $req_img);

        $fetchimage = mysqli_fetch_array($vim);
        $image = $fetchimage['Image'];

        if (!empty($_FILES['avatar']['name'])) {

            $avatar = $_FILES['avatar'];

            $avatarname = $avatar['name'];
            $avatarsize = $avatar['size'];
            $avatartmp = $avatar['tmp_name'];
            $avatartype = $avatar['type'];

            $avatarallowedextension = array("jpeg", "jpg", "png", "gif");

            $avatarextension = strtolower($avatarname);
            $avatarextension = explode(".", $avatarextension);
            $avatarextension = end($avatarextension);

            $image = rand(0, 10000000) . "_" . time() . "." . $avatarextension;

            move_uploaded_file($avatartmp, "../uploads/formations//" . $image);
        }


        $user   = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $email   = mysqli_escape_string($conn,$_POST['desc']);
        $phone   = $_POST['prix'];

        $pass = $_POST['parent'];


        $formserrors = array();


        if (empty($user)) {
            $formserrors[] = "<div class='alert alert-danger'>User name can't be <strong>empty</strong></div>";
        }


        if (empty($email)) {
            $formserrors[] = "<div class='alert alert-danger'>Email can't be <strong>empty</strong></div>";
        }
        foreach ($formserrors as $errors) {
            echo $errors;
        }

        if (empty($formserrors)) {


            $req = "UPDATE doc_formation SET Name='" . $user . "' , Description='" . $email . "' ,Price='" . $phone . "', Cat_ID='" . $pass . "',Image='" . $image . "' WHERE ID='" . $id . "' ";

            $stmt = mysqli_query($conn, $req);
            echo '<div class="alert alert-success">Updates Done </div>';
            header('location:formation_docs.php');
        }
    } else {

        refresh("sorry you can't come here directly", 4);
    };

    echo "</div>";
} elseif ($do == "delete") {   //delete page

    echo ' <h1 class="text-center">Delete Member</h1> ';
    echo '<div class="container">';


    $userid =     isset($_GET['id']) && is_numeric($_GET['id']) ?  intval($_GET['id']) : 0;



    $req_check = "SELECT * FROM doc_formation WHERE ID = " . $userid . " ";
    $stmt_check = mysqli_query($conn, $req_check);


    $check = mysqli_num_rows($stmt_check);



    if ($check > 0) {

        $req = "DELETE FROM doc_formation WHERE ID =  " . $userid . " ";
        $stmt = mysqli_query($conn, $req);


        echo '<div class="alert alert-success">Delete Done </div>';
        header('location:formation_docs.php');
    } else {
        echo "<div class='alert alert-danger'>This ID don't exist</div>";
    }

    echo "</div>";
} elseif ($do == "photos") {

    $itemid =     isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?  intval($_GET['itemid']) : 0;

    if (isset($_GET['delete_img'])) {


        $req_check = "SELECT * FROM docs WHERE ID = " . $_GET['delete_img'] . " ";

        $stmt_check = mysqli_query($conn, $req_check);


        $check = mysqli_num_rows($stmt_check);



        if ($check > 0) {

            $req_supp = "DELETE FROM docs WHERE ID =  " . $_GET['delete_img'] . " ";

            $stmt_supp = mysqli_query($conn, $req_supp);


            echo '<div class="alert alert-success">Doc bien supprimée</div>';
            header('location:?do=photos&itemid=' . $itemid);

            // header('location:items.php');

        } else {
            echo "<div class='alert alert-danger'>This ID don't exist</div>";
        }
    }

    if (isset($_POST['photo_modifie'])) {

        $prod_id = $_POST['itemid'];


        $avatar = $_FILES['item_img'];

        $avatar_doc = $_FILES['doc_img'];

        $avatarname_r = $avatar['name'];

        $i = count($avatarname_r);

        for ($j = 0; $j < $i; $j++) {

            $avatarname = $avatar['name'][$j];
            $avatarsize = $avatar['size'][$j];
            $avatartmp = $avatar['tmp_name'][$j];
            $avatartype = $avatar['type'][$j];


            $avatarextension = strtolower($avatarname);
            $avatarextension = explode(".", $avatarextension);
            $avatarextension = end($avatarextension);

            $imagename = "SMARTTEC_DOC_" . rand(0, 10000000) . "_" . time() . "." . $avatarextension;

            $imagename_doc = "";
            if (!empty($avatar_doc['name'][$j])) {
                $avatarname_doc = $avatar_doc['name'][$j];
                $avatarsize_doc = $avatar_doc['size'][$j];
                $avatartmp_doc = $avatar_doc['tmp_name'][$j];
                $avatartype_doc = $avatar_doc['type'][$j];


                $avatarextension_doc = strtolower($avatarname_doc);
                $avatarextension_doc = explode(".", $avatarextension_doc);
                $avatarextension_doc = end($avatarextension_doc);

                $imagename_doc = "SMARTTEC_IMG_DOC_" . rand(0, 10000000) . "_" . time() . "." . $avatarextension_doc;
                move_uploaded_file($avatartmp_doc, "../uploads/formations//" . $imagename_doc);
            }
            $order = $_POST['order'][$j];
            $name = filter_var($_POST['name_d'][$j],FILTER_SANITIZE_STRING);
            $page = $_POST['page'][$j];

            $req_ins = "SELECT * from docs where Ordering= '" . $order . "' AND f_ID = '" . $itemid . "' ";

            $stmt_ins = mysqli_query($conn, $req_ins);


            $item = mysqli_fetch_array($stmt_ins);

            $count = mysqli_num_rows($stmt_ins);


            if ($count == 0) {

                move_uploaded_file($avatartmp, "../uploads/formations//" . $imagename);



                $ref_ins = "INSERT INTO docs(Doc,f_ID,Ordering,Name_d,Image,Pages) VALUES('" . $imagename . "', '" . $prod_id . "','" . $order . "','" . $name . "','" . $imagename_doc . "','" . $page . "')";

                $stmf_ins = mysqli_query($conn, $ref_ins);
            } else {

                $taked = "<div style='color:red;'>Il y a déja un doc avec l'ordre " . $order . "</div>";
            }
        }
    }
    if (isset($_POST['modifier_order'])) {


        $order = $_POST['order'];
        $namecc = filter_var($_POST['name_d'], FILTER_SANITIZE_STRING);
        $page = $_POST['page'];

        $req_ins = "SELECT * from docs where Ordering= '" . $order . "' AND f_ID = '" . $itemid . "'  AND ID != '" . $_POST['id_doc_edit']  . "' ";

        $stmt_ins = mysqli_query($conn, $req_ins);


        $item = mysqli_fetch_array($stmt_ins);

        $count = mysqli_num_rows($stmt_ins);


        if ($count == 0) {




            $req_check = "SELECT * FROM docs WHERE ID = " . $_POST['id_doc_edit'] . " ";

            $stmt_check = mysqli_query($conn, $req_check);


            $check = mysqli_num_rows($stmt_check);



            if ($check > 0) {

                $req_up = "UPDATE docs SET Ordering='" . $_POST['order'] . "' ,Pages='" . $_POST['page'] . "' ,  Name_d='" . $namecc . "'  WHERE ID= '" . $_POST['id_doc_edit'] . "' ";

                $stmt = mysqli_query($conn, $req_up);
                // header('location:items.php');


            } else {
                echo "<div class='alert alert-danger'>This Doc don't exist</div>";
            }
        } else {

            $takedd = "<div style='color:red;'>Il y a déja un doc avec l'ordre " . $order . "</div>";
        }
    }


    $req = "SELECT * from doc_formation where ID= " . $itemid . " ";
    $stmt = mysqli_query($conn, $req);


    $item = mysqli_fetch_array($stmt);

    $count = mysqli_num_rows($stmt);



    if ($count > 0) { ?>

        <div id="wrapper">
            <div class="main-content">
                <div class="row small-spacing">
                    <div class="col-xs-9">
                        <div class="box-content card white">
                            <h4 class="box-title">Ajouter docs</h4>
                            <!-- /.box-title -->
                            <div class="card-content">
                                <form method="POST" action="?do=photos&itemid=<?php echo $itemid ?>" enctype="multipart/form-data">
                                    <label for="exampleInputEmail1">Nom De Document</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le nom de document" name="name_d[]">
                                    </br>
                                    <label for="exampleInputEmail1">Document</label>
                                    <input accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="item_img[]" required id="input-file-now" class="dropify" />
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Order</label>
                                        <?php
                                        if (isset($taked)) {
                                            echo $taked;
                                        }

                                        ?>

                                        <input type="number" required class="form-control" id="exampleInputEmail1" placeholder="Entrer l'ordre de document" name="order[]">





                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre de pages</label>

                                        <input type="number" class="form-control" required id="exampleInputEmail1" placeholder="Entrer le nombre de pages de ce document" name="page[]">

                                    </div>
                                    <label for="exampleInputEmail1">Image de document</label>
                                    <input accept="image/*" type="file" name="doc_img[]" id="input-file-now" class="dropify" />


                                    <div class="" id="plus_in">
                                        <!-- /.dropdown js__dropdown -->
                                    </div>


                                    <div>
                                        <button title="Ajouter une autre formaulaire" type="button" class="plus_hh btn btn-success btn-block"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <br>




                                    <input type="hidden" name="itemid" value="<?php echo $itemid ?>" />
                                    <button type="submit" name="photo_modifie" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
                                </form>


                                <?php

                                $req_doc = "SELECT * FROM docs WHERE f_ID = " . $itemid . " ORDER BY Ordering ASC";
                                $sct = mysqli_query($conn, $req_doc);


                                while ($row = mysqli_fetch_array($sct)) {


                                ?>
                                    <div class="col-md-2">

                                        <?php if (empty($row['Image'])) {
                                            echo '<img src="../uploads/google-docs.png" style="width:100%;height:70px;">';
                                        } else { ?>
                                            <img src="../uploads/formations/<?php echo $row['Image'] ?>" style="width:100%;height: 70px;">

                                        <?php } ?>
                                        <p><a href="../uploads/formations/<?php echo $row['Doc']; ?>"><?php echo $row['Name_d']; ?></a></p>
                                        <form method="post">
                                            <input type="hidden" name="id_doc_edit" value="<?php echo $row['ID']; ?>">
                                            <div>
                                                <label for="exampleInputEmail1">Order</label>
                                                <?php if (isset($_POST['id_doc_edit']) && ($_POST['id_doc_edit'] == $row['ID'])) {
                                                    if (isset($takedd)) {
                                                        echo $takedd;
                                                    }
                                                }
                                                ?>

                                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Entrer l'ordre de document" name="order" value="<?php echo $row['Ordering']; ?>" required />
                                                <label for="exampleInputEmail1">Nom</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer l'ordre de document" name="name_d" value="<?php echo filter_var($row['Name_d'], FILTER_SANITIZE_STRING); ?>" required />
                                                <label for="exampleInputEmail1">Pages</label>
                                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Entrer le nombre de pages de ce document" name="page" value="<?php echo $row['Pages']; ?>" required />
                                            </div>
                                            <div>

                                                <input class="btn btn-success btn-xs" type="submit" name="modifier_order" value="modifier">
                                            </div>
                                        </form>
                                        <div>
                                            <a class="btn btn-danger btn-xs confirm" href="?do=photos&itemid=<?php echo $itemid; ?>&delete_img=<?php echo $row['ID']; ?>">supprimer </a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>


                            </div>
                            <!-- /.card-content -->
                        </div>
                    </div>

                </div>


            </div>
        </div>



<?php

    } else {
        echo "there's no ID";
    }
} else {
    header('location:formation_docs.php');
}


include "footer.php";
?>