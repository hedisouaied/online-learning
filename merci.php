<?php
ob_start();
$pagetitle = "Merci Pour Votre Commande";


include "header.php";




?>
<div class="mdk-box bg-primary mdk-box--bg-primary js-mdk-box mb-0" data-effects="blend-background" data-domfactory-upgraded="mdk-box" style="margin-top: 44px;">

    <div class="mdk-box__content">
        <div class="hero py-64pt text-center text-sm-left">
            <div class="container page__container">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="order-1 order-sm-0">
                        <h1 class="text-white">Merci pour votre commande </h1>
                        <p class="lead text-white-50 measure-hero-lead mb-24pt">Votre commande a été passée avec succès sur SmarTTec, vous pouvez maintenant accèder à vos formations et cours achetés en cliquant sur le boutton ci-dessous.</p>
                        <a href="mescours.php" class="btn btn-outline-white">Voir mes achats</a>
                    </div>
                    <div class="ml-sm-auto order-sm-1">
                        <div class="position-relative overflow-hidden rounded border-4 border-light mb-16pt mb-sm-0">
                            <div class="bg-primary fullbleed" style="opacity: .5;"></div>
                            <img class="" src="uploads/logo/black.svg" alt="smarttec" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php

include "footer.php";


ob_end_flush();
?>