
<?php 
require "vendor/autoload.php";
$qrcode = new QrReader('images/download.png');
$text = $qrcode->text(); //return decoded text from QR Code
echo $text;
?>