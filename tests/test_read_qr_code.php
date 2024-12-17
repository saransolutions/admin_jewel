<?php 
$composer_home = "C:/Users/tgdnasu3/home/composer-repos";
require  $composer_home. "/khanamiryan-qrcodereader/vendor/autoload.php";
use Zxing\QrReader;
$qrcode = new QrReader('C:/Users/tgdnasu3/home/www/admin_jewel/qr_codes/66fb829a5391a.png');
$text = $qrcode->text(); //return decoded text from QR Code
print($text);

?>