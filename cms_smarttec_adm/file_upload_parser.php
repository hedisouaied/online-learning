<?php
$num = $_GET['id'];
$fileName = $_FILES[$num]["name"]; // The file name
$fileTmpLoc = $_FILES[$num]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES[$num]["type"]; // The type of file it is
$fileSize = $_FILES[$num]["size"]; // File size in bytes
$fileErrorMsg = $_FILES[$num]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
if (move_uploaded_file($fileTmpLoc, "../uploads/cours/lessons/$fileName")) {
    echo "$fileName upload is complete";
    echo "<input type='hidden' name='logo[]' value='" . $fileName . "' />";
} else {
    echo "move_uploaded_file function failed";
}
