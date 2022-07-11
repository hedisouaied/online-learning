<?php
$conn = mysqli_connect("localhost", "root", "", "elearning");
mysqli_set_charset($conn, "utf8");

session_start();
if ($_SESSION['auth'] !== true) {
	header("location:index.php");
}
//1- Connexion au serveur + base de donnée

error_reporting(E_ALL);
include("functions.php");
