<?php 
namespace Khanamiryan\QrCodeTests;

 require __DIR__ . "/vendor/autoload.php";
use Zxing\QrReader;

$qrcode = new QrReader('images/d2.png');
$text = $qrcode->text(); //return decoded text from QR Code
echo $text; 

?>

