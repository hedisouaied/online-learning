<?php

//submit_rating.php
include 'connexion.php';
$connect = $conn;

if (isset($_POST["rating_data"])) {
    $req_b_rr = "SELECT  * FROM review_table WHERE cours_ID = " . $_POST["cours_id"] . " AND Type_c = '" . $_POST["type_c"] . "' AND user_ID = " . $_SESSION['id'] . " ";
    $exec_b_rr = mysqli_query($conn, $req_b_rr);
    $check_b_rr = mysqli_num_rows($exec_b_rr);
    if ($check_b_rr == 0) {

        $date = time();
        $query = "
	INSERT INTO review_table (user_name, user_rating, user_review, user_ID,cours_ID,Type_c,datetime) 
	VALUES ('" . $_POST["user_name"] . "', " . $_POST["rating_data"] . ", '" . $_POST["user_review"] . "', " . $_SESSION["id"] . ", " . $_POST["cours_id"] . ", '" . $_POST["type_c"] . "', " . $date . ")
	";


        $statement = mysqli_query($connect, $query);
        //  echo "Your Review & Rating Successfully Submitted";
    } else {
        echo "Vous avez dèja donnez votre avis à ce cours ";
    }
}

if (isset($_POST["action"])) {
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $query = "
	SELECT * FROM review_table  WHERE cours_ID = " . $_POST["cours_id"] . " AND Type_c = '" . $_POST["type_c"] . "' ORDER BY review_id DESC
	";
    $exec = mysqli_query($connect, $query);


    while ($row = mysqli_fetch_array($exec)) {

        $query_ri = "SELECT * FROM clients WHERE ID =" . $row['user_ID'];
        $exec_ri = mysqli_query($connect, $query_ri);
        $fetch_ri = mysqli_fetch_array($exec_ri);

        $review_content[] = array(
            'user_name'        =>    $fetch_ri["fullname"],
            'user_review'    =>    $row["user_review"],
            'rating'        =>    $row["user_rating"],
            'datetime'        =>    date('l jS, F Y h:i:s A', $row["datetime"]),
            'Image_ri'        =>    $fetch_ri["photo"]
        );


        if ($row["user_rating"] == '5') {
            $five_star_review++;
        }

        if ($row["user_rating"] == '4') {
            $four_star_review++;
        }

        if ($row["user_rating"] == '3') {
            $three_star_review++;
        }

        if ($row["user_rating"] == '2') {
            $two_star_review++;
        }

        if ($row["user_rating"] == '1') {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $row["user_rating"];
    }

    $average_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating'    =>    number_format($average_rating, 1),
        'total_review'        =>    $total_review,
        'five_star_review'    =>    $five_star_review,
        'four_star_review'    =>    $four_star_review,
        'three_star_review'    =>    $three_star_review,
        'two_star_review'    =>    $two_star_review,
        'one_star_review'    =>    $one_star_review,
        'review_data'        =>    $review_content
    );
    /* $output['average_rating'] = number_format($average_rating, 1);
	$output['total_review'] = $total_review;
	$output['five_star_review'] = $five_star_review;
	$output['four_star_review'] = $four_star_review;
	$output['three_star_review'] = $three_star_review;
	$output['two_star_review'] = $two_star_review;
	$output['one_star_review'] = $one_star_review;
	$output['review_data'] = $review_content;*/

    echo json_encode($output);
}
