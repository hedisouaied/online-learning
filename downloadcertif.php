<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L','margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 0,'margin_header' => 0,'margin_footer' => 0]);

include 'data_certif.php';


$mpdf->WriteHTML($data);
$mpdf->Output($_GET['pdf'], "D");

echo $data;
