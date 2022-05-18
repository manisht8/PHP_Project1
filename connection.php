<?php
$servername = "localhost:3307";
$username = "root";
$pwd = "";
$dbname = "studentdetails";

$conn = mysqli_connect($servername,$username,$pwd,$dbname);
if($conn)
{

    // echo "Connection Sucessful!";
}
else
{
    echo "Connection Failed!";
    die(mysqli_connect_error($conn));
}

?>