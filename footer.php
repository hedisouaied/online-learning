<!-- Footer -->


<div class="bg-dark border-top-2 mt-auto" style="background-color: #003250!important;">
    <div class="container page__container page-section d-flex flex-column">
        <div class="row">
            <div class="col-md-9">
                <p class="text-white-70 brand mb-24pt">
                    <img class="brand-icon" src="public/images/logo/white-100@2x.svg" width="30" alt="smarttec"> SmarTTec
                </p>
                <p class="measure-lead-max text-white-50 small mr-8pt" style="font-size: 1rem!important;color: #f5f5dc!important"><?php echo $array_about['Text']; ?></p>
                <div>

                    <a href="mailto:<?php echo $array_about['Email']; ?>">
                        <p class="measure-lead-max text-white-50 small mr-8pt" style="font-size: 1rem!important;color: #f5f5dc!important"><i class="fa fa-envelope mr-1"></i><?php echo $array_about['Email']; ?></p>
                    </a>
                </div>

                <p class="measure-lead-max text-white-50 small mr-8pt" style="font-size: 1rem!important;color: #f5f5dc!important"><?php echo $array_about['Addres']; ?></p>
                <a href="tel:<?php echo $array_about['Phone']; ?>">
                    <p class="measure-lead-max text-white-50 small mr-8pt" style="font-size: 1rem!important;color: #f5f5dc!important"><?php echo $array_about['Phone']; ?></p>
                </a>
                <!--<p class="mb-8pt d-flex">
                    <a href="" class="text-white-70 text-underline mr-8pt small">Terms</a>
                    <a href="" class="text-white-70 text-underline small">Privacy policy</a>
                </p>-->

            </div>
            <div class='col-md-3'>
                <p class="text-white-70 brand mb-24pt">
                    Plan du site
                </p>
                <ul class="list-unstyled footer-list">

                    <li style="margin-bottom: 10px;"><a href="index.php" class='text-white-70' style="font-size: 1.3em;color: #f5f5dc!important"><i class="fa fa-chevron-right mr-1"></i> Accueil</a></li>
                    <li style="margin-bottom: 10px;"><a href="about-us.php" class='text-white-70' style="font-size: 1.3em;color: #f5f5dc!important"><i class="fa fa-chevron-right mr-1"></i> À propos</a></li>
                    <li style="margin-bottom: 10px;"><a href="cours.php" class='text-white-70' style="font-size: 1.3em;color: #f5f5dc!important"><i class="fa fa-chevron-right mr-1"></i> E-learning</a></li>
                    <li style="margin-bottom: 10px;"><a href="docs.php" class='text-white-70' style="font-size: 1.3em;color: #f5f5dc!important"><i class="fa fa-chevron-right mr-1"></i> Nos packs</a></li>
                    <li style="margin-bottom: 10px;"><a href="direct.php" class='text-white-70' style="font-size: 1.3em;color: #f5f5dc!important"><i class="fa fa-chevron-right mr-1"></i> En direct</a></li>

                </ul>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

                <p class="text-white-50 small mt-n1 mb-0"><a target="_blank" style="color: #f5f5dc!important;" class="text-white-50 small mt-n1 mb-0" href="https://tounesconnect.com/">© TOUNESCONNECT - © COPYRIGHT - TOUS DROITS RÉSERVÉS</a></p>
            </div>
            <div class='col-md-6 iconssocial'>
                <div class="top_bar_social copyrightSocial wow zoomIn animated" data-wow-duration="700ms" data-wow-delay="350ms" style="visibility: visible; animation-duration: 700ms; animation-delay: 350ms; animation-name: zoomIn;text-align: right;
    position: relative;color:white;padding-right: 17px;">
                    <a class="fac" href="https://www.facebook.com/SMART.TRAINING.ENGINEERING.CONSULTING" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="twi" href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="dri" target="_blank"> <i class="fab fa-instagram"></i></a>
                    <a class="lin" href="https://tn.linkedin.com/in/smarttec-tunisie-42a0b31a3" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a class="goo" href="https://www.youtube.com/channel/UCzqNmKXVZea2Y0Q9H9BVXCQ" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- // END Footer -->

</div>
<!-- // END Header Layout -->

<!-- Drawer -->

<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-light-dodger-blue sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <a href="index.php" class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="public/images/illustration/student/128/white.svg" alt="Luma"> -->

                <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                    <span style="background: white!important;" class="avatar-title rounded bg-primary"><img src="uploads/logo/black.svg" class="img-fluid" alt="logo" /></span>

                </span>

                <span>SmarTTec</span>
            </a>
            <div class="d-flex align-items-center mb-24pt  d-lg-none">
                <form action="index.php#target_search" class="search-form search-form--light mx-16pt pr-0 pl-16pt">
                    <input type="text" class="form-control pl-0" name="search_all" placeholder="Search">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                </form>
            </div>
            <div class="sidebar-heading">Barre de Navigation</div>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="index.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Accueil</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="about-us.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">info</span>
                        <span class="sidebar-menu-text">À propos</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="cours.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_library</span>
                        <span class="sidebar-menu-text">E-learning</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="direct.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">import_contacts</span>
                        <span class="sidebar-menu-text">Formations</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="docs.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">style</span>
                        <span class="sidebar-menu-text">Nos packs</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a style="cursor: pointer;" class="sidebar-menu-button" data-toggle="modal" data-target="#exampleModal">
                        <span class="sidebar-menu-icon sidebar-menu-icon--left fa fa-trophy "></span>
                        <span class="sidebar-menu-text">Certificats</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button disable_sidebar" href="index.php#contact">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">mail</span>
                        <span class="sidebar-menu-text">Contact</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button disable_sidebar" href="index.php#services">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">work</span>
                        <span class="sidebar-menu-text">Services</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button disable_sidebar" href="index.php#partenaires">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">accessibility</span>
                        <span class="sidebar-menu-text">Partenaires</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button disable_sidebar" href="index.php#temoignages">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">feedback</span>
                        <span class="sidebar-menu-text">Temoignages</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button disable_sidebar" href="index.php#clients">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">supervised_user_circle</span>
                        <span class="sidebar-menu-text">Clients</span>
                    </a>
                </li>
                <li class="sidebar-menu-item active">
                    <a class="sidebar-menu-button" href="blogs.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">line_weight</span>
                        <span class="sidebar-menu-text">Blogs</span>
                    </a>
                </li>

            </ul>
            <!-- // END Sidebar Content -->

        </div>
    </div>
</div>

<!-- // END Drawer -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vérifier le certificat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="verification.php" method="GET">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nom & Prénom</label>
                        <input class="form-control" placeholder="Nom & Prénom" required name="prenom" type="text" />
                    </div>
                    <div class="form-group">
                        <label>code</label>
                        <input class="form-control" required placeholder="Code de certificat" name="code" type="text" />
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                    <button type="submit" name="verify" class="btn btn-primary">vérifier</button>

                </div>
            </form>

        </div>
    </div>
</div>
<!-- // FILTER BY CATEGORY -->
<?php
if (isset($pagetitle) && ($pagetitle == "Cours E-learning")) {

?>
    <div class="mdk-drawer js-mdk-drawer " id="library-drawer" data-align="end">
        <div class="mdk-drawer__content" style="width: 318px;">
            <div class="sidebar sidebar-light sidebar-right py-16pt" data-perfect-scrollbar data-perfect-scrollbar-wheel-propagation="true">

                <div class="d-flex align-items-center mb-24pt  d-lg-none">
                    <form action="index.php#target_search" class="search-form search-form--light mx-16pt pr-0 pl-16pt">
                        <input type="text" class="form-control pl-0" name="search_all" placeholder="Search">
                        <button class="btn" type="submit"><i class="material-icons">search</i></button>
                    </form>
                </div>

                <div class="sidebar-heading">Category</div>
                <ul class="sidebar-menu">

                    <?php
                    $cat_query = "SELECT * FROM category WHERE Parent = 0";
                    $cat_exec = mysqli_query($conn, $cat_query);
                    while ($array_g = mysqli_fetch_array($cat_exec)) {
                    ?>
                        <li class="sidebar-menu-item active">
                            <a class="sidebar-menu-button" style="color: #ed0b4c;">
                                <span class="<?php echo $array_g['icon']; ?> sidebar-menu-icon sidebar-menu-icon--left" style="color: #ed0b4c;"></span>
                                <span class="sidebar-menu-text"><?php echo $array_g['Name']; ?></span>
                            </a>
                        </li>
                        <?php
                        $cat_query1 = "SELECT * FROM category WHERE Parent = " . $array_g['ID'];
                        $cat_exec1 = mysqli_query($conn, $cat_query1);
                        while ($array_g1 = mysqli_fetch_array($cat_exec1)) {
                        ?>
                            <li class="sidebar-menu-item">
                                <a href="cours.php?id_cat=<?php echo $array_g1['ID'];
                                                            if (isset($_GET['search_in'])) {
                                                                echo "&search_in=" . $_GET['search_in'];
                                                            } ?>" class="sidebar-menu-button">
                                    <span class="<?php echo $array_g1['icon']; ?> sidebar-menu-icon sidebar-menu-icon--left"></span>
                                    <span class="sidebar-menu-text"><?php echo $array_g1['Name']; ?></span>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>



            </div>
        </div>
    </div>

<?php
}
?>
<!-- // FILTER BY CATEGORY -->
<?php
if (isset($pagetitle) && ($pagetitle == "Packs Documents")) {

?>
    <div class="mdk-drawer js-mdk-drawer " id="library-drawer" data-align="end">
        <div class="mdk-drawer__content" style="width: 318px;">
            <div class="sidebar sidebar-light sidebar-right py-16pt" data-perfect-scrollbar data-perfect-scrollbar-wheel-propagation="true">

                <div class="d-flex align-items-center mb-24pt  d-lg-none">
                    <form action="index.php#target_search" class="search-form search-form--light mx-16pt pr-0 pl-16pt">
                        <input type="text" class="form-control pl-0" name="search_all" placeholder="Search">
                        <button class="btn" type="submit"><i class="material-icons">search</i></button>
                    </form>
                </div>

                <div class="sidebar-heading">Category</div>
                <ul class="sidebar-menu">

                    <?php
                    $cat_query = "SELECT * FROM categories_docs WHERE Parent = 0";
                    $cat_exec = mysqli_query($conn, $cat_query);
                    while ($array_g = mysqli_fetch_array($cat_exec)) {
                    ?>
                        <li class="sidebar-menu-item active" style="color: #ed0b4c;">
                            <a class="sidebar-menu-button">
                                <span class="<?php echo $array_g['icon']; ?> sidebar-menu-icon sidebar-menu-icon--left" style="color: #ed0b4c;></span>
                                <span class="sidebar-menu-text"><?php echo $array_g['Name']; ?></span>
                            </a>
                        </li>
                        <?php
                        $cat_query1 = "SELECT * FROM categories_docs WHERE Parent = " . $array_g['ID'];
                        $cat_exec1 = mysqli_query($conn, $cat_query1);
                        while ($array_g1 = mysqli_fetch_array($cat_exec1)) {
                        ?>
                            <li class="sidebar-menu-item">
                                <a href="docs.php?id_cat=<?php echo $array_g1['ID'];
                                                            if (isset($_GET['search_in'])) {
                                                                echo "&search_in=" . $_GET['search_in'];
                                                            } ?>" class="sidebar-menu-button">
                                    <span class="<?php echo $array_g1['icon']; ?> sidebar-menu-icon sidebar-menu-icon--left"></span>
                                    <span class="sidebar-menu-text"><?php echo $array_g1['Name']; ?></span>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>



            </div>
        </div>
    </div>

<?php
}
?>
<!-- // FILTER BY CATEGORY -->
<?php
if (isset($pagetitle) && ($pagetitle == "Formation en Direct")) {

?>
    <div class="mdk-drawer js-mdk-drawer " id="library-drawer" data-align="end">
        <div class="mdk-drawer__content" style="width: 318px;">
            <div class="sidebar sidebar-light sidebar-right py-16pt" data-perfect-scrollbar data-perfect-scrollbar-wheel-propagation="true">

                <div class="d-flex align-items-center mb-24pt  d-lg-none">
                    <form action="index.php#target_search" class="search-form search-form--light mx-16pt pr-0 pl-16pt">
                        <input type="text" class="form-control pl-0" name="search_all" placeholder="Search">
                        <button class="btn" type="submit"><i class="material-icons">search</i></button>
                    </form>
                </div>

                <div class="sidebar-heading">Category</div>
                <ul class="sidebar-menu">

                    <?php
                    $cat_query = "SELECT * FROM category_live WHERE Parent = 0";
                    $cat_exec = mysqli_query($conn, $cat_query);
                    while ($array_g = mysqli_fetch_array($cat_exec)) {
                    ?>
                        <li class="sidebar-menu-item active">
                            <a class="sidebar-menu-button" style="color: #ed0b4c;">
                                <span class="<?php echo $array_g['icon']; ?> sidebar-menu-icon sidebar-menu-icon--left" style="color: #ed0b4c;"></span>
                                <span class="sidebar-menu-text"><?php echo $array_g['Name']; ?></span>
                            </a>
                        </li>
                        <?php
                        $cat_query1 = "SELECT * FROM category_live WHERE Parent = " . $array_g['ID'];
                        $cat_exec1 = mysqli_query($conn, $cat_query1);
                        while ($array_g1 = mysqli_fetch_array($cat_exec1)) {
                        ?>
                            <li class="sidebar-menu-item">
                                <a href="direct.php?id_cat=<?php echo $array_g1['ID'];
                                                            if (isset($_GET['search_in'])) {
                                                                echo "&search_in=" . $_GET['search_in'];
                                                            } ?>" class="sidebar-menu-button">
                                    <span class="<?php echo $array_g1['icon']; ?> sidebar-menu-icon sidebar-menu-icon--left"></span>
                                    <span class="sidebar-menu-text"><?php echo $array_g1['Name']; ?></span>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>



            </div>
        </div>
    </div>

<?php
}
?>
<!-- Start review e-learning -->
<?php
if (isset($enroll) && ($enroll == "E-learning")) {
?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            var rating_data = 0;

            $('#add_review').click(function() {

                $('#review_modal').modal('show');

            });

            $(document).on('mouseenter', '.submit_star', function() {

                var rating = $(this).data('rating');

                reset_background();

                for (var count = 1; count <= rating; count++) {

                    $('#submit_star_' + count).addClass('text-warning');

                }

            });

            function reset_background() {
                for (var count = 1; count <= 5; count++) {

                    $('#submit_star_' + count).addClass('star-light');

                    $('#submit_star_' + count).removeClass('text-warning');

                }
            }

            $(document).on('mouseleave', '.submit_star', function() {

                reset_background();

                for (var count = 1; count <= rating_data; count++) {

                    $('#submit_star_' + count).removeClass('star-light');

                    $('#submit_star_' + count).addClass('text-warning');
                }

            });

            $(document).on('click', '.submit_star', function() {

                rating_data = $(this).data('rating');

            });

            $('#save_review').click(function() {

                var user_name = $('#user_name').val();

                var user_review = $('#user_review').val();

                if (user_name == '' || user_review == '') {
                    alert("Please Fill Both Field");
                    return false;
                } else {
                    var cours_id = <?php echo $_GET['id_c']; ?>;
                    var type_c = "E-learning";
                    $.ajax({
                        url: "submit_rating.php",
                        method: "POST",
                        data: {
                            rating_data: rating_data,
                            user_name: user_name,
                            user_review: user_review,
                            cours_id: cours_id,
                            type_c: type_c
                        },
                        success: function(data) {
                            $('#review_modal').modal('hide');

                            load_rating_data();

                            if (data.length > 0) {
                                alert(data);
                            }



                        }
                    })
                }

            });

            load_rating_data();

            function load_rating_data() {
                var cours_id = <?php echo $_GET['id_c']; ?>;
                var type_c = "E-learning";
                $.ajax({
                    url: "submit_rating.php",
                    method: "POST",
                    data: {
                        action: 'load_data',
                        cours_id: cours_id,
                        type_c: type_c
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#average_rating').text(data.average_rating);
                        $('#total_review').text(data.total_review);

                        var count_star = 0;

                        $('.main_star').each(function() {
                            count_star++;
                            if (Math.ceil(data.average_rating) >= count_star) {
                                $(this).addClass('text-warning');
                                $(this).addClass('star-light');
                            }
                        });

                        $('#total_five_star_review').text(data.five_star_review);

                        $('#total_four_star_review').text(data.four_star_review);

                        $('#total_three_star_review').text(data.three_star_review);

                        $('#total_two_star_review').text(data.two_star_review);

                        $('#total_one_star_review').text(data.one_star_review);

                        $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                        $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                        $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                        $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                        $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                        if (data.review_data.length > 0) {
                            var html = '';

                            for (var count = 0; count < data.review_data.length; count++) {
                                html += '<div class="row mb-3">';

                                html += '<div class="col-sm-1"><a href="#" class="avatar avatar-sm mr-12pt"><img src="uploads/avatars/' + data.review_data[count].Image_ri + '" alt="people" class="avatar-img rounded-circle"></a></div>';

                                html += '<div class="col-sm-11">';

                                html += '<div class="card">';

                                html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';

                                html += '<div class="card-body">';

                                for (var star = 1; star <= 5; star++) {
                                    var class_name = '';

                                    if (data.review_data[count].rating >= star) {
                                        class_name = 'text-warning';
                                    } else {
                                        class_name = 'star-light';
                                    }

                                    html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                                }

                                html += '<br />';

                                html += data.review_data[count].user_review;

                                html += '</div>';

                                html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';

                                html += '</div>';

                                html += '</div>';

                                html += '</div>';
                            }

                            $('#review_content').html(html);
                        }
                    }
                })
            }

        });
    </script>
<?php
}
?>
<!-- End review e-learning -->

<!-- Start review Doc -->
<?php
if (isset($enroll) && ($enroll == "Téléchargements")) {
?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            var rating_data = 0;

            $('#add_review').click(function() {

                $('#review_modal').modal('show');

            });

            $(document).on('mouseenter', '.submit_star', function() {

                var rating = $(this).data('rating');

                reset_background();

                for (var count = 1; count <= rating; count++) {

                    $('#submit_star_' + count).addClass('text-warning');

                }

            });

            function reset_background() {
                for (var count = 1; count <= 5; count++) {

                    $('#submit_star_' + count).addClass('star-light');

                    $('#submit_star_' + count).removeClass('text-warning');

                }
            }

            $(document).on('mouseleave', '.submit_star', function() {

                reset_background();

                for (var count = 1; count <= rating_data; count++) {

                    $('#submit_star_' + count).removeClass('star-light');

                    $('#submit_star_' + count).addClass('text-warning');
                }

            });

            $(document).on('click', '.submit_star', function() {

                rating_data = $(this).data('rating');

            });

            $('#save_review').click(function() {

                var user_name = $('#user_name').val();

                var user_review = $('#user_review').val();

                if (user_name == '' || user_review == '') {
                    alert("Please Fill Both Field");
                    return false;
                } else {
                    var cours_id = <?php echo $_GET['id_c']; ?>;
                    var type_c = "Téléchargements";
                    $.ajax({
                        url: "submit-rating-doc.php",
                        method: "POST",
                        data: {
                            rating_data: rating_data,
                            user_name: user_name,
                            user_review: user_review,
                            cours_id: cours_id,
                            type_c: type_c
                        },
                        success: function(data) {
                            $('#review_modal').modal('hide');

                            load_rating_data();
                            if (data.length > 0) {
                                alert(data);
                            }


                        }
                    })
                }

            });

            load_rating_data();

            function load_rating_data() {
                var cours_id = <?php echo $_GET['id_c']; ?>;
                var type_c = "Téléchargements";
                $.ajax({
                    url: "submit-rating-doc.php",
                    method: "POST",
                    data: {
                        action: 'load_data',
                        cours_id: cours_id,
                        type_c: type_c
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#average_rating').text(data.average_rating);
                        $('#total_review').text(data.total_review);

                        var count_star = 0;

                        $('.main_star').each(function() {
                            count_star++;
                            if (Math.ceil(data.average_rating) >= count_star) {
                                $(this).addClass('text-warning');
                                $(this).addClass('star-light');
                            }
                        });

                        $('#total_five_star_review').text(data.five_star_review);

                        $('#total_four_star_review').text(data.four_star_review);

                        $('#total_three_star_review').text(data.three_star_review);

                        $('#total_two_star_review').text(data.two_star_review);

                        $('#total_one_star_review').text(data.one_star_review);

                        $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                        $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                        $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                        $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                        $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                        if (data.review_data.length > 0) {
                            var html = '';

                            for (var count = 0; count < data.review_data.length; count++) {
                                html += '<div class="row mb-3">';

                                html += '<div class="col-sm-1"><a href="#" class="avatar avatar-sm mr-12pt"><img src="uploads/avatars/' + data.review_data[count].Image_ri + '" alt="people" class="avatar-img rounded-circle"></a></div>';

                                html += '<div class="col-sm-11">';

                                html += '<div class="card">';

                                html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';

                                html += '<div class="card-body">';

                                for (var star = 1; star <= 5; star++) {
                                    var class_name = '';

                                    if (data.review_data[count].rating >= star) {
                                        class_name = 'text-warning';
                                    } else {
                                        class_name = 'star-light';
                                    }

                                    html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                                }

                                html += '<br />';

                                html += data.review_data[count].user_review;

                                html += '</div>';

                                html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';

                                html += '</div>';

                                html += '</div>';

                                html += '</div>';
                            }

                            $('#review_content').html(html);
                        }
                    }
                })
            }

        });
    </script>
<?php
}
?>
<!-- End review Doc -->

<!-- Start review Direct -->
<?php
if (isset($enroll) && ($enroll == "Direct")) {
?>

    <script>
        $(document).ready(function() {

            var rating_data = 0;

            $('#add_review').click(function() {

                $('#review_modal').modal('show');

            });

            $(document).on('mouseenter', '.submit_star', function() {

                var rating = $(this).data('rating');

                reset_background();

                for (var count = 1; count <= rating; count++) {

                    $('#submit_star_' + count).addClass('text-warning');

                }

            });

            function reset_background() {
                for (var count = 1; count <= 5; count++) {

                    $('#submit_star_' + count).addClass('star-light');

                    $('#submit_star_' + count).removeClass('text-warning');

                }
            }

            $(document).on('mouseleave', '.submit_star', function() {

                reset_background();

                for (var count = 1; count <= rating_data; count++) {

                    $('#submit_star_' + count).removeClass('star-light');

                    $('#submit_star_' + count).addClass('text-warning');
                }

            });

            $(document).on('click', '.submit_star', function() {

                rating_data = $(this).data('rating');

            });

            $('#save_review').click(function() {

                var user_name = $('#user_name').val();

                var user_review = $('#user_review').val();

                if (user_name == '' || user_review == '') {
                    alert("Please Fill Both Field");
                    return false;
                } else {
                    var cours_id = <?php echo $_GET['id_l']; ?>;
                    var type_c = "Direct";
                    $.ajax({
                        url: "submit-rating-direct.php",
                        method: "POST",
                        data: {
                            rating_data: rating_data,
                            user_name: user_name,
                            user_review: user_review,
                            cours_id: cours_id,
                            type_c: type_c
                        },
                        success: function(data) {
                            $('#review_modal').modal('hide');

                            load_rating_data();

                            if (data.length > 0) {
                                alert(data);
                            }



                        }
                    })
                }

            });

            load_rating_data();

            function load_rating_data() {
                var cours_id = <?php echo $_GET['id_l']; ?>;
                var type_c = "Direct";
                $.ajax({
                    url: "submit-rating-direct.php",
                    method: "POST",
                    data: {
                        action: 'load_data',
                        cours_id: cours_id,
                        type_c: type_c
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#average_rating').text(data.average_rating);
                        $('#total_review').text(data.total_review);

                        var count_star = 0;

                        $('.main_star').each(function() {
                            count_star++;
                            if (Math.ceil(data.average_rating) >= count_star) {
                                $(this).addClass('text-warning');
                                $(this).addClass('star-light');
                            }
                        });

                        $('#total_five_star_review').text(data.five_star_review);

                        $('#total_four_star_review').text(data.four_star_review);

                        $('#total_three_star_review').text(data.three_star_review);

                        $('#total_two_star_review').text(data.two_star_review);

                        $('#total_one_star_review').text(data.one_star_review);

                        $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                        $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                        $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                        $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                        $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                        if (data.review_data.length > 0) {
                            var html = '';

                            for (var count = 0; count < data.review_data.length; count++) {
                                html += '<div class="row mb-3">';

                                html += '<div class="col-sm-1"><a href="#" class="avatar avatar-sm mr-12pt"><img src="uploads/avatars/' + data.review_data[count].Image_ri + '" alt="people" class="avatar-img rounded-circle"></a></div>';

                                html += '<div class="col-sm-11">';

                                html += '<div class="card">';

                                html += '<div class="card-header"><b>' + data.review_data[count].user_name + '</b></div>';

                                html += '<div class="card-body">';

                                for (var star = 1; star <= 5; star++) {
                                    var class_name = '';

                                    if (data.review_data[count].rating >= star) {
                                        class_name = 'text-warning';
                                    } else {
                                        class_name = 'star-light';
                                    }

                                    html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                                }

                                html += '<br />';

                                html += data.review_data[count].user_review;

                                html += '</div>';

                                html += '<div class="card-footer text-right">On ' + data.review_data[count].datetime + '</div>';

                                html += '</div>';

                                html += '</div>';

                                html += '</div>';
                            }

                            $('#review_content').html(html);
                        }
                    }
                })
            }

        });
    </script>
<?php
}
?>
<!-- End review Direct -->

<?php if (isset($pagetitle) && ($pagetitle !== "Calendrier des Formation en Direct")) {

?>
    <!-- jQuery -->
    <script src="public/vendor/jquery.min.js"></script>
<?php } ?>
<script src="public/js/jquery.magnific-popup.js"></script>
<script>
    $(document).ready(function() {

        $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }

        });

    });
</script>
<!-- Bootstrap -->
<script src="public/vendor/popper.min.js"></script>
<script src="public/vendor/bootstrap.min.js"></script>

<!-- Perfect Scrollbar -->
<script src="public/vendor/perfect-scrollbar.min.js"></script>

<!-- DOM Factory -->
<script src="public/vendor/dom-factory.js"></script>

<!-- MDK -->
<script src="public/vendor/material-design-kit.js"></script>

<!-- App JS -->
<script src="public/js/app.js"></script>

<!-- Preloader -->
<script src="public/js/preloader.js"></script>

<script src="https://cdn.jsdelivr.net/gh/BMSVieira/moovie.js@latest/js/moovie.min.js"></script>

<script src="public/js/popper.js"></script>
<script src="public/js/owl.carousel.min.js"></script>
<script src="public/js/main1.js"></script>



<?php
if ($pagetitle == "Cours E-learning") {

    $x = "";
    if (isset($_GET['id_cat']) && !isset($_GET['search_in'])) {
        $x = "?id_cat=" . $_GET['id_cat'];
    } elseif (!isset($_GET['id_cat']) && isset($_GET['search_in'])) {
        $x = "?search_in=" . $_GET['search_in'];
    } elseif (isset($_GET['id_cat']) && isset($_GET['search_in'])) {
        $x = "?id_cat=" . $_GET['id_cat'] . "&search_in=" . $_GET['search_in'];
    }
?>
    <script src="public/js/simple-bootstrap-paginator.js"></script>

    <script>
        $(document).ready(function() {
            var totalPage = parseInt($('#totalPages').val());
            console.log("==totalPage==" + totalPage);
            var pag = $('#pagination').simplePaginator({
                totalPages: totalPage,
                maxButtonsVisible: 5,
                currentPage: 1,
                nextLabel: 'Suiv',
                prevLabel: 'Préc',
                firstLabel: 'prem',
                lastLabel: 'dérn',
                clickCurrentPage: true,
                pageChange: function(page) {
                    $("#content").html('<strong>chargement...</strong>');
                    $.ajax({
                        url: "load_data_cours.php<?php echo $x; ?>",
                        method: "POST",
                        dataType: "json",
                        data: {
                            page: page
                        },
                        success: function(responseData) {
                            $('#content').html(responseData.html);
                        }
                    });
                }
            });
        });
    </script>
<?php } ?>

<?php
if ($pagetitle == "Packs Documents") {

    $x = "";
    if (isset($_GET['id_cat']) && !isset($_GET['search_in'])) {
        $x = "?id_cat=" . $_GET['id_cat'];
    } elseif (!isset($_GET['id_cat']) && isset($_GET['search_in'])) {
        $x = "?search_in=" . $_GET['search_in'];
    } elseif (isset($_GET['id_cat']) && isset($_GET['search_in'])) {
        $x = "?id_cat=" . $_GET['id_cat'] . "&search_in=" . $_GET['search_in'];
    }
?>
    <script src="public/js/simple-bootstrap-paginator.js"></script>

    <script>
        $(document).ready(function() {
            var totalPage = parseInt($('#totalPages').val());
            console.log("==totalPage==" + totalPage);
            var pag = $('#pagination').simplePaginator({
                totalPages: totalPage,
                maxButtonsVisible: 5,
                currentPage: 1,
                nextLabel: 'Suiv',
                prevLabel: 'Préc',
                firstLabel: 'prem',
                lastLabel: 'dérn',
                clickCurrentPage: true,
                pageChange: function(page) {
                    $("#content").html('<strong>chargement...</strong>');
                    $.ajax({
                        url: "load_data_docs.php<?php echo $x; ?>",
                        method: "POST",
                        dataType: "json",
                        data: {
                            page: page
                        },
                        success: function(responseData) {
                            $('#content').html(responseData.html);
                        }
                    });
                }
            });
        });
    </script>
<?php } ?>

<?php
if ($pagetitle == "Formation en Direct") {

    $x = "";
    if (isset($_GET['id_cat']) && !isset($_GET['search_in'])) {
        $x = "?id_cat=" . $_GET['id_cat'];
    } elseif (!isset($_GET['id_cat']) && isset($_GET['search_in'])) {
        $x = "?search_in=" . $_GET['search_in'];
    } elseif (isset($_GET['id_cat']) && isset($_GET['search_in'])) {
        $x = "?id_cat=" . $_GET['id_cat'] . "&search_in=" . $_GET['search_in'];
    }
?>
    <script src="public/js/simple-bootstrap-paginator.js"></script>

    <script>
        $(document).ready(function() {
            var totalPage = parseInt($('#totalPages').val());
            console.log("==totalPage==" + totalPage);
            var pag = $('#pagination').simplePaginator({
                totalPages: totalPage,
                maxButtonsVisible: 5,
                currentPage: 1,
                nextLabel: 'Suiv',
                prevLabel: 'Préc',
                firstLabel: 'prem',
                lastLabel: 'dérn',
                clickCurrentPage: true,
                pageChange: function(page) {
                    $("#content").html('<strong>chargement...</strong>');
                    $.ajax({
                        url: "load_data_direct.php<?php echo $x; ?>",
                        method: "POST",
                        dataType: "json",
                        data: {
                            page: page
                        },
                        success: function(responseData) {
                            $('#content').html(responseData.html);
                        }
                    });
                }
            });
        });
    </script>
<?php } ?>

<?php
if ($pagetitle == "Nos Blogs") {

    $x = "";
    if (isset($_GET['id_cat']) && !isset($_GET['search_in'])) {
        $x = "?id_cat=" . $_GET['id_cat'];
    } elseif (!isset($_GET['id_cat']) && isset($_GET['search_in'])) {
        $x = "?search_in=" . $_GET['search_in'];
    } elseif (isset($_GET['id_cat']) && isset($_GET['search_in'])) {
        $x = "?id_cat=" . $_GET['id_cat'] . "&search_in=" . $_GET['search_in'];
    }
?>
    <script src="public/js/simple-bootstrap-paginator.js"></script>

    <script>
        $(document).ready(function() {
            var totalPage = parseInt($('#totalPages').val());
            console.log("==totalPage==" + totalPage);
            var pag = $('#pagination').simplePaginator({
                totalPages: totalPage,
                maxButtonsVisible: 5,
                currentPage: 1,
                nextLabel: 'Suiv',
                prevLabel: 'Préc',
                firstLabel: 'prem',
                lastLabel: 'dérn',
                clickCurrentPage: true,
                pageChange: function(page) {
                    $("#content").html('<img style="margin: auto;" src="public/images/logo/load.gif" />');
                    $.ajax({
                        url: "load_data_blogs.php<?php echo $x; ?>",
                        method: "POST",
                        dataType: "json",
                        data: {
                            page: page
                        },
                        success: function(responseData) {
                            $('#content').html(responseData.html);
                        }
                    });
                }
            });
        });
    </script>
<?php } ?>
<script>
$(document).ready(function(){
$(".disable_sidebar").click(function(){
$("#default-drawer").removeAttr("data-opened");
});
});
</script>
</body>

</html>