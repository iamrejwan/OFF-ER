<?php

$targetUrl = $_GET['url'];

header('Access-Control-Allow-Origin: *');
header;
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');

echo file_get_contents($targetUrl);
?>
