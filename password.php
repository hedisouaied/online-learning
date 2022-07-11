<?php
ob_start();

$pagetitle = 'Mot de passe oublié';

include 'header.php';
if(!isset($_SESSION['client'])){
$success_msg = "";

$msg_mail = "";
if (isset($_POST['login'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $row = "SELECT * FROM `clients` where email='" . $email . "' ";

    // 4- Exécution
    $exect = mysqli_query($conn, $row);

    $array = mysqli_fetch_array($exect);
    // 5- verification
    $result = mysqli_num_rows($exect);

    if ($result == 0) {
        $msg_mail = '
    <div class="alert alert-soft-danger d-flex" role="alert">
            <i class="material-icons mr-12pt">dangerous</i>
            <div class="text-body">Cet <strong>Email</strong>'." n'existe pas!!".'</div>
        </div>';
    } else {

$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $randstring = '';

                for ($i = 0; $i < 8; $i++) {
                  $randstring = $characters[rand(0, strlen($characters))] . $randstring;
                }
       $req = "UPDATE `clients` SET `Password`='" . $randstring . "' WHERE email = '" . $email . "' ";
       $exec = mysqli_query($conn,$req);
       
       $to = $email;
  	        $subject = "Nouveau mot de passe de votre compte sur e-smarttec.com";

   $message="<html>
<head>
    <meta charset=\"utf-8\">
    <title>Nouveau mot de passe e-smarttec.com</title>
    
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
                                <img alt='e-smarttec logo' src=\"http://e-smarttec.com/uploads/logo/black.svg\" style=\"width:100%; max-width:300px;\">                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class=\"information\">
                <td colspan=\"6\">
                    <table>
                    
                        <tr>
                            <td  style=\" font-weight: bold; padding-bottom: 0;font-size:13px;\"> http://e-smarttec.com/</td>
                            <td  style=\" border-bottom: 1px solid #ddd; font-weight: bold; padding-bottom: 0;\">Nouvelle paramétre de compte </td>
                        </tr>
                        <tr>
                            <td style=\" font-weight: bold;font-size:15px; \">
                                Avenue Louis Braille,  <br>Tunis 1002 <br> Tunisie <br>
                            </td>
                            <td >
                               E-mail: $email <br> Mot de passe: $randstring 
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
         $headers = "From: e-smarttec <" . $array_about['Email'] . "> \r\n";
                            $headers .= "Reply-To:" . $array_about['Email'] . "\r\n";
                            $headers .= 'MIME-Version: 1.0' . "\r\n" .
                                'Content-type: text/html; ' . "\r\n" .

                                'X-Mailer: PHP/' . phpversion();

                            mail($to, $subject, $message, $headers);
        $success_msg = "
    <div class='alert alert-soft-success d-flex'
                 role='alert'>
                <i class='material-icons mr-12pt'>check_circle</i>
                <div class='text-body'>Votre mot de passe a été modifiée, veuiller consulter votre email!!!</div>
            </div> ";

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
        <p class="m-0">Entrer votre E-mail pour changer votre mot de passe</p>
    </div>
    <?php

    echo $msg_mail;
    echo $success_msg;
    ?>

    <form action="" method="POST">
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
            <button class="btn btn-block btn-primary" name="login" type="submit">Changer mot de passe</button>
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