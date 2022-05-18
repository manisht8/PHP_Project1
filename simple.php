<?php
   $fileType = "image/jpeg";
   echo "<pre>".print_r($_FILES)."</pre>";
   $type = pathinfo($fileType,PATHINFO_EXTENSION);
   echo $type;
exit;
?>


