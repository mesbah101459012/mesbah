<?php 

namespace chillerlan\QRCodePublic;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require_once './vendor/autoload.php';


$data = 'HF97qfFgfljKtmZ9oub/RVxwsmT/5bptSWKLKMuVeUVzGq8JxH+qf/RAyAoh1eMKZs/BODG15sn/x69dLxZ6rYWC2LZI6XTC+qMtEFoHRjiaUJm0tqekgcvR1guYHwaEdVboDlKfkgMMVD/etZjSOsVtZNMuNs+jitnLAvZ5gs8=';

//quick and simple:
echo '<img src="'.(new QRCode)->render($data).'" alt="QR Code" />';


if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
    $data = substr($data, strpos($data, ',') + 1);
    $type = strtolower($type[1]); // jpg, png, gif

    if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
        throw new \Exception('invalid image type');
    }

    $data = base64_decode($data);

    if ($data === false) {
        throw new \Exception('base64_decode failed');
    }
} else {
    throw new \Exception('did not match data URI with image data');
}

file_put_contents("img.{$type}", $data);

?>