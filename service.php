<?php
$pagetitle = "conseils";
$service_rank = $_GET['id'];
include 'header.php';

$query = "SELECT * FROM `services` WHERE ID =  " . $_GET['id'] . " ";

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
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start flex mb-16pt mb-lg-0 text-center text-md-left">
                    <div class="avatar overlay overlay--primary mb-16pt mb-md-0 mr-md-16pt" style="margin-top: 14px;height: 80px;width: 100px;">
                        <div class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                            <i class="material-icons text-white"><?php echo $array['icon']; ?></i>
                        </div>

                    </div>
                    <div class="flex">
                        <h1 class="h2 measure-lead-max mb-16pt"><?php echo $array['Name']; ?></h1>


                    </div>
                </div>
                <div class="ml-lg-16pt">
                    <a href="index.php#services" class="btn btn-light">Services</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-12">

                    <?php echo $array['Content']; ?>



                    <div class="row mb-32pt">

                        <?php
                        if (!empty($array['img1'])) {

                        ?>

                            <div class="col-md-4">
                                <div style="margin: 5px;" class="rounded p-relative o-hidden overlay">
                                    <a class="image-popup-vertical-fit" href="uploads/img_blog/<?php echo $array['img1']; ?>" title="<?php echo $array['Name']; ?>">
                                        <img class="img-fluid rounded" src="uploads/img_blog/<?php echo $array['img1']; ?>" alt=" image">
                                    </a>
                                    <div class="overlay__content"></div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        if (!empty($array['img2'])) {

                        ?>

                            <div class="col-md-4">
                                <div style="margin: 5px;" class="rounded p-relative o-hidden overlay">
                                    <a class="image-popup-vertical-fit" href="uploads/img_blog/<?php echo $array['img2']; ?>" title="<?php echo $array['Name']; ?>">
                                        <img class="img-fluid rounded" src="uploads/img_blog/<?php echo $array['img2']; ?>" alt=" image">
                                    </a>
                                    <div class="overlay__content"></div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        if (!empty($array['img3'])) {

                        ?>

                            <div class="col-md-4">
                                <div style="margin: 5px;" class="rounded p-relative o-hidden overlay">
                                    <a class="image-popup-vertical-fit" href="uploads/img_blog/<?php echo $array['img3']; ?>" title="<?php echo $array['Name']; ?>">
                                        <img class="img-fluid rounded" src="uploads/img_blog/<?php echo $array['img3']; ?>" alt=" image">
                                    </a>
                                    <div class="overlay__content"></div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>



                </div>

            </div>

        </div>
    </div>

    <!-- Testimonial Area -->
    <?php
    $req_feed = "SELECT * FROM `feedback_services` WHERE  service_ID = " . $_GET['id'] . " ";
    $exec_feed = mysqli_query($conn, $req_feed);
    $check_star = mysqli_num_rows($exec_feed);
    if ($check_star !== 0) {
    ?>
        <section class="testimonial_area">

            <div class="container">

                <div class="carousel slide ts_slider" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php

                        $i = 1;
                        while ($array_feed = mysqli_fetch_array($exec_feed)) {
                        ?>
                            <div class="carousel-item <?php if ($i == 1) {
                                                            echo "active";
                                                        } ?>">
                                <img style="width: 100px;height: 100px;" src="uploads/team/<?php echo $array_feed['Image']; ?>" alt="" class="rounded-circle">
                                <h4><?php echo $array_feed['Name']; ?></h4>
                                <h5><?php echo $array_feed['Poste']; ?></h5>
                                <div style="width: max-content; margin: auto;">
                                    <div class="rating">
                                        <?php
                                        $long = strlen($array_feed['rating']);
                                        $st_3 = 0;
                                        if ($long == 1) {
                                            $st_1 = $array_feed['rating'];

                                            $st_2 = 5 - $array_feed['rating'];
                                        } else {

                                            $stars_c = explode('.', $array_feed['rating']);

                                            $st_1 = $stars_c[0];

                                            $st_2 = 5 - $stars_c[0] - 1;

                                            $st_3 = 1;
                                        }

                                        ?>
                                        <?php
                                        if ($st_1 !== 0) {
                                            for ($s = 1; $s <= $st_1; $s++) {
                                        ?>
                                                <span class="rating__item"><span class="material-icons">star</span></span>


                                        <?php }
                                        } ?>
                                        <?php
                                        if ($st_3 !== 0) {

                                        ?>
                                            <span class="rating__item"><span class="material-icons">star_half</span></span>

                                        <?php } ?>


                                        <?php
                                        if ($st_2 !== 0) {
                                            for ($s = 1; $s <= $st_2; $s++) {
                                        ?>
                                                <span class="rating__item"><span class="material-icons">star_border</span></span>

                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                                <p style="font-size: 1.5em;color: rgba(0, 0, 0, 0.702); max-width: 770px; margin: 0 auto; padding-top: 40px; padding-bottom: 85px; position: relative;"><?php echo $array_feed['Text']; ?></p>
                            </div>
                        <?php
                            $i++;
                        } ?>
                    </div>
                    <a class="carousel-control-prev1" style="width: 50px;text-align: center;font-size: 33px;color: #fff;background: #3e54ff;height: 50px;line-height: 40%;padding: 9px;position: absolute;left: 0;border-radius: 50%;" href=".ts_slider" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next1" href=".ts_slider" style="width: 50px;text-align: center;font-size: 33px;color: #fff;background: #3e54ff;height: 50px;line-height: 40%;padding: 9px;position: absolute;right: 0;border-radius: 50%;" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </section>
        <!-- End testimonial Area -->

    <?php } ?>
</div>

<!-- // END Header Layout Content -->
<?php include 'footer.php'; ?>