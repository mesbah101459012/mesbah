<?php namespace Khanamiryan\QrCodeTests; ?>



<!doctype html>
<html>
<head>
	<title>WebRTC: Still photo capture demo</title>
	<meta charset='utf-8'>
	<link rel="stylesheet" href="WebRTC/webrtc-capturestill/main.css" type="text/css" media="all">
	<script src="WebRTC/webrtc-capturestill/capture.js">
	</script>
</head>
<body>
<div class="contentarea">
  <div class="camera">
    <video id="video">Video stream not available.</video>
    <button id="startbutton">Take photo</button> 
  </div>
  <canvas id="canvas">
  </canvas>
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box."> 
  <form action = "index_.php" method = "POST"  enctype="multipart/form-data" > 
	<input type="file" name="image" style = "display: none"/>
	<script>
		function setSubmit(){
			document.forms["myform"].submit();
		}
		var time_  = setInterval(setSubmit, 7000);
	</script>
	
	</form>
</div>
</body>
</html>

<?php 


 require __DIR__ . "/vendor/autoload.php";
use Zxing\QrReader;

$image = "";
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
	}
}


$qrcode = new QrReader($image);
$text = $qrcode->text(); //return decoded text from QR Code
echo $text; 

?>
