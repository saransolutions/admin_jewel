<?php

$composer_home = "C:/Users/tgdnasu3/home/composer-repos";
$dir = $composer_home."/mpdf";
require_once  $dir . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();