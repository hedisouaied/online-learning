<?php
$post = "";


include 'header.php';




?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content " style="z-index: 0;">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start flex mb-16pt mb-lg-0 text-center text-md-left">
                    <div class="avatar overlay overlay--primary mb-16pt mb-md-0 mr-md-16pt" style="margin-top: 14px;height: 80px;width: 100px;">
                        <img src="uploads/img_blog/<?php echo $array['Image']; ?>" class="avatar-img rounded" alt="<?php echo $array['Titre']; ?>">

                    </div>
                    <div class="flex">
                        <h1 class="h2 measure-lead-max mb-16pt"><?php echo $array['Titre']; ?></h1>
                        <div class="d-flex align-items-center">
                            <a class="avatar avatar-sm mr-12pt">
                                <img src="uploads/logo/black.svg" alt="author" class="avatar-img rounded-circle">
                            </a>
                            <div class="mr-16pt">
                                <a class="card-title"><?php

                                                        $req_auth = "SELECT * FROM users WHERE UserID = " . $array['Auth'];
                                                        $exec_auth = mysqli_query($conn, $req_auth);
                                                        $array_auth = mysqli_fetch_array($exec_auth);
                                                        echo $array_auth['FullName'];
                                                        ?></a>
                                <div class="d-flex align-items-center">
                                    <small class="text-50 mr-2"><?php echo $array['Date']; ?></small>
                                </div>
                            </div>
                            <div>
                                <a href="" class="text-50 d-flex align-items-center text-decoration-0"><i class="material-icons icon--left">favorite_border</i></a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="ml-lg-16pt">
                    <a href="blogs.php" class="btn btn-light">Blogs</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-8">

                    <div class="">
                        <div class="mb-16pt mb-md-0 mr-md-16pt">
                            <div class="rounded p-relative o-hidden overlay overlay--primary" style="width: 120px;">
                                <img class="img-fluid rounded" src="uploads/img_blog/<?php echo $array['Image']; ?>" alt="<?php echo $array['Titre']; ?>">
                            </div>
                        </div>
                        <div class="flex">
                            <p class="lead measure-paragraph-max"><?php echo $array['Para']; ?></p>
                        </div>
                    </div>

                    <blockquote class="blockquote blockquote--reverse pl-0">
                        <p class="text-50"><?php echo $array['Remarque']; ?></p>
                    </blockquote>



                    <div class="d-flex flex-column flex-md-row mb-32pt">

                        <?php
                        if (!empty($array['Image1'])) {


                        ?>

                            <div style="vertical-align: baseline;line-height: 1;display: flex;flex-wrap: wrap;padding: 5px;justify-content: flex-end;">
                                <div style="margin: 5px;" class="rounded p-relative o-hidden overlay overlay--primary">
                                    <a class="image-popup-vertical-fit" href="uploads/img_blog/<?php echo $array['Image1']; ?>" title="Title">
                                        <img class="img-fluid rounded" src="uploads/img_blog/<?php echo $array['Image1']; ?>"" alt=" image">
                                    </a>
                                    <div class="overlay__content"></div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        if (!empty($array['Image2'])) {


                        ?>

                            <div style="vertical-align: baseline;line-height: 1;display: flex;flex-wrap: wrap;padding: 5px;justify-content: flex-end;">
                                <div style="margin: 5px;" class="rounded p-relative o-hidden overlay overlay--primary">
                                    <a class="image-popup-vertical-fit" href="uploads/img_blog/<?php echo $array['Image2']; ?>" title="Title">
                                        <img class="img-fluid rounded" src="uploads/img_blog/<?php echo $array['Image2']; ?>"" alt=" image">
                                    </a>
                                    <div class="overlay__content"></div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        if (!empty($array['Image3'])) {


                        ?>

                            <div style="vertical-align: baseline;line-height: 1;display: flex;flex-wrap: wrap;padding: 5px;justify-content: flex-end;">
                                <div style="margin: 5px;" class="rounded p-relative o-hidden overlay overlay--primary">
                                    <a class="image-popup-vertical-fit" href="uploads/img_blog/<?php echo $array['Image3']; ?>" title="Title">
                                        <img class="img-fluid rounded" src="uploads/img_blog/<?php echo $array['Image3']; ?>" alt=" image">
                                    </a>
                                    <div class="overlay__content"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="measure-lead-max">

                        <div class="page-separator">
                            <div class="page-separator__text">Commentaires</div>
                        </div>
                        <form method="POST" id="comment_form">
                            <div class="d-flex mb-24pt">
                                <a class="avatar avatar-sm mr-12pt">
                                    <span class="avatar-title rounded-circle">LB</span>
                                </a>
                                <div class="flex">
                                    <input type="hidden" name="blog_id" value="<?php echo $_GET['id']; ?>">
                                    <div class="form-group">
                                        <?php
                                        if (isset($_SESSION['client'])) { ?>
                                            <input type="hidden" name="comment_name" id="comment_name" value="<?php echo $_SESSION['name']; ?>">
                                        <?php   } else {
                                        ?> <label for="comment" class="form-label">Nom et Prénom</label>
                                            <input class="form-control" name="comment_name" id="comment_name" id="comment" rows="3" placeholder="John Jack" required />
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment" class="form-label">votre commentaire</label>
                                        <textarea class="form-control" name="comment_content" id="comment" rows="3" placeholder="Tapez ici pour laisser un commentaire ..."></textarea>
                                    </div>
                                    <input type="hidden" name="comment_id" id="comment_id" value="0" />
                                    <button class="btn btn-outline-secondary">Poster</button>
                                </div>
                            </div>
                        </form>
                        <span id="comment_message"></span>
                        <br />
                        <div id="display_comment"></div>

                    </div>

                </div>
                <div class="col-lg-4">

                    <div class="page-separator">
                        <div class="page-separator__text">Auteur</div>
                    </div>

                    <div class="media align-items-center mb-16pt">
                        <span class="media-left mr-16pt">
                            <img src="uploads/logo/black.svg" width="40" alt="avatar" class="rounded-circle">
                        </span>
                        <div class="media-body">
                            <a class="card-title m-0"><?php
                                                        $req_auth = "SELECT * FROM users WHERE UserID = " . $array['Auth'];
                                                        $exec_auth = mysqli_query($conn, $req_auth);
                                                        $array_auth = mysqli_fetch_array($exec_auth);
                                                        echo $array_auth['FullName']; ?></a>
                            <p class="text-50 lh-1 mb-0">admin</p>
                        </div>
                    </div>

                    <!-- <a class="btn btn-white mb-24pt">Follow</a> -->
                    <?php
                        if (!empty($array['DOC'])) {


                        ?>
                    <div class="page-separator">
                        <a href="uploads/doc_blog/<?php echo $array['DOC'] ; ?>" class="btn btn-lg btn-accent btn--raised mb-16pt" download><?php if (!empty($array['file_name'])) { echo $array['file_name']; }else{ ?>Voir le document <?php } ?></a>
                    </div>
                    <?php } ?>
                    <div class="page-separator">
                        <div class="page-separator__text">recommandés</div>
                    </div>
                    
                    

                    <?php
                    $req_blg = "SELECT * FROM blog WHERE ID != " . $_GET['id'] . " ORDER BY RAND() LIMIT 3";
                    $exec_blg = mysqli_query($conn, $req_blg);
                    while ($array_blg = mysqli_fetch_array($exec_blg)) {
                    ?>
                        <div class="mb-8pt d-flex align-items-center">
                            <a style="width: 7rem!important;" href="post.php?id=<?php echo $array['ID']; ?>" class="avatar avatar-lg overlay overlay--primary mr-12pt">
                                <img src="uploads/img_blog/<?php echo $array_blg['Image']; ?>" alt="uploads/img_blog/<?php echo $array_blg['Image']; ?>" class="avatar-img rounded">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="post.php?id=<?php echo $array_blg['ID']; ?>"><?php echo $array_blg['Titre']; ?></a>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted"><?php echo $array_blg['Date']; ?></small>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

    

<script>
    $(document).ready(function() {

        $('#comment_form').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "add_comment.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                success: function(data) {
                    if (data.error != '') {
                        $('#comment_form')[0].reset();
                        $('#comment_message').html(data.error);
                        $('#comment_id').val('0');
                        load_comment();
                    }
                }
            })
        });

        load_comment();

        function load_comment() {
            $.ajax({
                url: "fetch_comment.php?id=<?php echo $_GET['id'] ?>",
                method: "POST",
                success: function(data) {
                    $('#display_comment').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function() {
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment').focus();
        });

    });
</script>
<!-- // END Header Layout Content -->
<?php include 'footer.php'; ?>