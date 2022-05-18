<?php
    require 'connection.php';

    session_start();
    if(!isset($_SESSION['email']) || !isset($_COOKIE['pass']))
    {
        header("Location: login.php");
    }
   
    if(!isset($_SESSION['email']))
    {
        $_SESSION['email'] = $_COOKIE['email'];
    }
    $emailid = $_SESSION['email'];
    $selectCmd1 = "SELECT * FROM user_info WHERE email='$emailid'";
    $selectResult1 = mysqli_query($conn,$selectCmd1);
    $rowResult = mysqli_fetch_assoc($selectResult1);
    if($selectResult1) {}
    else
    {
        echo "Select Failed!";
    }
    $_SESSION['fname'] = $rowResult['fname'];
    
    
?>

<!DOCTYPE html>
<html>
<head>
    <title> Dashboard </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div id="bannerImg">
        <h2> Welcome <?php echo $_SESSION['fname'] ?> </h2> <br>
        <a href="profile.php"><button>Profile</button></a>
        <a href="logout.php"><button>Logout</button></a>
    </div>

</body>
</html>