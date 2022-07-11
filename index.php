<?php
$pagetitle = 'Accueil';
include 'header.php';


$query1 = "SELECT * FROM site_settings where ID_s=1 ";


$exec1 = mysqli_query($conn, $query1);

$array = mysqli_fetch_array($exec1);
$img = $array['Image'];
$title1 = $array['title1'];
$para1 = $array['para1'];
$title2 = $array['title2'];
$para2 = $array['para2'];
$title3 = $array['title3'];
$para3 = $array['para3'];
$title4 = $array['title4'];
$para4 = $array['para4'];
$title5 = $array['title5'];
$para5 = $array['para5'];
$title6 = $array['title6'];
$para6 = $array['para6'];
$title7 = $array['title7'];
$para7 = $array['para7'];
$title8 = $array['title8'];
$para8 = $array['para8'];





?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
<script>
$(document).ready(function(){
 $(".recap").submit(function(){
   var response = grecaptcha.getResponse();
      if(response.length == 0){
          alert('Veuillez vérifier le Captcha');
    return false;
 } 
 });
});
</script>
 <script type="text/javascript">
 var onloadCallback = function() {
 grecaptcha.render('html_element', {
 'sitekey' : '6LfOo8kbAAAAAOeiyAPz253bgym6iBq7sDYCU25j'});
 };
 </script>

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

<style>

#carousel .carousel-item {
  height: 100vh;
  width: 100%;
  min-height: 350px;
  background: no-repeat center center scroll;
  background-size: cover;
}

#carousel .carousel-inner .carousel-item {
  transition: -webkit-transform 2s ease;
  transition: transform 2s ease;
  transition: transform 2s ease, -webkit-transform 2s ease;
}

#carousel .carousel-item .caption {
  background-color: rgba(0, 0, 0, 0.5);
  padding: 40px;
  color: white;
  animation-duration: 1s;
  animation-delay: 2s;
}

#carousel .caption h2 {
  animation-duration: 1s;
  animation-delay: 2s;
}

#carousel .caption p {
  animation-duration: 1s;
  animation-delay: 2.2s;
}

#carousel .caption a {
  animation-duration: 1s;
  animation-delay: 2.4s;
}

/* Button */
.delicious-btn {
  display: inline-block;
  min-width: 160px;
  height: 60px;
  color: #ffffff;
  border: none;
  border-left: 3px solid #1c8314;
  border-radius: 0;
  padding: 0 30px;
  font-size: 16px;
  line-height: 58px;
  font-weight: 600;
  -webkit-transition-duration: 500ms;
  transition-duration: 500ms;
  text-transform: capitalize;
  background-color: #40ba37;
}

.delicious-btn.active, .delicious-btn:hover, .delicious-btn:focus {
  font-size: 16px;
  font-weight: 600;
  color: #ffffff;
  background-color: #1c8314;
  border-color: #40ba37;
}
    </style>
    <div id="carousel" class="carousel slide hero-slides" data-ride="carousel">
  <ol class="carousel-indicators">
    <li class="active" data-target="#carousel" data-slide-to="0"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
      <?php
				$query_slider = "SELECT * FROM `slider`";

				$exec_slider = mysqli_query($conn, $query_slider);
$i = 0 ;
				while ($array_slider = mysqli_fetch_array($exec_slider)) {
				    $image_slider= $array_slider['Image'];

				?>
    <div class="carousel-item <?php if($i == 0){ echo "active"; }  ?> boat" style="background-image: url('uploads/sliders/<?php echo $image_slider; ?>');">
      <div class="mdk-box__content d-flex align-items-center justify-content-center container page__container text-center py-112pt" style="min-height: 656px;">
            <div class="card card--transparent mb-0">
                <div class="card-body px-32pt py-24pt">
                    <h1><?php echo $array_slider['Name']; ?></h1>
                    <div class="d-flex align-items-center mb-24pt  d-lg-none">
                        <form action="index.php#target_search" class="search-form search-form--light mx-16pt pr-0 pl-16pt">
                            <input type="text" class="form-control pl-0" name="search_all" placeholder="Search">
                            <button class="btn" type="submit"><i class="material-icons">search</i></button>
                        </form>
                    </div>
                    <p class="lead measure-lead mx-auto mb-32pt"><?php echo $array_slider['Text']; ?></p>

                    <a href="#contact" class="btn btn-lg btn-accent btn--raised mb-16pt">Contactez-Nous !</a>

                </div>
            </div>
        </div>
    </div>
   <?php 
   $i++;
   } ?>
  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    <?php
    if (isset($_GET['search_all'])) {

        $search_all = $_GET['search_all'];

    ?>
        <div class="page-section border-bottom-2" id="target_search">
            <div class="container page__container">
                <div class="page-separator">
                    <div class="page-separator__text">Résultats des formations 100% E-learning / <?php echo $_GET['search_all'] ?></div>
                </div>

                <div class="row card-group-row">
                    <?php
                    $req_elearning = "SELECT * FROM `cours` WHERE ( (`NAME_c` LIKE '%$search_all%') OR (`Desc_c` LIKE '%$search_all%') OR (`meta_keys` LIKE '%$search_all%') ) LIMIT 3";
                    $exec_elearning_search = mysqli_query($conn, $req_elearning);
                    while ($array = mysqli_fetch_array($exec_elearning_search)) {


                    ?>

                        <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card" data-partial-height="44" data-toggle="popover" data-trigger="click">

                                <a href="enroll-cours.php?id_c=<?php echo $array['ID_c']; ?>" class="js-image" data-position="">
                                    <img src="uploads/cours/img/<?php echo $array['Image']; ?>" style="height: 110px;" alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">Aperçu</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title" href="enroll-cours.php?id_c=<?php echo $array['ID_c']; ?>" target="_blank"><?php echo $array['Name_c']; ?></a>
                                                <small class="text-50 font-weight-bold mb-4pt">SmarTTec</small>
                                            </div>
                                            <span class="box bounce-1"><?php echo $array['price']; ?> DT</span>
                                            <a href="enroll-cours.php?id_c=<?php echo $array['ID_c']; ?>" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                            </div>
                                            <small class="text-50"><?php
                                                                    $req_v = "SELECT * FROM `lesson` WHERE cours_id = " . $array['ID_c'] . " ";
                                                                    $exec_v = mysqli_query($conn, $req_v);
                                                                    $hours = 0;
                                                                    while ($array_v = mysqli_fetch_array($exec_v)) {
                                                                        $hours = $hours + $array_v['duration'];
                                                                    }
                                                                    echo ceil($hours / 60);


                                                                    ?> heures</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="uploads/cours/img/<?php echo $array['Image']; ?>" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0"><?php echo $array['Name_c']; ?></div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-50 small">by</span>
                                            <span class="text-50 small font-weight-bold">smarttec</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-70"><?php echo substr($array['Desc_c'], 0, 250) ?></p>



                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>
                                                    <?php
                                                    $req_v = "SELECT * FROM `lesson` WHERE cours_id = " . $array['ID_c'] . " ";
                                                    $exec_v = mysqli_query($conn, $req_v);
                                                    $hours = 0;
                                                    while ($array_v = mysqli_fetch_array($exec_v)) {
                                                        $hours = $hours + $array_v['duration'];
                                                    }
                                                    echo ceil($hours / 60);


                                                    ?> heures</small></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>

                                            <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                        $req_l = "SELECT * FROM `lesson` WHERE cours_id = " . $array['ID_c'] . " ";
                                                                                        $exec_l = mysqli_query($conn, $req_l);
                                                                                        $lessons = mysqli_num_rows($exec_l);
                                                                                        echo $lessons;
                                                                                        ?> lessons</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                            <p class="flex text-50 lh-1 mb-0"><small><?php echo $array['level']; ?></small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="enroll-cours.php?id_c=<?php echo $array['ID_c']; ?>" target="_blank" class="btn btn-primary">Aperçu le cour</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    <?php } ?>

                    <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                        <a style="font-size: 22px;text-align: center;line-height: 28px;width: 100%;font-weight: 500;text-decoration: underline double!important;font-family: revert;" href="cours.php?search_in=<?php echo $search_all; ?>">Plus de résultat</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Doc Start -->
        <div class="page-section border-bottom-2" id="target_search">
            <div class="container page__container">
                <div class="page-separator">
                    <div class="page-separator__text">Résultats des Packs Documentaires / <?php echo $_GET['search_all'] ?></div>
                </div>

                <div class="row card-group-row">
                    <?php
                    $req_doc = "SELECT * FROM `doc_formation` WHERE ( (`Name` LIKE '%$search_all%') OR (`Description` LIKE '%$search_all%') ) LIMIT 3";
                    $exec_doc_search = mysqli_query($conn, $req_doc);
                    while ($array = mysqli_fetch_array($exec_doc_search)) {


                    ?>

                        <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card" data-partial-height="44" data-toggle="popover" data-trigger="click">

                                <a href="docs.php?id_d=<?php echo $array['ID']; ?>" class="js-image" data-position="">
                                    <img src="uploads/formations/<?php echo $array['Image']; ?>" style="height: 110px;" alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">Aperçu</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title" href="enroll-doc.php?id_c=<?php echo $array['ID']; ?>"><?php echo $array['Name']; ?></a>
                                                <small class="text-50 font-weight-bold mb-4pt">smarttec</small>
                                            </div>
                                            <span class="box bounce-1"><?php echo $array['Price']; ?> DT</span>
                                            <a href="docs.php?id_c=<?php echo $array['ID']; ?>" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="uploads/formations/<?php echo $array['Image']; ?>" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0"><?php echo $array['Name']; ?></div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-50 small">by</span>
                                            <span class="text-50 small font-weight-bold">smarttec</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-70"><?php echo $array['Description']; ?></p>



                                <div class="row align-items-center">
                                    <div class="col-auto">

                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">file_present</span>

                                            <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                        $req_l = "SELECT * FROM `docs` WHERE f_ID = " . $array['ID'] . " ";
                                                                                        $exec_l = mysqli_query($conn, $req_l);
                                                                                        $lessons = mysqli_num_rows($exec_l);
                                                                                        echo $lessons;
                                                                                        ?> Docs</small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="enroll-doc.php?id_c=<?php echo $array['ID']; ?>" target="_blank" class="btn btn-primary">Voir formation</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    <?php } ?>

                    <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                        <a style="font-size: 22px;text-align: center;line-height: 28px;width: 100%;font-weight: 500;text-decoration: underline double!important;font-family: revert;" href="docs.php?search_in=<?php echo $search_all; ?>">Plus de résultat</a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Doc End -->

        <!-- live Start -->
        <div class="page-section border-bottom-2" id="target_search">
            <div class="container page__container">
                <div class="page-separator">
                    <div class="page-separator__text">Résultats des formations en Direct / <?php echo $_GET['search_all'] ?></div>
                </div>

                <div class="row card-group-row">
                    <?php
                    $req_live = "SELECT * FROM `formations_live` WHERE ( (`Name_f` LIKE '%$search_all%') OR (`Desc_f` LIKE '%$search_all%') OR (`meta_keys` LIKE '%$search_all%') ) LIMIT 3";
                    $exec_live_search = mysqli_query($conn, $req_live);
                    while ($array = mysqli_fetch_array($exec_live_search)) {


                    ?>

                        <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card" data-partial-height="44" data-toggle="popover" data-trigger="click">

                                <a href="enroll-cours.php?id_c=<?php echo $array['ID_f']; ?>" class="js-image" data-position="">
                                    <img src="uploads/formations/img/<?php echo $array['Image']; ?>" style="height: 110px;" alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">Aperçu</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title" href="enroll-direct.php?id_l=<?php echo $array['ID_f']; ?>"><?php echo $array['Name_f']; ?></a>
                                                <small class="text-50 font-weight-bold mb-4pt">SmarTTec</small>
                                            </div>
                                            <span class="box bounce-1"><?php echo $array['price']; ?> DT</span>
                                            <a href="enroll-direct.php?id_l=<?php echo $array['ID_c']; ?>" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" target="_blank" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star</span></span>
                                                <span class="rating__item"><span class="material-icons">star_border</span></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="uploads/formations/img/<?php echo $array['Image']; ?>" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0"><?php echo $array['Name_f']; ?></div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-50 small">by</span>
                                            <span class="text-50 small font-weight-bold">smarttec</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-70"><?php echo $array['Desc_f']; ?></p>



                                <div class="row align-items-center">
                                    <div class="col-auto">

                                        <div class="d-flex align-items-center mb-4pt">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">calendar_today</span>

                                            <p class="flex text-50 lh-1 mb-0"><small><?php
                                                                                        $req_l = "SELECT * FROM `events` WHERE ID_f = " . $array['ID_f'] . " ";
                                                                                        $exec_l = mysqli_query($conn, $req_l);
                                                                                        $lessons = mysqli_num_rows($exec_l);
                                                                                        echo $lessons;
                                                                                        ?> Sessions</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                            <p class="flex text-50 lh-1 mb-0"><small><?php echo $array['level']; ?></small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="enroll-direct.php?id_l=<?php echo $array['ID_f']; ?>" target="_blank" class="btn btn-primary">Voir formation</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    <?php } ?>

                    <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                        <a style="font-size: 22px;text-align: center;line-height: 28px;width: 100%;font-weight: 500;text-decoration: underline double!important;font-family: revert;" href="direct.php?search_in=<?php echo $search_all; ?>">Plus de résultat</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- live End -->


    <?php } ?>
    
   
    <div class="page-section border-bottom-2 bg-white" id="services">
        <div class="container page__container">
            <div class="page-headline text-center">
                <h2><?php echo $title2; ?></h2>
                <p class="lead measure-lead mx-auto text-70"><?php echo $para2; ?></p>
            </div>


            <div class="row align-items-center">
                <?php
                $info = "SELECT * FROM services LIMIT 3";
                $exec_info = mysqli_query($conn, $info);
                while ($array_info = mysqli_fetch_array($exec_info)) {
                ?>

                    <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt pb-16pt pb-md-0">
                        <div class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                            <i class="material-icons text-white"><?php echo $array_info['icon']; ?></i>
                        </div>
                        <div class="flex">
                            <div class="card-title mb-4pt"><a <?php if(!empty($array_info['Content']) ){ ?> href="service.php?id=<?php echo $array_info['ID']; ?>" <?php } ?> ><?php echo $array_info['Name']; ?></a></div>
                            <p class="card-subtitle text-70"><?php echo $array_info['Description']; ?></p>
                        </div>
                    </div>

                <?php } ?>
            </div>

            <div class="row align-items-center">
                <?php
                $info = "SELECT * FROM services WHERE ID > 3 LIMIT 3";
                $exec_info = mysqli_query($conn, $info);
                while ($array_info = mysqli_fetch_array($exec_info)) {
                ?>

                    <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt pb-16pt pb-md-0">
                        <div class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                            <i class="material-icons text-white"><?php echo $array_info['icon']; ?></i>
                        </div>
                        <div class="flex">
                            <div class="card-title mb-4pt"><a <?php if(!empty($array_info['Content']) ){ ?> href="service.php?id=<?php echo $array_info['ID']; ?>" <?php } ?> ><?php echo $array_info['Name']; ?></a></div>
                            <p class="card-subtitle text-70"><?php echo $array_info['Description']; ?></p>
                        </div>
                    </div>

                <?php } ?>
            </div>



        </div>
    </div>

 <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="page-separator">
                            <div class="page-separator__text">Notre équipe</div>
                        </div>

                        <div class="row card-group-row">
                            
                            <?php
                            $req_forma = "SELECT * FROM team";
                            $exec_forma = mysqli_query($conn,$req_forma);
                            while($array_forma = mysqli_fetch_array($exec_forma)){
                            ?>

                            <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                     data-toggle="popover"
                                     data-trigger="click">

                                    <a
                                       class="card-img-top js-image"
                                       data-position=""
                                       data-height="140">
                                        <img src="./uploads/team/<?php echo $array_forma['image']; ?>"
                                             alt="course">
                                       
                                    </a>

                                    <div class="card-body flex">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title"
                                                   href="student-course.html"><?php echo $array_forma['name']; ?></a>
                                                <small class="text-50 font-weight-bold mb-4pt"><?php echo $array_forma['title']; ?></small>
                                            </div>
                                            
                                        </div>
                                      
                                    </div>
                                  
                                </div>
                                <div class="popoverContainer d-none">

                                    <p class="my-16pt text-70"><?php echo $array_forma['phrase']; ?></p>

                                   
                                </div>

                            </div>

                        <?php } ?>
                        </div>
                    </div>
                </div>
                
    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text" style="display: inline!important;font-size: 36px!important;">Categories des formations&nbsp;<strong style="color: #fad203;">En Direct</strong>
                </div>
            </div>

            <div class="row card-group-row">
                <?php

                $cat_req_dr = "SELECT * FROM category_live WHERE Parent !=0";
                $exec_cat_dr = mysqli_query($conn, $cat_req_dr);
                $check_cat_dr = mysqli_num_rows($exec_cat_dr);
                $array_vide = array();
                while ($array_li = mysqli_fetch_array($exec_cat_dr)) {

                    $count_req_l = "SELECT * FROM formations_live WHERE cat_id = " . $array_li['ID'] . " ";
                    $count_exec_l = mysqli_query($conn, $count_req_l);
                    $count_l = mysqli_num_rows($count_exec_l);

                    $array_vide[$array_li['ID']] = $count_l;
                }

                $new_arr = array();
                $p_coun_arr = count($array_vide);


                do {
                    $max = max($array_vide);
                    $key = array_search($max, $array_vide);
                    $new_arr[] = $key;
                    $array_vide[$key] = (-1);
                    $p_coun_arr--;
                } while ($p_coun_arr !== 0);


                $gbff = count($array_vide);
                if ($gbff >= 6) {
                    $i = 0;
                    for ($i = 0; $i <= 5; $i++) {
                        $req_cat_new = "SELECT * FROM category_live WHERE ID = " . $new_arr[$i] . " ";
                        $exec_cat_new = mysqli_query($conn, $req_cat_new);

                        $array_lii = mysqli_fetch_array($exec_cat_new);
                ?>
                        <div class="col-sm-4 card-group-row__col">

                            <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                                <div style="cursor: pointer;" class="card-body d-flex flex-column" onclick="location.href='direct.php?id_cat=<?php echo $array_lii['ID']; ?>';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="uploads/logo/formation-live-category.jpg" width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title"><?php echo $array_lii['Name']; ?></div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>
                                                            <?php
                                                            $count_req_l = "SELECT * FROM formations_live WHERE cat_id = " . $array_lii['ID'] . " ";
                                                            $count_exec_l = mysqli_query($conn, $count_req_l);
                                                            $count_l = mysqli_num_rows($count_exec_l);
                                                            echo $count_l;
                                                            ?>
                                                            formations</small></p>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>



                        </div>
                    <?php }
                } elseif (($gbff < 6) && ($gbff > 0)) {

                    $i = 0;
                    for ($i = 0; $i <= ($gbff - 1); $i++) {
                        $req_cat_new = "SELECT * FROM category_live WHERE ID = " . $new_arr[$i] . " ";
                        $exec_cat_new = mysqli_query($conn, $req_cat_new);

                        $array_lii = mysqli_fetch_array($exec_cat_new);
                    ?>
                        <div class="col-sm-4 card-group-row__col">

                            <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                                <div style="cursor: pointer;" class="card-body d-flex flex-column" onclick="location.href='direct.php?id_cat=<?php echo $array_lii['ID']; ?>';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="uploads/logo/formation-live-category.jpg" width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title"><?php echo $array_lii['Name']; ?></div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>
                                                            <?php
                                                            $count_req_l = "SELECT * FROM formations_live WHERE cat_id = " . $array_lii['ID'] . " ";
                                                            $count_exec_l = mysqli_query($conn, $count_req_l);
                                                            $count_l = mysqli_num_rows($count_exec_l);
                                                            echo $count_l;
                                                            ?>
                                                            formations</small></p>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>



                        </div>
                <?php }
                }

                ?>
            </div>


        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text" style="display: inline!important;font-size: 36px!important;">Categories des cours&nbsp;<strong style="color:#e1a038">E-learning</strong></div>
            </div>

            <div class="row card-group-row">
                <?php

                $cat_req_dr = "SELECT * FROM category WHERE Parent !=0";
                $exec_cat_dr = mysqli_query($conn, $cat_req_dr);
                $array_vide = array();
                while ($array_li = mysqli_fetch_array($exec_cat_dr)) {

                    $count_req_l = "SELECT * FROM cours WHERE cat_id = " . $array_li['ID'] . " ";
                    $count_exec_l = mysqli_query($conn, $count_req_l);
                    $count_l = mysqli_num_rows($count_exec_l);

                    $array_vide[$array_li['ID']] = $count_l;
                }

                $new_arr = array();
                $p_coun_arr = count($array_vide);


                do {
                    $max = max($array_vide);
                    $key = array_search($max, $array_vide);
                    $new_arr[] = $key;
                    $array_vide[$key] = (-1);
                    $p_coun_arr--;
                } while ($p_coun_arr !== 0);

                $gbff = count($array_vide);

                if ($gbff >= 6) {
                    $i = 0;
                    for ($i = 0; $i <= 5; $i++) {
                        $req_cat_new = "SELECT * FROM category WHERE ID = " . $new_arr[$i] . " ";
                        $exec_cat_new = mysqli_query($conn, $req_cat_new);

                        $array_lii = mysqli_fetch_array($exec_cat_new);
                ?>
                        <div class="col-sm-4 card-group-row__col">

                            <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                                <div style="cursor: pointer;" class="card-body d-flex flex-column" onclick="location.href='cours.php?id_cat=<?php echo $array_lii['ID']; ?>';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="uploads/logo/elearning-formation-ccategory.png" width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title"><?php echo $array_lii['Name']; ?></div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>
                                                            <?php
                                                            $count_req_l = "SELECT * FROM cours WHERE cat_id = " . $array_lii['ID'] . " ";
                                                            $count_exec_l = mysqli_query($conn, $count_req_l);
                                                            $count_l = mysqli_num_rows($count_exec_l);
                                                            echo $count_l;
                                                            ?>
                                                            formations</small></p>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>



                        </div>
                    <?php }
                } elseif (($gbff < 6) && ($gbff > 0)) {

                    $i = 0;
                    for ($i = 0; $i <= ($gbff - 1); $i++) {
                        $req_cat_new = "SELECT * FROM category WHERE ID = " . $new_arr[$i] . " ";
                        $exec_cat_new = mysqli_query($conn, $req_cat_new);

                        $array_lii = mysqli_fetch_array($exec_cat_new);
                    ?>
                        <div class="col-sm-4 card-group-row__col">

                            <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                                <div style="cursor: pointer;" class="card-body d-flex flex-column" onclick="location.href='cours.php?id_cat=<?php echo $array_lii['ID']; ?>';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img src="uploads/logo/elearning-formation-ccategory.png" width="40" height="40" alt="Angular" class="rounded">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title"><?php echo $array_lii['Name']; ?></div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>
                                                            <?php
                                                            $count_req_l = "SELECT * FROM cours WHERE cat_id = " . $array_lii['ID'] . " ";
                                                            $count_exec_l = mysqli_query($conn, $count_req_l);
                                                            $count_l = mysqli_num_rows($count_exec_l);
                                                            echo $count_l;
                                                            ?>
                                                            formations</small></p>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>



                        </div>
                <?php }
                }

                ?>
            </div>


        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text" style="display: inline!important;font-size: 36px!important;">Categories des&nbsp;<strong style="color:#18af9b">Packs Documentaires</strong></div>
            </div>

            <div class="row card-group-row">
                <?php

                $cat_req_dr = "SELECT * FROM categories_docs WHERE Parent !=0";
                $exec_cat_dr = mysqli_query($conn, $cat_req_dr);
                $array_vide = array();
                while ($array_li = mysqli_fetch_array($exec_cat_dr)) {

                    $count_req_l = "SELECT * FROM doc_formation WHERE Cat_ID = " . $array_li['ID'] . " ";
                    $count_exec_l = mysqli_query($conn, $count_req_l);
                    $count_l = mysqli_num_rows($count_exec_l);

                    $array_vide[$array_li['ID']] = $count_l;
                }

                $new_arr = array();
                $p_coun_arr = count($array_vide);


                do {
                    $max = max($array_vide);
                    $key = array_search($max, $array_vide);
                    $new_arr[] = $key;
                    $array_vide[$key] = (-1);
                    $p_coun_arr--;
                } while ($p_coun_arr !== 0);

                $gbff = count($array_vide);
                if ($gbff >= 6) {

                    $i = 0;
                    for ($i = 0; $i <= 5; $i++) {
                        $req_cat_new = "SELECT * FROM categories_docs WHERE ID = " . $new_arr[$i] . " ";
                        $exec_cat_new = mysqli_query($conn, $req_cat_new);

                        $array_lii = mysqli_fetch_array($exec_cat_new);
                ?>
                        <div class="col-sm-4 card-group-row__col">

                            <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                                <div style="cursor: pointer;" class="card-body d-flex flex-column" onclick="location.href='docs.php?id_cat=<?php echo $array_lii['ID']; ?>';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img style="border-radius: 50% !important;" src="uploads/logo/doc-logo-category.png" width="40" height="40" alt="Angular" class="rounded">

                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title"><?php echo $array_lii['Name']; ?></div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>
                                                            <?php
                                                            $count_req_l = "SELECT * FROM doc_formation WHERE Cat_ID = " . $array_lii['ID'] . " ";
                                                            $count_exec_l = mysqli_query($conn, $count_req_l);
                                                            $count_l = mysqli_num_rows($count_exec_l);
                                                            echo $count_l;
                                                            ?>
                                                            Packs</small></p>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>



                        </div>
                    <?php }
                } elseif (($gbff < 6) && ($gbff > 0)) {
                    $i = 0;
                    for ($i = 0; $i <= ($gbff - 1); $i++) {
                        $req_cat_new = "SELECT * FROM categories_docs WHERE ID = " . $new_arr[$i] . " ";
                        $exec_cat_new = mysqli_query($conn, $req_cat_new);

                        $array_lii = mysqli_fetch_array($exec_cat_new);
                    ?>
                        <div class="col-sm-4 card-group-row__col">

                            <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card" data-toggle="popover" data-trigger="click">

                                <div style="cursor: pointer;" class="card-body d-flex flex-column" onclick="location.href='docs.php?id_cat=<?php echo $array_lii['ID']; ?>';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded mr-12pt z-0 o-hidden">
                                                    <div class="overlay">
                                                        <img style="border-radius: 50% !important;" src="uploads/logo/doc-logo-category.png" width="40" height="40" alt="Angular" class="rounded">

                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="card-title"><?php echo $array_lii['Name']; ?></div>
                                                    <p class="flex text-50 lh-1 mb-0"><small>
                                                            <?php
                                                            $count_req_l = "SELECT * FROM doc_formation WHERE Cat_ID = " . $array_lii['ID'] . " ";
                                                            $count_exec_l = mysqli_query($conn, $count_req_l);
                                                            $count_l = mysqli_num_rows($count_exec_l);
                                                            echo $count_l;
                                                            ?>
                                                            Packs</small></p>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>



                        </div>
                <?php }
                } ?>
            </div>


        </div>
    </div>

    <div class="page-section border-bottom-2" id="blogs">
        <div class="container page__container">

            <div class="page-separator">
                <div class="page-separator__text">Nos blogs</div>
            </div>

            <div class="row card-group-row">
                <?php
                $query_blog = "SELECT * FROM `blog` ORDER BY ID DESC LIMIT 3";

                $exec_blog = mysqli_query($conn, $query_blog);

                while ($array_b = mysqli_fetch_array($exec_blog)) {

                ?>

                    <div class="col-md-6 col-lg-4 card-group-row__col">
                        <div class="card card--elevated posts-card-popular overlay card-group-row__card">
                            <img src="uploads/img_blog/<?php echo $array_b['Image']; ?>" alt="<?php echo $array_b['Titre']; ?>" class="card-img">
                            <div class="posts-card-popular__content">
                                <div class="card-body d-flex align-items-center">
                                    <div class="avatar-group flex">
                                        <?php
                                        $req_img = "SELECT * FROM users WHERE UserID = " . $array_b['Auth'];
                                        $exec_img = mysqli_query($conn, $req_img);
                                        $array_img = mysqli_fetch_array($exec_img);
                                        ?>
                                        <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="<?php echo $array_img['FullName']; ?>">
                                            <a><img src="uploads/avatars/<?php echo $array_img['Profile']; ?>" alt="Avatar" class="avatar-img rounded-circle"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="posts-card-popular__title card-body" style="text-shadow: 2px 2px black;background: rgba(0,0,0,0.5);">
                                    <a class="card-title" href="post.php?id=<?php echo $array_b['ID']; ?>"><?php echo $array_b['Titre']; ?></a>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php } ?>

            </div>
            <div>
                <a class="plus_yy btn btn-accent btn-block" style="color: white;" href="blogs.php">Tous nos Blogs</a>
            </div>
        </div>
    </div>
</div>
<style>


.marquee_text {
    font-size: 6rem;
    font-weight: bold;
    line-height: 7rem;

    transform: translateY(-50%);
}

</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>

    <section class="ftco-section" style="padding: 3em 0;" id="partenaires">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="heading-section mb-5">Partenaires</h2>
            </div>
            <div class="col-md-12" style="overflow:hidden">
                <div class="container">
<div class="marquee_text">
    <?php
                            $query8 = "SELECT * FROM `partners`";

                            $exec8 = mysqli_query($conn, $query8);

                            while ($array8 = mysqli_fetch_array($exec8)) {

                            ?>


                                <a href="#" class="">
                                    <img style="border: solid 1px white;padding:10px;width:auto;height:140px;" src="uploads/part/<?php echo $array8['Image']; ?>" alt="">
                                </a>




                            <?php } ?>
</div>

</div>
</div>
</div>
</div>
</section>
<script>
    // Start marquee
$('.marquee_text').marquee({
    direction: 'left',
    duration: 8000,
    gap: 50,
    delayBeforeStart: 0,
    duplicated: true,
    startVisible: true
});
</script>
<section class="ftco-section" style="padding: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="heading-section mb-5" id="temoignages">Témoignages</h2>
            </div>

        </div>
    </div>
</section>
<!-- Testimonial Area -->

<section class="testimonial_area">

    <div class="container">

        <div class="carousel slide ts_slider" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $req_feed = "SELECT * FROM feedback";
                $exec_feed = mysqli_query($conn, $req_feed);
                $i = 1;
                while ($array_feed = mysqli_fetch_array($exec_feed)) {
                ?>
                    <div class="carousel-item <?php if ($i == 1) {
                                                    echo "active";
                                                } ?>">
                        <img style="width: 100px;
    height: 100px;" src="uploads/team/<?php echo $array_feed['Image']; ?>" alt="" class="rounded-circle">
                        <h4><?php echo $array_feed['Name']; ?></h4>
                        <p style="font-size: 1.5em;color: rgba(0, 0, 0, 0.702); max-width: 770px; margin: 0 auto; padding-top: 40px; padding-bottom: 85px; position: relative;"><?php echo $array_feed['Text']; ?></p>
                    </div>
                <?php
                    $i++;
                } ?>
            </div>
            <a class="carousel-control-prev1" style="width: 50px;
    text-align: center;
    font-size: 33px;
    color: #fff;
    background: #3e54ff;
    height: 50px;
    line-height: 40%;
    padding: 9px;
    position: absolute;
    left: 0;
    border-radius: 50%;
    " href=".ts_slider" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next1" href=".ts_slider" style="width: 50px;
    text-align: center;
    font-size: 33px;
    color: #fff;
    background: #3e54ff;
    height: 50px;
    line-height: 40%;
    padding: 9px;
    position: absolute;
    right: 0;
    border-radius: 50%;" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</section>
<!-- End testimonial Area -->
<section class="ftco-section" style="padding: 3em 0;" id="clients">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="heading-section mb-5">Nos clients</h2>
            </div>
            <div class="col-md-12" style="overflow:hidden">
                 <div class="container">
<div class="marquee_text1">
    <?php
                            $query8 = "SELECT * FROM `clients_images`";

                            $exec8 = mysqli_query($conn, $query8);

                            while ($array8 = mysqli_fetch_array($exec8)) {

                            ?>


                                <a href="#" class="">
                                    <img style="border: solid 1px white;padding:10px;width:auto;height:140px;" src="uploads/clients_images/<?php echo $array8['Image']; ?>" alt="">
                                </a>




                            <?php } ?>
</div>

</div>
            </div>
        </div>
    </div>
</section>
<script>
    // Start marquee
$('.marquee_text1').marquee({
    direction: 'left',
    duration: 8000,
    gap: 50,
    delayBeforeStart: 0,
    duplicated: true,
    startVisible: true
});
</script>
<section class="comonSection noPadding" style="padding: 0px;position: relative;color:#fff;" id="contact">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 noPadding" style="padding: 0px;">
                <embed width="100%" height="730" src="https://maps.google.com/maps?q=Avenue Louis Braille, Tunis&amp;output=embed"></embed>


            </div>
            <div class="col-lg-6 noPadding" style="padding: 0px;">
                <div class="contacth2" style="width: 100%;position: relative;padding: 150px 40px;">
                    <div class="row">
                        <?php
                        if (isset($_POST['risela'])) {

$honeypot = FALSE;
if (!empty($_REQUEST['contact_me_by_fax_only']) && (bool) $_REQUEST['contact_me_by_fax_only'] == TRUE) {
    $honeypot = TRUE;
    log_spambot($_REQUEST);
    header("localtion : https://google.com/");
}else{

                            $nom = filter_var($_POST['esm'], FILTER_SANITIZE_STRING);
                            $prenom = filter_var($_POST['la9ab'], FILTER_SANITIZE_STRING);
                            $email = filter_var($_POST['3onwenek'], FILTER_SANITIZE_EMAIL);
                            $message = filter_var($_POST['risela'], FILTER_SANITIZE_STRING);
                            $tel = filter_var($_POST['wanwenek'], FILTER_SANITIZE_STRING);



                            $msg[] = '<div class="alert alert-success">Message bien envoyée</div>';

                            $req_about = "SELECT * FROM about ";
                            $exec_about = mysqli_query($conn, $req_about);
                            $array_about = mysqli_fetch_array($exec_about);


                             $to = $array_about['Email'];
                           //$to = "hawemiyassine1@gmail.com";

                            $subject = "Message depuis SmarTTec";

                            $from = $email;
                            $body = '<html><head> <meta charset="UTF-8"></head><body>';
                            $body .= '<p style="color:black;font-size:14px;">Bonjour,</p>';
                            $body .= "<p style='color:black;font-size:14px;'>Vous avez un message </p>
                      <p style='color:black;font-size:14px;'>De " . $nom . " " . $prenom . "</p>
                      <p style='color:black;font-size:14px;'>Message :</p>
                     <p style='color:#5567ff;font-size:20px;'>" . $message . "</p>";

                            $body .= "</body></html>";
                            
                            

                            $headers = "From: " . $nom . " " . $prenom . " <" . $from . "> \r\n";
                            $headers .= "Reply-To:" . $from . "\r\n";
                            $headers .= 'MIME-Version: 1.0' . "\r\n" .
                                'Content-type: text/html; ' . "\r\n" .

                                'X-Mailer: PHP/' . phpversion();

                            mail($to, $subject, $body, $headers);


                            foreach ($msg as $m) {
                                echo $m;
                            }
                        
                        $msg = "";
                     

                            //2- Récuperation des variables
                           /*  $fname = mysqli_real_escape_string($conn, $_POST['Nom']);
                            $lname = mysqli_real_escape_string($conn, $_POST['Prenom']);
                            $email = mysqli_real_escape_string($conn, $_POST['Email']);
                            $message = mysqli_real_escape_string($conn, $_POST['Message']);
                            $tel = mysqli_real_escape_string($conn, $_POST['Tel']); */
                            
                            $fname = filter_var($_POST['esm'], FILTER_SANITIZE_STRING);
                            $lname = filter_var($_POST['la9ab'], FILTER_SANITIZE_STRING);
                            $email = filter_var($_POST['3onwenek'], FILTER_SANITIZE_EMAIL);
                            $message = filter_var($_POST['risela'], FILTER_SANITIZE_STRING);
                            $tel = filter_var($_POST['wanwenek'], FILTER_SANITIZE_STRING);
                            $serv = filter_var($_POST['ser'], FILTER_SANITIZE_STRING);
                            
                            $time_now = date("Y-m-d"). " " . date("H:i");

                            $req = "INSERT INTO `contact` (`Nom`, `Prenom`, `Email`, `Message`, `Tel`, `Service`, `date`) VALUES('" . $fname . "','" . $lname . "','" . $email . "','" . $message . "','" . $tel . "','" . $serv . "','" . $time_now . "')";


                            $exec = mysqli_query($conn, $req);
                        }
                        }


                        ?>
                        <div class="col-lg-12">
                            <div class="sectionTitle text-center" style="width: 100%;position: relative;margin-bottom: 70px;">
                                <h2 style="margin: 0px;font-size: 36px;color: #23282f;text-transform: uppercase;font-weight: 900;line-height: .8;margin-bottom: 30px;font-family: Raleway;">ENTRER EN CONTACT</h2>
                                <p style="color: #777777;font-family: 'Lato', sans-serif;font-size: 15px;font-weight: 400;line-height: 26px;">N'hésitez pas à nous contacter.</p>
                            </div>
                        </div>
                        <form method="POST" action="index.php#contact" id="" class="conform3 recap wow zoomIn animated" data-wow-duration="700ms" data-wow-delay="300ms" style="visibility: visible; animation-duration: 700ms; animation-delay: 300ms; animation-name: zoomIn;margin: 0;padding: 0;">
                            <input type="checkbox" name="contact_me_by_fax_only" value="1" style="display:none !important" tabindex="-1" autocomplete="off">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" style="width: 100%;height: 47px;border: 1px solid #000000;background: none;border-radius: 0px;margin-bottom: 30px;color: #00000;font-size: 15px;letter-spacing: 1.65px;padding-left: 16px;font-family: Roboto Slab;font-weight: 400;" id="con_name" class="required" required name="esm" placeholder="NOM *">
                                    <input style="width: 100%;height: 47px;border: 1px solid #000000;background: none;border-radius: 0px;margin-bottom: 30px;color: #00000;font-size: 15px;letter-spacing: 1.65px;padding-left: 16px;font-family: Roboto Slab;font-weight: 400;" type="text" id="con_name" class="required" required name="la9ab" placeholder="PRÉNOM *">
                                    <input style="width: 100%;height: 47px;border: 1px solid #000000;background: none;border-radius: 0px;margin-bottom: 30px;color: #00000;font-size: 15px;letter-spacing: 1.65px;padding-left: 16px;font-family: Roboto Slab;font-weight: 400;" type="email" id="com_email" class="required" required name="3onwenek" placeholder="ADRESSE EMAIL *">
                                    <input style="width: 100%;height: 47px;border: 1px solid #000000;background: none;border-radius: 0px;margin-bottom: 30px;color: #00000;font-size: 15px;letter-spacing: 1.65px;padding-left: 16px;font-family: Roboto Slab;font-weight: 400;" type="text" id="con_sub" class="required" required name="wanwenek" placeholder="NUMERO DE TÉLEPHONE *">
                                    <select style="width: 100%;height: 47px;border: 1px solid #000000;background: none;border-radius: 0px;margin-bottom: 30px;color: #00000;font-size: 15px;letter-spacing: 1.65px;padding-left: 16px;font-family: Roboto Slab;font-weight: 400;" class="required" name="ser" required>
                                        <option value="">Selectionner un service</option>
                                        <?php $info = "SELECT * FROM services";
                                    $exec_info = mysqli_query($conn, $info);
                                    
                                    while ($array_info = mysqli_fetch_array($exec_info)) { ?>
                                    
                                        <option value="<?php echo filter_var($array_info['Name'],FILTER_SANITIZE_STRING); ?>"><?php echo $array_info['Name']; ?></option>
                                        <?php } ?>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <textarea style="width: 100%;height: 354px;border: 1px solid #000000;background: none;border-radius: 0px;margin-bottom: 30px;color: #00000;font-size: 15px;letter-spacing: 1.65px;padding-left: 16px;font-family: Roboto Slab;font-weight: 400;resize: none;padding: 8px 16px;" id="con_message" required class="required" name="risela" placeholder="VOTE MESSAGE *"></textarea>
                                </div>
                                <div style="margin-left: auto;margin-right: auto;margin-bottom:15px;" id="html_element"></div>
       
	   
                                    <br>
                                <div class="col-lg-12 text-center">
                                     
                                    <button type="submit" class="martin_btn hover_black" id="">
                                        <i style="line-height: 1;">Envoyez Un Message</i>
                                        <span style="top: -49.5px; left: 89.9531px;"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer> </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<!-- // END Header Layout Content -->

<?php include 'footer.php'; ?>