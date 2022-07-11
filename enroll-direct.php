<?php
ob_start();
$enroll = "Direct";
$pagetitle = "Calendrier des Formation en Direct";

include 'header.php';
$query = "SELECT * FROM `formations_live` WHERE ID_f =  " . $_GET['id_l'] . " ";

$exec = mysqli_query($conn, $query);
$check = mysqli_num_rows($exec);
if ($check == 0) {
    header("location:index.php");
}
$array = mysqli_fetch_array($exec);

?>
<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                    <div class="avatar avatar mb-16pt mb-md-0 mr-md-16pt">
                        <img src="uploads/formations/img/<?php echo $array['Image']; ?>" class="avatar-img rounded" alt="lesson">
                    </div>
                    <div class="flex">
                        <h1 class="h2 m-0"><?php echo $array['Name_f']; ?></h1>
                        <div class="rating mb-8pt d-inline-flex">
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star</i></div>
                            <div class="rating__item"><i class="material-icons">star_border</i></div>
                        </div>
                    </div>
                </div>
                <div class="ml-lg-16pt">
                    <a href="direct.php" class="btn btn-light">Tous les cours</a>
                </div>
            </div>

        </div>
    </div>
    <!-- Calendar Start  -->

    <!-- Calendar End  -->
    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="row">
                <div class="col-lg-12" style="height: fit-content;">
                    <div class="row">
                        <div class="col-md-6">
                            <video class="player__embed d-none" id="example" poster="uploads/formations/img/<?php echo $array['Image']; ?>">
                                <source src="uploads/formations/video/<?php echo $array['video']; ?>" type="video/mp4">
                                <track kind="captions" label="Portuguese" srclang="pt" src="<<path-to-caption.vtt>>">
                                <track kind="captions" label="English" srclang="en" src="<<path-to-caption.vtt>>">
                                Your browser does not support the video tag.
                            </video>


                            <div class="row mb-32pt" style="margin-top: 15px;">
                                <div class="col-md-12">
                                    <div class="page-separator">
                                        <div class="page-separator__text">À propos de ce cours</div>
                                    </div>
                                    <p class="text-70"><?php echo $array['Desc_f']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content">
                                <div id="wrapper">
                                    <div class="main-content">
                                        <div class="row small-spacing">



                                            <h2 align="center"><a>Calendrier Des Formations en Direct</a></h2>

                                            <div class="container">
                                                <div id="calendar"></div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">

                            <!-- rating start -->

                            <div class="container">
                                <div class="page-separator">
                                    <div class="page-separator__text">Avis de nos clients</div>
                                </div>
                                <div class="card">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4 text-center">
                                                <h1 class="text-warning mt-4 mb-4">
                                                    <b><span id="average_rating">0.0</span> / 5</b>
                                                </h1>
                                                <div class="mb-3">
                                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                                </div>
                                                <h3><span id="total_review">0</span> Review</h3>
                                            </div>

                                            <?php
                                            if (isset($_SESSION['client'])) {
                                                $exec_b_rr = 1;
                                                $check_b_rr = 1;
                                                $req_di = "SELECT * FROM events WHERE ID_f = " . $_GET['id_l'];
                                                $exec_di = mysqli_query($conn, $req_di);
                                                $check_di = mysqli_num_rows($exec_di);
                                                $variable = "";
                                                if ($check_di != 0) {
                                                    $ids_f = "(";
                                                    while ($array_di = mysqli_fetch_array($exec_di)) {
                                                        $ids_f .= $array_di['id'] . ",";
                                                    }
                                                    $ids_f .= "0)";

                                                    $variable = " ID_p IN " . $ids_f . " AND ";

                                                    $req_b_r = "SELECT  * FROM checkout WHERE " . $variable . " type_p = 'Direct' AND ID_sess = " . $_SESSION['id'] . " AND Paid = 1 ";
                                                    $exec_b_r = mysqli_query($conn, $req_b_r);
                                                    $check_b_r = mysqli_num_rows($exec_b_r);
                                                    $req_b_rr = "SELECT  * FROM review_table WHERE cours_ID = " . $_GET['id_l'] . " AND Type_c = 'Direct' AND user_ID = " . $_SESSION['id'] . " ";
                                                    $exec_b_rr = mysqli_query($conn, $req_b_rr);
                                                    $check_b_rr = mysqli_num_rows($exec_b_rr);
                                                }
                                            }
                                            ?>

                                            <div class="col-sm-<?php
                                                                if (($check_b_r > 0) && ($check_b_rr == 0)) {
                                                                    echo "4";
                                                                } else {
                                                                    echo "8";
                                                                }
                                                                ?>">
                                                <p>
                                                <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                                <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                                </div>

                                                </p>
                                                <p>
                                                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                                <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                                </div>
                                                </p>
                                                <p>
                                                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                                <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                                </div>
                                                </p>
                                                <p>
                                                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                                <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                                </div>
                                                </p>
                                                <p>
                                                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                                <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                                </div>
                                                </p>
                                            </div>
                                            <?php
                                            if (($check_b_r > 0) && ($check_b_rr == 0)) {
                                            ?>
                                                <div class="col-sm-4 text-center">
                                                    <h3 class="mt-4 mb-3">Donnez Votre Avis</h3>
                                                    <button type="button" name="add_review" id="add_review" class="btn btn-primary">Avis</button>
                                                </div>
                                            <?php } ?>


                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5" id="review_content"></div>
                            </div>
                            <div style="z-index: 1;" id="review_modal" class="modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document" style="margin:6.75rem auto;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Submit Review</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="text-center mt-2 mb-4">
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                                            </h4>
                                            <div class="form-group">
                                                <input type="hidden" name="user_name" id="user_name" class="form-control" value="<?php echo $_SESSION['name']; ?>" />
                                            </div>
                                            <div class="form-group">
                                                <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                                            </div>
                                            <div class="form-group text-center mt-4">
                                                <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .progress-label-left {
                                    float: left;
                                    margin-right: 0.5em;
                                    line-height: 1em;
                                }

                                .progress-label-right {
                                    float: right;
                                    margin-left: 0.3em;
                                    line-height: 1em;
                                }

                                .star-light {
                                    color: #e9ecef;
                                }

                                .modal-backdrop.show {
                                    opacity: 0;
                                    z-index: -1;
                                }
                            </style>


                            <!-- rating end -->

                        </div>
                    </div>




                </div>
            </div>

        </div>
    </div>

</div>
<!-- // END Header Layout Content -->
<?php include 'footer.php'; ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var demo = new Moovie({
            selector: "#example",
            dimensions: {
                width: "100%"
            }
        });
    });
</script>
<?php ob_end_flush(); ?>