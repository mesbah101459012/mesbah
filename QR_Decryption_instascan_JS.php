
<html>
<head>
		<script type="text/javascript" src="./instascan/instascan.min.js"></script>
</head>
	<body>

    <video id="preview"></video>
	<p id = "id-Para" > </p>
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
		console.log("ok");
		document.getElementById("id-Para").innerHTML = content;
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
	  
 
	  
    </script>

	</body>
 </html>