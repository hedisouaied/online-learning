<?php

$message = "";
foreach ($_POST as $key => $value)
$message .= "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

mail('boukhris-yassine@live.fr', 'sghting', $message);