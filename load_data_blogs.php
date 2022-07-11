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
$sqlQuery = "SELECT * FROM blog  ORDER BY ID DESC LIMIT $startFrom, $perPage";
//echo $sqlQuery;
$result = mysqli_query($conn, $sqlQuery);
$paginationHtml = '';
while ($array = mysqli_fetch_assoc($result)) {

    $paginationHtml .= 
    '<div class="col-md-6 col-lg-4 card-group-row__col">
    <div class="card card--elevated posts-card-popular overlay card-group-row__card">
    <img src="uploads/img_blog/' . $array['Image'] . '" alt="' . $array['Titre'] . '" class="card-img">
        <div class="posts-card-popular__content">
            <div class="card-body d-flex align-items-center">
                <div class="avatar-group flex">
                    <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="SmarTTec">
                        <a href=""><img src="uploads/logo/black.svg" alt="Avatar" class="avatar-img rounded-circle"></a>
                    </div>
                </div>
            </div>
            <div class="posts-card-popular__title card-body" style="text-shadow: 2px 2px black;background: rgba(0,0,0,0.5);">
                <a class="card-title" href="post.php?id=' . $array['ID'] . '">' . $array['Titre'] . '</a>
            </div>
        </div>
    </div>
</div>';
}
$jsonData = array(
    "html"    => $paginationHtml,
);
echo json_encode($jsonData);
