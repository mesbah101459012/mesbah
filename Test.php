<?php
ob_start();
?>
<div>
    <span>text</span>
    <a href="#">link</a>
</div>
<?php
$content = ob_get_clean();
?>
