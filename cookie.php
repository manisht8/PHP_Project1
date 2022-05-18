<?php

$user1 = "abc";
$user2 = "xyz";
$user3 = "pqr";
// set the cookies
setcookie("cookie[$user1]",$user1);
setcookie("cookie[$user2]", $user2);
setcookie("cookie[$user3]", $user3);

// after the page reloads, print them out
if (isset($_COOKIE['cookie'])) 
{
    // foreach ($_COOKIE['cookie'] as $Cname => $Cvalue) 
    // {
    //     echo "$Cname : $Cvalue <br />\n";
    // }
     print_r($_COOKIE['cookie']);
     $cars = array("Volvo", "BMW", "Toyota");
    //  arr = <?php echo json_encode($cars); ;
}
?>

<script>
     // OR var  arr  = [];
    //  var arr = new Array();
    
     var arr = <?php echo json_encode($_COOKIE['cookie']); ?>;
     console.log(arr);
</script>