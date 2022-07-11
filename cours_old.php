<?php

$pagetitle = "Cours E-learning";

include 'header.php'; ?>

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="d-flex flex-column align-items-center align-items-lg-start flex mb-16pt mb-lg-0 text-center text-lg-left">
                    <?php
                    if (isset($_GET['id_cat'])) {

                        $req_f_cat = "SELECT * FROM category WHERE ID = " . $_GET['id_cat'] . " ";
                        $exec_f_cat = mysqli_query($conn, $req_f_cat);
                        $array_f_cat = mysqli_fetch_array($exec_f_cat);

                    ?>
                        <h1 class="h2 mb-4pt"><?php echo $array_f_cat['Name']; ?></h1>
                        <div class="lead measure-lead text-70"><?php echo $array_f_cat['Description']; ?></div>


                    <?php
                    } else {
                    ?>
                        <h1 class="h2 mb-4pt">E-learning</h1>
                        <div class="lead measure-lead text-70">Parcourez des milliers de leçons.</div>

                    <?php } ?>
                </div>

                <form class="search-form form-control-rounded navbar-search d-lg-flex mr-16pt" action="" style="max-width: 230px">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                    <input type="text" class="form-control" name="search_in" placeholder="Search in  <?php
                                                                                                        if (isset($_GET['id_cat'])) {

                                                                                                            $req_f_cat = "SELECT * FROM category WHERE ID = " . $_GET['id_cat'] . " ";
                                                                                                            $exec_f_cat = mysqli_query($conn, $req_f_cat);
                                                                                                            $array_f_cat = mysqli_fetch_array($exec_f_cat);

                                                                                                            echo $array_f_cat['Name'];
                                                                                                        } else {
                                                                                                            echo "E-learning";
                                                                                                        } ?> ..." value="<?php
                                                                                                                            if (isset($_GET['search_in'])) {
                                                                                                                                echo $_GET['search_in'];
                                                                                                                            } ?>">


                    <?php if (isset($_GET['id_cat'])) { ?>
                        <input type="hidden" name="id_cat" value="<?php echo $_GET['id_cat']; ?>">
                    <?php } ?>
                </form>

                <div class="ml-lg-16pt">
                    <a href="#" data-target="#library-drawer" data-toggle="sidebar" class="btn btn-light">
                        <i class="material-icons icon--left">tune</i> Filters
                        <span class="badge badge-notifications badge-accent icon--right">10</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-12">

                    <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-24pt" style="white-space: nowrap;">
                        <div class="w-auto ml-sm-auto table d-flex align-items-center mb-2 mb-sm-0">

                        </div>

                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">Nos Cours</div>
                    </div>

                    <div class="row ">
                        <?php
                        $string_cat = "";
                        if (isset($_GET['id_cat'])) {
                            $string_cat = "AND cat_id = " . $_GET['id_cat'] . " ";
                        }
                        $string_search = "";
                        if (isset($_GET['search_in'])) {
                            $search_all = $_GET['search_in'];
                            $string_search =  " AND ( (`NAME_c` LIKE '%$search_all%') OR (`Desc_c` LIKE '%$search_all%') OR (`meta_keys` LIKE '%$search_all%') ) ";
                        }
                        $query = "SELECT * FROM `cours` WHERE 1=1 " . $string_cat . $string_search . " ORDER BY ID_c DESC ";

                        $exec = mysqli_query($conn, $query);

                        while ($array = mysqli_fetch_array($exec)) {

                        ?>
                            <div class="col-md-3 ">

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
                                                    <a class="card-title" href="enroll-cours.php?id_c=<?php echo $array['ID_c']; ?>"><?php echo $array['Name_c']; ?></a>
                                                    <small class="text-50 font-weight-bold mb-4pt">smarttec</small>
                                                </div>
                                                <span><?php echo $array['price']; ?> DT</span>
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
                                                <span class="text-50 small font-weight-bold">SmarTTec</span>
                                            </p>
                                        </div>
                                    </div>

                                    <p class="my-16pt text-70"><?php echo $array['Desc_c']; ?></p>



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
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>
                                        <div class="col text-right">
                                            <a href="enroll-cours.php?id_c=<?php echo $array['ID_c']; ?>" class="btn btn-primary">Aperçu le cours</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    $query = "SELECT * FROM `cours` WHERE 1=1 " . $string_cat . $string_search . "  ";

                    $exec = mysqli_query($conn, $query);
                    $check_vide = mysqli_num_rows($exec);
                    if ($check_vide == 0) {
                    ?>
                        <div class="_1o7LM">

                            <div style="margin: auto;">
                                <div style="text-align: center;">
                                    <img alt="" role="presentation" src="public/images/404.png" style="width: 300px;">
                                </div>
                                <div style="text-align: center;">
                                    <h2 class="JlgbC">Y'a pas de cours pour le moment</h2>
                                    <p class="Cxy4C">Nous n'avons trouvé aucun cours. <span>Vous pouvez rechercher un autre cours. <a style="color: blue;" href="cours.php"><strong>Clicker ici</strong></a></span></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    $query = "SELECT * FROM `cours` WHERE 1=1 " . $string_cat . $string_search . "  ";

                    $exec = mysqli_query($conn, $query);
                    $check_vide = mysqli_num_rows($exec);
                    if ($check_vide !== 0) {
                    ?>
                        <div class="mb-32pt">

                            <ul class="pagination justify-content-start pagination-xsm m-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                                        <span>Prev</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Page 1">
                                        <span>1</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Page 2">
                                        <span>2</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span>Next</span>
                                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                                    </a>
                                </li>
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
<!-- // END Header Layout Content -->

<?php include 'footer.php'; ?>