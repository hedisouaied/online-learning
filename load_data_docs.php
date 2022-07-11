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
    $string_cat = "AND Cat_ID = " . $_GET['id_cat'] . " ";
}
$string_search = "";
if (isset($_GET['search_in'])) {
    $search_all = $_GET['search_in'];
    $string_search =  " AND ( (`Name` LIKE '%$search_all%') OR (`Description` LIKE '%$search_all%')) ";
}
$sqlQuery = "SELECT * FROM doc_formation WHERE 1=1 " . $string_cat . $string_search . " ORDER BY ID DESC LIMIT $startFrom, $perPage";
//echo $sqlQuery;
$result = mysqli_query($conn, $sqlQuery);
$paginationHtml = '';
while ($array = mysqli_fetch_assoc($result)) {

    $paginationHtml .= '<div class="col-md-3 ">
                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card" data-partial-height="44" data-toggle="popover" data-trigger="click">';

    $paginationHtml .= '<a href="enroll-doc.php?id_c=' . $array['ID'] . '" class="js-image" data-position="" ';

    $paginationHtml .= 'style="';
    $paginationHtml .= 'display: block; position: relative; overflow: hidden; ';
    $paginationHtml .= "background-image: url('uploads/formations/" . $array['Image'] . "'); background-size: cover; background-position: center center; height: 110px; ";
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
                                                    <a class="card-title" href="enroll-doc.php?id_c=' . $array['ID'] . '">' . $array['Name'] . '</a>
                                                    <small class="text-50 font-weight-bold mb-4pt">smarttec</small>
                                                </div>';

    $paginationHtml .= '<span class="box bounce-1">' . $array['Price'] . ' $</span>
                                                
                                            </div>';
    $req_rev = "SELECT * FROM review_table WHERE cours_ID = " . $array['ID'] . " AND Type_c = 'Téléchargements' ";
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





    $paginationHtml .= '
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    ';

    $paginationHtml .= '
                                    <div class="row align-items-center">
                                        ';
    $paginationHtml .= '
                                    </div>

                                </div>

                            </div>';
}
$jsonData = array(
    "html"    => $paginationHtml,
);
echo json_encode($jsonData);
