<?php
$pagetitle = "à propos";


include 'header.php';




?>
<!-- Header Layout Content -->
<div class="mdk-header-layout__content page-content " style="z-index: 0;">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

           <div class="row">
       
       <div class="col-md-6">
           <img style="width: 100%;" src="uploads/about/<?php echo $array_about['photo1']; ?>" >
       </div>
        <div class="col-md-6">
            <?php echo $array_about['desc1']; ?>
        </div>
       
   </div>

        </div>
    </div>
    </div>

   

<?php include 'footer.php'; ?>