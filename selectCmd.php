<?php
    $emailid = $_GET['email'];
    $selectCmd1 = "SELECT * FROM user_info WHERE email='$emailid'";
    $selectResult1 = mysqli_query($conn,$selectCmd1);
    $rowResult = mysqli_fetch_assoc($selectResult1);
    if($selectResult1)
    {
        // echo "Select Successful!";
    }
    else
    {
        echo "Select Failed!";
    }
?>