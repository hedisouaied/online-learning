<?php
ob_start();
$pagetitle = "Checkout direct";
$msg = "";

include "header.php";
if (isset($_POST['cours'])) {




    $req = "UPDATE `checkout` SET Paid = 1 WHERE ID = '" . $_POST['cours'] . "' ";
    $exec = mysqli_query($conn, $req);
    header("location: merci.php");

?>

<?php

    include "footer.php";
} else {
    header('location:mescours.php');
}

ob_end_flush();
?>