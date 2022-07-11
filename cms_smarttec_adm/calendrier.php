<?php
//index.php
include 'connexion.php';

$pagetitle = "calendrier";

include "header.php";
?>



<div class="content">
    <div id="wrapper">
        <div class="main-content">
            <div class="row small-spacing">



                <h2 align="center"><a>Calendrier Des Formations en Direct</a></h2>
                
                <div class="container">
                    <div>
                    <a class="btn btn-primary" href="liste-formations.php">Liste des formations</a>
                </div>
                    <div id="calendar"></div>
                </div>



            </div>
        </div>
    </div>
</div>


<?php include "footer.php"; ?>