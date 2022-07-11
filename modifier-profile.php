<?php
ob_start();
$pagetitle = 'modifier profile';

include 'header.php';
if (!isset($_SESSION['client'])) {
    header('location:index.php');
}
$msg = '';

if (isset($_POST['info'])) {

    $query1 = "SELECT * FROM clients where ID = " . $_SESSION['id'] . " ";


    $exec1 = mysqli_query($conn, $query1);

    $array = mysqli_fetch_array($exec1);

    $logo = $array['photo'];

    $nom = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $nom = filter_var($nom, FILTER_SANITIZE_STRING);

    $phone = (filter_var($_POST['code_p'], FILTER_SANITIZE_STRING)) . ',' . (filter_var($_POST['phone'], FILTER_SANITIZE_STRING));

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $poste = filter_var($_POST['poste'], FILTER_SANITIZE_STRING);
    $entreprise = filter_var($_POST['entreprise'], FILTER_SANITIZE_STRING);





    if (!empty($_FILES['logo']['name'])) {
        $errors = array();
        $file_name = mysqli_real_escape_string($conn, $_FILES['logo']['name']);
        $file_size = $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $exp = explode('.', $_FILES['logo']['name']);
        $end_expl = end($exp);
        $file_ext = strtolower($end_expl);

        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }



        $logo = time() . '_' . $file_name;

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "uploads/avatars/" . $logo);
            //echo "Success";
        } else {
            print_r($errors);
        }
    }

    $req = "UPDATE `clients` SET `fullname`='" . $nom . "',`email`='" . $email . "',`phone`='" . $phone . "',`poste`='" . $poste . "',`entreprise`='" . $entreprise . "',`photo`='" . $logo . "' WHERE ID = " . $_SESSION['id'] . " ";

    $exec = mysqli_query($conn, $req);
    if ($exec) {


        $_SESSION['name'] = $nom;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['photo'] = $logo;

        $msg = "<div class='alert alert-success alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>Bravo!</strong> Vos  informations ont été modifiées avec succès.
</div>";
    } else {
        $msg = "<div class='alert alert-danger alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
    <strong>oups!</strong> Vos informations n'ont pas été modifiées!!!
</div>";
    }
}
$msg_pass = "";
if (isset($_POST['pass'])) {
    $pass1 = mysqli_real_escape_string($conn, $_POST['password']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['confirm_pass']);
    if ($pass1 == $pass2) {
        $req = "UPDATE `clients` SET `password`='" . $pass1 . "' WHERE ID = " . $_SESSION['id'] . " ";

        $exec = mysqli_query($conn, $req);
        if ($exec) {
            $msg_pass = "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Bravo!</strong> Votre mot de passe a été modifié.
    </div>";
        } else {
            $msg_pass = "<div class='alert alert-danger alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Oups!</strong> mot de passe n'est pas accepté !!!
    </div>";
        }
    } else {
        $msg_pass = "<div class='alert alert-danger alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Oups!</strong> les deux mots de passe ne sont pas identiques!!!
    </div>";
    }
}
?>
<!-- Drawer Layout -->

<div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px" style="margin:auto;margin-top: 4rem;width: 100%;">
    <div class="mdk-drawer-layout__content page-content">


        <div class="pt-32pt">
            <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                <div class="flex d-flex flex-column flex-sm-row align-items-center">

                    <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                        <h2 class="mb-0">Compte</h2>

                        <ol class="breadcrumb p-0 m-0">
                            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>

                            <li class="breadcrumb-item">

                                <a href="">Compte</a>

                            </li>

                            <li class="breadcrumb-item active">

                                Modifier profile

                            </li>

                        </ol>

                    </div>
                </div>

            </div>
        </div>



        <div class="container page__container page-section">
            <div class="page-separator">
                <div class="page-separator__text">Information générale</div>
            </div>
            <div class="col-md-6 p-0">
                <?php echo $msg; ?>
                <form method="POST" enctype="multipart/form-data">
                    <?php

                    $query1 = "SELECT * FROM clients WHERE ID = " . $_SESSION['id'] . "  ";


                    $exec1 = mysqli_query($conn, $query1);

                    $array = mysqli_fetch_array($exec1);
                    $nom = $array['fullname'];
                    $email = utf8_encode($array['email']);
                    $password = $array['password'];
                    $phone = utf8_encode($array['phone']);
                    $poste = $array['poste'];
                    $entreprise = $array['entreprise'];



                    ?>
                    <div class="form-group">
                        <label class="form-label">Photo de Profile</label>
                        <div class="media align-items-center">
                            <a href="" class="media-left mr-16pt">
                                <?php if (empty($array['photo'])) { ?>
                                    <img src="public/images/people/110/guy-3.jpg" alt="people" width="56" class="rounded-circle">
                                <?php } else {
                                    echo '<img src="uploads/avatars/' . $array['photo'] . '" alt="people" style="width: 50px;height: 50px;padding: 0;max-width: 50px;" class="rounded-circle">';
                                } ?>
                            </a>
                            <div class="media-body">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="logo" accept="image/*">
                                    <label class="custom-file-label" for="inputGroupFile01">Choisir une photo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nom et Prénom</label>
                        <input type="text" class="form-control" value="<?php echo $nom ?>" name="fullname" placeholder="nom et prénom ...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">adresse Email</label>
                        <input type="email" class="form-control" value="<?php echo $email ?>" name="email" placeholder="adresse email ...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Numéro de téléphone</label>
                        <?php $phone_a = explode(',', $phone);  ?>
                        <div class="input-group input-group-merge">
                            <input id="email_2" type="text" required="" class="form-control form-control-prepended" placeholder="numèro de téléphone" value="<?php echo $phone_a[1]; ?>" name="phone">
                            <input type="hidden" name="code_p" value="<?php echo $phone_a[0]; ?>">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span><?php echo $phone_a[0]; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Poste de travail</label>
                        <input type="text" class="form-control" value="<?php echo $poste ?>" name="poste" placeholder="Poste de travail ...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nom d'entreprise</label>
                        <input type="text" class="form-control" value="<?php echo $entreprise ?>" name="entreprise" placeholder="nom d'entreprise ...">
                    </div>


                    <button type="submit" name="info" class="btn btn-primary">Enregistrez</button>
                </form>
            </div>
        </div>
        <div class="page-section pb-0">
            <div class="container page__container d-flex flex-column flex-sm-row align-items-sm-center">
                <div class="flex">
                    <h1 class="h2 mb-0">Sécurité</h1>
                </div>
                <p class="d-sm-none"></p>
                <a href="" class="btn btn-outline-secondary flex-column">
                    Besoin d'aide?
                    <span class="btn__secondary-text">Contactez-nous</span>
                </a>
            </div>
        </div>
        <div class="page-section" id="password">
            <div class="container page__container">
                <div class="page-separator">
                    <div class="page-separator__text">Changer mot de passe</div>
                </div>
                <?php echo $msg_pass; ?>
                <form action="#password" method="POST" class="col-sm-5 p-0">
                    <div class="form-group">
                        <label class="form-label" for="password">Nouveau mot de passe:</label>
                        <input id="password" required type="password" class="form-control" name="password" placeholder="nouveau mot de passe ...">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password2">Confirmez le mot de passe:</label>
                        <input id="password2" required type="password" name="confirm_pass" class="form-control" placeholder="Confirmer mot de passe ...">
                    </div>
                    <button type="submit" name="pass" class="btn btn-primary">Enregistrez votre mot de passe</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</div>


<?php include 'footer.php';
ob_end_flush();
?>