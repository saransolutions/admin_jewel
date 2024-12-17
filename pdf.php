<?php
require_once 'includes/cons.php';
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:
$mpdf->WriteHTML('Welcome to '.MAIN_TITLE);

// Output a PDF file directly to the browser
$mpdf->Output();