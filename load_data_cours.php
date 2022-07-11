<?php
include 'connexion.php';
$perPage = 8;
$page = 0;
if (isset($_POST['page'])) {
    $page  = $_POST['page'];
} else {
    $page = 1;
};
$startFrom = ($page - 1) * $perPage;
$string_cat = "";
if (isset($_GET['id_cat'])) {
    $string_cat = "AND cat_id = " . $_GET['id_cat'] . " ";
}
$string_search = "";
if (isset($_GET['search_in'])) {
    $search_all = $_GET['search_in'];
    $string_search =  " AND ( (`Name_c` LIKE '%$search_all%') OR (`Desc_c` LIKE '%$search_all%') OR (`meta_keys` LIKE '%$search_all%') ) ";
}
$sqlQuery = "SELECT * FROM cours WHERE 1=1 " . $string_cat . $string_search . " ORDER BY ID_c DESC LIMIT $startFrom, $perPage";
//echo $sqlQuery;
$result = mysqli_query($conn, $sqlQuery);
$paginationHtml = '';
while ($array = mysqli_fetch_assoc($result)) {

    $paginationHtml .= '<div class="col-md-3 ">
                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card" data-partial-height="44" data-toggle="popover" data-trigger="click">';

    $paginationHtml .= '<a href="enroll-cours.php?id_c=' . $array['ID_c'] . '" class="js-image" data-position="" ';

    $paginationHtml .= 'style="';
    $paginationHtml .= 'display: block; position: relative; overflow: hidden; ';
    $paginationHtml .= "background-image: url('uploads/cours/img/" . $array['Image'] . "'); background-size: cover; background-position: center center; height: 110px; ";
    $paginationHtml .= '"';


    $paginationHtml .= '>
                                        
                                        <span class="overlay__content align-items-start justify-content-start">
                                            <span class="overlay__action card-body d-flex align-items-center">
                                                <i class="material-icons mr-4pt">play_circle_outline</i>
                                                <span class="card-title text-white">Aperçu</span>
                                            </span>
                                        </span>
                                    </a>';

    $paginationHtml .= '<div class="mdk-reveal__content">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title" href="enroll-cours.php?id_c=' . $array['ID_c'] . '">' . $array['Name_c'] . '</a>
                                                    <small class="text-50 font-weight-bold mb-4pt">smarttec</small>
                                                </div>';

    $paginationHtml .= '<span class="box bounce-1">' . $array['price'] . ' $</span>
                                                
                                            </div>';
    $req_rev = "SELECT * FROM review_table WHERE cours_ID = " . $array['ID_c'] . " AND Type_c = 'E-learning' ";
    $exec_rev = mysqli_query($conn, $req_rev);
    $count_rev = mysqli_num_rows($exec_rev);
    if ($count_rev !== 0) {
        $total = 0;
        while ($c_total = mysqli_fetch_array($exec_rev)) {
            $total = $total + $c_total['user_rating'];
        }
        $moyen_t = $total / $count_rev;

        $st_1 = floor($moyen_t);
        $st_2 = 5 - $st_1;
        $paginationHtml .= ' <div class="d-flex">
                                           <div class="rating flex">';

        if ($st_1 !== 0) {
            for ($s = 1; $s <= $st_1; $s++) {
                $paginationHtml .= '    <span class="rating__item"><span class="material-icons">star</span></span>';
            }
        }
        if ($st_2 !== 0) {
            for ($s = 1; $s <= $st_2; $s++) {
                $paginationHtml .= '      <span class="rating__item"><span class="material-icons">star_border</span></span>';
            }
        }
        $paginationHtml .= '</div>   <small class="text-50">' . $st_1 . '/5</small></div>';
    }







    $paginationHtml .= '<small class="text-50">';



    $req_v = "SELECT * FROM `lesson` WHERE cours_id = " . $array['ID_c'] . " ";
    $exec_v = mysqli_query($conn, $req_v);
    $hours = 0;
    while ($array_v = mysqli_fetch_array($exec_v)) {
        $hours = $hours + $array_v['duration'];
    }
    $paginationHtml .= ceil($hours / 60);

    $paginationHtml .= ' heures</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">';

    $paginationHtml .= '<img src="uploads/cours/img/' . $array['Image'] . '" width="40" height="40" alt="Angular" class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">' . $array['Name_c'] . '</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">by</span>
                                                <span class="text-50 small font-weight-bold">SmarTTec</span>
                                            </p>
                                        </div>
                                    </div>';

    $paginationHtml .= '<p class="my-16pt text-70">' . $array['Desc_c'] . '</p>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>';

    $req_v = "SELECT * FROM `lesson` WHERE cours_id = " . $array['ID_c'] . " ";
    $exec_v = mysqli_query($conn, $req_v);
    $hours = 0;
    while ($array_v = mysqli_fetch_array($exec_v)) {
        $hours = $hours + $array_v['duration'];
    }
    $paginationHtml .=  ceil($hours / 60);


    $paginationHtml .= '	heures</small></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-4pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>';

    $paginationHtml .= '    <p class="flex text-50 lh-1 mb-0"><small>';

    $req_l = "SELECT * FROM `lesson` WHERE cours_id = " . $array['ID_c'] . " ";
    $exec_l = mysqli_query($conn, $req_l);
    $lessons = mysqli_num_rows($exec_l);
    $paginationHtml .= $lessons;
    $paginationHtml .= ' lessons</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>';
    $paginationHtml .= '<div class="col text-right">
                                            <a href="enroll-cours.php?id_c=' . $array['ID_c'] . '" class="btn btn-primary">Aperçu le cours</a>
                                        </div>
                                    </div>

                                </div>

                            </div>';
}
$jsonData = array(
    "html"    => $paginationHtml,
);
echo json_encode($jsonData);
