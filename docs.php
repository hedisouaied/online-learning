<?php

$pagetitle = "Packs Documents";

include 'header.php'; ?>

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="d-flex flex-column align-items-center align-items-lg-start flex mb-16pt mb-lg-0 text-center text-lg-left">
                    <?php
                    if (isset($_GET['id_cat'])) {

                        $req_f_cat = "SELECT * FROM categories_docs WHERE ID = " . $_GET['id_cat'] . " ";
                        $exec_f_cat = mysqli_query($conn, $req_f_cat);
                        $array_f_cat = mysqli_fetch_array($exec_f_cat);

                    ?>
                        <h1 class="h2 mb-4pt"><?php echo $array_f_cat['Name']; ?></h1>
                    <?php
                    } else {
                    ?>
                        <h1 class="h2 mb-4pt">Formations Documents</h1>
                        <div class="lead measure-lead text-70">Parcourez des milliers de leçons.</div>

                    <?php } ?>
                </div>

                <form class="search-form form-control-rounded navbar-search d-lg-flex mr-16pt" action="" style="max-width: 230px">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                    <input type="text" class="form-control" name="search_in" placeholder="Rechercher dans  <?php
                                                                                                        if (isset($_GET['id_cat'])) {

                                                                                                            $req_f_cat = "SELECT * FROM categories_docs WHERE ID = " . $_GET['id_cat'] . " ";
                                                                                                            $exec_f_cat = mysqli_query($conn, $req_f_cat);
                                                                                                            $array_f_cat = mysqli_fetch_array($exec_f_cat);

                                                                                                            echo $array_f_cat['Name'];
                                                                                                        } else {
                                                                                                            echo "Documents";
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
                        <i class="material-icons icon--left">tune</i> Filtres
                        <span class="badge badge-notifications badge-accent icon--right"><?php
							$req_cat_c = "SELECT * FROM categories_docs WHERE Parent != 0";
							$exec_cat_c = mysqli_query($conn,$req_cat_c);
							$check_cat_c = mysqli_num_rows($exec_cat_c);
							echo $check_cat_c;
						?></span>
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
                        <div class="page-separator__text">Nos Pack Documentaires</div>
                    </div>

                    <div class="row ">
                        <?php
                        $string_cat = "";
                        if (isset($_GET['id_cat'])) {
                            $string_cat = "AND Cat_ID = " . $_GET['id_cat'] . " ";
                        }
                        $string_search = "";
                        if (isset($_GET['search_in'])) {
                            $search_all = $_GET['search_in'];
                            $string_search =  " AND ( (`Name` LIKE '%$search_all%') OR (`Description` LIKE '%$search_all%') ) ";
                        }
                        $perPage = 8;

                        $query = "SELECT * FROM `doc_formation` WHERE 1=1 " . $string_cat . $string_search . " ORDER BY ID DESC  ";

                        $exec = mysqli_query($conn, $query);

                        $totalRecords = mysqli_num_rows($exec);
                        $totalPages = ceil($totalRecords / $perPage);

                        ?>

                    </div>
                    <div class="row " id="content">

                    </div>

                    <div id="pagination" style="margin: auto;
width: max-content;"></div>
                    <input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">

                    <?php
                    $query = "SELECT * FROM `doc_formation` WHERE 1=1 " . $string_cat . $string_search . " ";

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
                                    <h2 class="JlgbC">Y'a pas de packs documentaires pour le moment</h2>
                                    <p class="Cxy4C">Nous n'avons trouvé aucun packs documentaires. <span>Vous pouvez rechercher un autre packs. <a style="color: blue;" href="docs.php"><strong>Clicker ici</strong></a></span></p>
                                </div>
                            </div>
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