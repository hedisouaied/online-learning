<?php
ob_start();

$pagetitle = 'Login';

include 'header.php';
if(!isset($_SESSION['client'])){
$success_msg = "";
if (isset($_GET['success'])) {
    $success_msg = "
    <div class='alert alert-soft-success d-flex'
                 role='alert'>
                <i class='material-icons mr-12pt'>check_circle</i>
                <div class='text-body'>Votre inscription a été effectué avec succès, Vous pouvez maintenant se connecter à votre compte !!!</div>
            </div> ";
}
$msg_mail = "";
if (isset($_POST['login'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $row = "SELECT * FROM `clients` where email='" . $email . "' and password='" . $password . "' ";

    // 4- Exécution
    $exect = mysqli_query($conn, $row);

    $array = mysqli_fetch_array($exect);
    // 5- verification
    $result = mysqli_num_rows($exect);

    if ($result == 0) {
        $msg_mail = '
    <div class="alert alert-soft-danger d-flex" role="alert">
            <i class="material-icons mr-12pt">dangerous</i>
            <div class="text-body">Vérifiez Votre <strong>Email</strong> ou <strong>Mot de passe</strong> !!!</div>
        </div>';
    } else {

        $_SESSION['client'] = true;
        $_SESSION['id'] = $array['ID'];
        $_SESSION['name'] = $array['fullname'];
        $_SESSION['email'] = $array['email'];
        $_SESSION['phone'] = $array['phone'];
        $_SESSION['photo'] = $array['photo'];

 if(isset($_POST['reserve_id'])){
            $type = "Direct";
            $user_id = $_SESSION['id'];
            $ID_li = $_POST['reserve_id'];
            $req_check = "SELECT * FROM `checkout` WHERE ID_p = " . $ID_li . " AND ID_sess = " . $user_id . " AND type_p = '" . $type . "' ";
            $exec_check = mysqli_query($conn, $req_check);
            $check = mysqli_num_rows($exec_check);
            if ($check == 0) {
        
        
                $req = "INSERT INTO `checkout` (`ID_p`, `ID_sess`, `type_p`,`date`) VALUES ('" . $ID_li . "','" . $user_id . "','" . $type . "',now())";
        
                $exec = mysqli_query($conn, $req);
                
            }
            header("location: mescours.php");
        }else{
                // redirect to previous page after login
                if (isset($_POST['location_login'])) {
                    header("location:" . $_POST['location_login']);
                } else {
                    header("location:index.php");
                }
        }
    }
}
?>
<div class="layout-login-centered-boxed__form card" style="margin: auto;margin-top: 6rem;margin-bottom: 3rem;">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="index.php" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">

            <span class="avatar avatar-sm navbar-brand-icon mr-0" style="width: 5.5rem;height: 5.5rem;">

                <span class="avatar-title rounded bg-primary" style="background-color: white !important;"><img src="uploads/logo/black.svg" alt="logo" class="img-fluid" /></span>

            </span>

            SmarTTec
        </a>
        <p class="m-0">Se connecter pour accéder à votre compte SmarTTec </p>
    </div>
    <?php

    echo $msg_mail;
    echo $success_msg;
    ?>

    <form action="" method="POST">
        <?php

        if (isset($_GET['location'])) {

        ?>
            <input type="hidden" name="location_login" value="<?php echo $_GET['location']; ?>" />
        <?php } ?>
         <?php

        if (isset($_GET['reserve_id'])) {

        ?>
            <input type="hidden" name="reserve_id" value="<?php echo $_GET['reserve_id']; ?>" />
        <?php } ?>
        <div class="form-group">
            <label class="text-label" for="email_2">Adresse Email:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="email" required="" class="form-control form-control-prepended" placeholder="johnJack@gmail.com" name="email">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="password_2">Mot de passe:</label>
            <div class="input-group input-group-merge">
                <input id="password_2" name="password" type="password" required="" class="form-control form-control-prepended" placeholder="Entrer votre mot de passe">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-key"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primary" name="login" type="submit">Se connecter</button>
        </div>

        <div class="form-group text-center">
            <a href="password.php">Oubliez mot de passe?</a> <br>
            N'avez vous un compte? <a class="text-body text-underline" href="signup.php<?php if(isset($_GET['reserve_id'])){ echo "?reserve_id=".$_GET['reserve_id']; } ?>">Inscription!</a>
        </div>
    </form>
</div>

<?php
include 'footer.php';
}else{
	header("location: index.php");
}
ob_end_flush();
?>