<?php $pagetitle = 'Nos Blogs';
include 'header.php';
?>

<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column align-items-center align-items-lg-start flex text-center text-lg-left">
                <h1 class="h2 mb-4pt"><?php echo $pagetitle; ?></h1>
                <div class="lead measure-lead text-70"></div>
            </div>

        </div>
    </div>

    <div class="page-section bg-body border-bottom-2">
        <div class="container page__container">

            <div class="row card-group-row">
                <?php
                $perPage = 8;
                $query = "SELECT * FROM `blog`";

                $exec = mysqli_query($conn, $query);
                $totalRecords = mysqli_num_rows($exec);
                $totalPages = ceil($totalRecords / $perPage);
                $array = mysqli_fetch_array($exec);

                ?>
                <div class="row " id="content" style="width: 100%;">

                </div>
                
</br>
                
            </div>
            <div id="pagination" style="margin: auto;width: max-content;"></div>
                <input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">
        </div>
    </div>

</div>
<!-- // END Header Layout Content -->

<?php include 'footer.php'; ?>