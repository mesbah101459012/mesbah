<?php

    include('./Library_Test/phpqrcode/qrlib.php');
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    // outputs image directly into browser, as PNG stream


    QRcode::png($_GET["input_txt"]);
 
?>
<html>
<head>
</head>
</body>
<form method = "GET" action = "./Test_Libraray_of_phpqrcode_Done.php"  target = "iframe_txt" > 
 <input type = "text" name = "input_txt"  />
 <input type = "submit"/>
</form>
<iframe name = "iframe_txt"> </iframe>
<body>
</html>

