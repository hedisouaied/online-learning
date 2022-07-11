<?php
$conn = mysqli_connect("localhost", "root", "", "elearning");
mysqli_set_charset($conn, "utf8");
// 1 week = 604800 seconds
 // server should keep session data for exactly (or at least) 1 week
 ini_set('session.gc_maxlifetime', 604800);

 // each client should remember their session id for EXACTLY 1 week
 session_set_cookie_params(604800);

 session_start(); // start the session

error_reporting(E_ALL);

if (isset($post)) {
    $query = "SELECT * FROM `blog` WHERE ID = " . $_GET['id'];

    $exec = mysqli_query($conn, $query);

    $array = mysqli_fetch_array($exec);
    $pagetitle = $array['Titre'];
}
