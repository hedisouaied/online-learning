<?php
$pagetitle = "Categories docs";
include 'connexion.php';
include "header.php";

if (isset($_GET['do'])) {
    $do = $_GET['do'];
} else {
    $do = "manage";
};


if ($do == "manage") { //manage page  

    $req = "SELECT * FROM `categories_docs` Where Parent = 0 ";
    $stmmt = mysqli_query($conn, $req);

?>

    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">
                <div class="col-xs-12">
                    <div class="box-content">


                        <div class="col-xs-12">
                            <a class="btn btn-primary" href="categorie_docs.php?do=add">Ajout Categorie docs</a>
                            <div class="box-content">

                                <h4 class="box-title">Categories docs</h4>
                                <!-- /.box-title -->
                                <!-- /.dropdown js__dropdown -->
                                <div id="accordion" class="js__ui_accordion">
                                    <?php
                                    while ($array = mysqli_fetch_array($stmmt)) {


                                    ?>
                                        <h3 class="accordion-title" style="padding: 20px;"><?php echo $array['Name']; ?></h3>




                                        <div class="remodal" data-remodal-id="remodal<?php echo $array['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                            <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                            <div class="remodal-content">
                                                <h2 id="modal1Title">Supprimer</h2>
                                                <p id="modal1Desc">
                                                    Vous êtes sur de supprimer ce service ?
                                                </p>
                                            </div>
                                            <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                                            <a href="?do=delete&id=<?php echo $array['ID']; ?>" class="btn btn-primary">Supprimer</a>
                                        </div>
                                        <div class="accordion-content">
                                            <div style="margin-bottom:40px;">
                                                <a href="categorie_docs.php?do=edit&id=<?php echo $array['ID']; ?>" class="btn btn-info btn-xs waves-effect waves-light pull-right">Modifier</a>
                                                <a type="button" data-remodal-target="remodal<?php echo $array['ID']; ?>" class="btn btn-danger btn-xs waves-effect waves-light pull-right">Supprimer</a>
                                            </div>
                                            <ul>
                                                <?php

                                                $req1 = "SELECT * FROM `categories_docs` WHERE Parent = " . $array['ID'] . " ";
                                                $stmmt1 = mysqli_query($conn, $req1);
                                                while ($array1 = mysqli_fetch_array($stmmt1)) {


                                                ?>

                                                    <li style="padding: 10px;"><?php echo $array1['Name']; ?>
                                                        <a type="button" href="categorie_docs.php?do=edit&id=<?php echo $array1['ID']; ?>" class="btn btn-info btn-xs waves-effect waves-light pull-right">Modifier</a>
                                                        <a type="button" data-remodal-target="remodal<?php echo $array1['ID']; ?>" class="btn btn-danger btn-xs waves-effect waves-light pull-right">Supprimer</a>
                                                    </li>

                                                    <div class="remodal" data-remodal-id="remodal<?php echo $array1['ID']; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                                                        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
                                                        <div class="remodal-content">
                                                            <h2 id="modal1Title">Supprimer</h2>
                                                            <p id="modal1Desc">
                                                                Vous êtes sur de supprimer ce service ?
                                                            </p>
                                                        </div>
                                                        <button data-remodal-action="cancel" class="remodal-cancel">Annuler</button>
                                                        <a href="?do=delete&id=<?php echo $array1['ID']; ?>" class="btn btn-primary">Supprimer</a>
                                                    </div>

                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <h4 class="box-title">Ajouter Categorie doc</h4>
                        <!-- /.box-title -->
                        <div class="card-content">
                            <form method="POST" action="?do=insert">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nom Categorie</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom formation" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Material Icons</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le code de l'icone" name="icon" required>
                                    <div class='alert alert-success alert-dismissible'>
                                        <strong>Les codes de fontawesome sont disponisble</strong><a href="https://fontawesome.com/v5.15/icons/" target="_blank"> <strong> ici</strong></a>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">
                                        Parent!
                                    </label>
                                    <select name="parent" class="form-control">
                                        <option value="0">None</option>

                                        <?php
                                        $req = "SELECT * FROM `categories_docs` Where Parent = 0 ";
                                        $stmmt = mysqli_query($conn, $req);
                                        while ($array = mysqli_fetch_array($stmmt)) {

                                            echo "<option value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                                <br>


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


        $user   = mysqli_real_escape_string($conn, $_POST['username']);
        $pass   = $_POST['parent'];
        $icon   = $_POST['icon'];



        $req = "INSERT INTO `categories_docs` (`Name`, `icon`, `Parent`) VALUES ('" . $user . "', '" . $icon . "', '" . $pass . "')";


        $stmt = mysqli_query($conn, $req);

        header('location:categorie_docs.php');
    } else {

        echo '<div class="container">';
        refresh("sorry you can't come here directly", 4);
    };

    echo "</div>";
} elseif ($do == "edit") {  //edit page  


    $userid =     isset($_GET['id']) && is_numeric($_GET['id']) ?  intval($_GET['id']) : 0;

    $req = "SELECT * from categories_docs where ID=" . $userid . " limit 1";


    $stmt = mysqli_query($conn, $req);
    $row = mysqli_fetch_array($stmt);


    if (mysqli_num_rows($stmt) > 0) {
    ?>
        <div id="wrapper">
            <div class="main-content">
                <div class="row small-spacing">
                    <div class="col-xs-9">
                        <div class="box-content card white">
                            <h4 class="box-title">Modifier Categorie doc</h4>

                            <div class="card-content">
                                <form method="POST" action="?do=update" enctype="multipart/form-data">


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nom Categorie docs</label>

                                        <input type="hidden" value="<?php echo $row['ID'] ?>" name="userid">

                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer Nom" name="username" required value="<?php echo $row['Name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Material Icons</label>


                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Entrer le code de l'icone" required name="icon" value="<?php echo $row['icon'] ?>">
                                        <div class='alert alert-success alert-dismissible'>
                                            <strong>Les codes de fontawesome icons sont disponisble</strong><a href="https://fontawesome.com/v5.15/icons/" target="_blank"> <strong> ici</strong></a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Parent!
                                        </label>
                                        <select name="parent" class="form-control">
                                            <option value="0">None</option>
                                            <?php
                                            $req = "SELECT * FROM `categories_docs` WHERE Parent = 0 AND ID != " . $userid . " ";
                                            $stmmt = mysqli_query($conn, $req);
                                            while ($array = mysqli_fetch_array($stmmt)) {



                                                echo "<option ";

                                                if ($row['Parent'] == $array['ID']) {
                                                    echo "selected ";
                                                }

                                                echo " value='" . $array['ID'] . "' >" . $array['Name'] . "</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
                                    <a type="submit" class="btn btn-info btn-sm waves-effect waves-light" href="categorie_docs.php">Retour</a>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


<?php
    } else {
        header('location:categorie_docs.php');
    }
} elseif ($do == "update") { //update page

    echo ' <h1 class="text-center"> Edit Member </h1> ';
    echo '<div class="container">';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id     = $_POST['userid'];


        $user   = mysqli_real_escape_string($conn,$_POST['username']);
        $icon   = $_POST['icon'];
        $pass = $_POST['parent'];


        $formserrors = array();


        if (empty($user)) {
            $formserrors[] = "<div class='alert alert-danger'>User name can't be <strong>empty</strong></div>";
        }


        foreach ($formserrors as $errors) {
            echo $errors;
        }

        if (empty($formserrors)) {

            $req = "UPDATE categories_docs SET Name = '" . $user . "', icon='" . $icon . "' , Parent='" . $pass . "'  WHERE ID='" . $id . "' ";
            $stmt = mysqli_query($conn, $req);




            echo '<div class="alert alert-success">Updates Done </div>';
            header('location:categorie_docs.php');
        }
    } else {

        refresh("sorry you can't come here directly", 4);
    };

    echo "</div>";
} elseif ($do == "delete") {   //delete page

    echo ' <h1 class="text-center">Delete Member</h1> ';
    echo '<div class="container">';


    $userid =     isset($_GET['id']) && is_numeric($_GET['id']) ?  intval($_GET['id']) : 0;


    $req_check = "SELECT * FROM categories_docs WHERE ID = " . $userid . " ";
    $stmt_check = mysqli_query($conn, $req_check);


    $check = mysqli_num_rows($stmt_check);


    if ($check > 0) {


        $req = "DELETE FROM categories_docs WHERE ID =  " . $userid . " ";
        $stmt = mysqli_query($conn, $req);

        $req_child = "SELECT * FROM categories_docs WHERE Parent = " . $userid . " ";
        $exec_child = mysqli_query($conn, $req_child);
        while ($array_child = mysqli_fetch_array($exec_child)) {
            $reqq = "DELETE FROM `categories_docs` WHERE ID= " . $array_child['ID'];
            $execc = mysqli_query($conn, $reqq);
        }


        echo '<div class="alert alert-success">Delete Done </div>';
        header('location:categorie_docs.php');
    } else {
        echo "<div class='alert alert-danger'>This ID don't exist</div>";
    }

    echo "</div>";
} else {
    header('location:categorie_docs.php');
}


include "footer.php";
?>