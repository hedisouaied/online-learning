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
    $string_search =  " AND ( (`Name_f` LIKE '%$search_all%') OR (`Desc_f` LIKE '%$search_all%') OR (`meta_keys` LIKE '%$search_all%') ) ";
}
$sqlQuery = "SELECT * FROM formations_live WHERE 1=1 " . $string_cat . $string_search . " ORDER BY ordre_f LIMIT $startFrom, $perPage";
//echo $sqlQuery;
$result = mysqli_query($conn, $sqlQuery);
$paginationHtml = '';
while ($array = mysqli_fetch_assoc($result)) {

    $paginationHtml .= '<div class="col-md-3 ">
                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card" data-partial-height="44" data-toggle="popover" data-trigger="click">';

    $paginationHtml .= '<a href="enroll-direct.php?id_l=' . $array['ID_f'] . '" class="js-image" data-position="" ';

    $paginationHtml .= 'style="';
    $paginationHtml .= 'display: block; position: relative; overflow: hidden; ';
    $paginationHtml .= "background-image: url('uploads/formations/img/" . $array['Image'] . "'); background-size: cover; background-position: center center; height: 110px; ";
    $paginationHtml .= '"';


    $paginationHtml .= '></a>';

    $paginationHtml .= '<div class="mdk-reveal__content">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title" href="enroll-direct.php?id_l=' . $array['ID_f'] . '">' . $array['Name_f'] . '</a>
                                                    <small class="text-50 font-weight-bold mb-4pt">smarttec</small>
                                                </div>';

    $paginationHtml .= '<span class="box bounce-1">' . $array['price'] . ' $</span>
                                                <a href="enroll-direct.php?id_l=' . $array['ID_f'] . '" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                            </div>';
    $req_rev = "SELECT * FROM review_table WHERE cours_ID = " . $array['ID_f'] . " AND Type_c = 'Direct' ";
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



    $paginationHtml .= '               </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">';

    $paginationHtml .= '<img src="uploads/formations/img/' . $array['Image'] . '" width="40" height="40" alt="Angular" class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">' . $array['Name_f'] . '</div>
                                            <p class="lh-1 mb-0">
                                                <span class="text-50 small">by</span>
                                                <span class="text-50 small font-weight-bold">SmarTTec</span>
                                            </p>
                                        </div>
                                    </div>';

    $paginationHtml .= '<p class="my-16pt text-70">' . $array['Desc_f'] . '</p>
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center mb-4pt">
                                                ';

    $paginationHtml .= '</div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                            </div>
                                        </div>';
    $paginationHtml .= '<div class="col text-right">
                                            <a href="enroll-direct.php?id_l=' . $array['ID_f'] . '" class="btn btn-primary">Aperçu le cours</a>
                                        </div>
                                    </div>

                                </div>

                            </div>';
}
$jsonData = array(
    "html"    => $paginationHtml,
);
echo json_encode($jsonData);
