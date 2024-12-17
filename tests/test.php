<?php

// require_once __DIR__ . '/vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $spreadsheet = new Spreadsheet();
// $activeWorksheet = $spreadsheet->getActiveSheet();
// $activeWorksheet->setCellValue('A1', 'Hello World !');

// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');
// require_once 'includes/cons.php';
// $composer_repo = getenv("COMPOSER_REPO");
// $dir = $composer_repo."/mpdf";
// require $dir."/vendor/autoload.php";

// $mpdf = new \Mpdf\Mpdf();
// $mpdf->WriteHTML('<h1>Hello world!</h1>');
// $mpdf->Output();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>QR Code Srceen</title>
</head>
<body>
 <div class="wrapper">
    <form action="#">
        <input type="file" hidden>
        <img src="Dinithi Nethmini (1).svg" alt="qr-code">
        <div class="content">
            <i class="fas fa-cloud-upload"></i>
           <p>Upload QR Code to Read</p>
        </div>
        <input type="file" name="file" accept="image/*" capture="camera" />
      </form>
      <div class="details">
        <textarea spellcheck="false" disabled></textarea>
        <div class="buttons">
          <button class="close">Close</button>
          <button class="copy">Copy Text</button>
        </div>
      </div>
    </div>
<script src="main.js"></script> 
</body>
</html>