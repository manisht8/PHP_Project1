<?php
    require 'connection.php';

    session_start();

    if(!isset($_SESSION['email']))
    {
        header("Location: login.php");
    }
    $emailid = $_SESSION['email'];

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

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body id=bannerImg>
    <h1> Profile </h1>
    <table>
        <tr>
            <th>First Name</th>
            <td><?php echo $rowResult['fname'] ?></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><?php echo $rowResult['lname'] ?></td>
        </tr>
        <tr>
            <th>Email ID</th>
            <td><?php echo $rowResult['email'] ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $rowResult['address'] ?></td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td><?php echo $rowResult['mobile'] ?></td>
        </tr>
        <tr>
            <th>Photo</th>
            <td><img src="<?php echo $rowResult['photo'] ?>" width=50 height=50></td>
        </tr>
    </table>
    <a href="editForm.php"><button class="editBtn"><i class="fa-solid fa-pencil"></i> Edit Profile </button> </a>
    <a href="pwdForm.php"><button class="pwdBtn"><i class="fa-solid fa-pencil"></i> Change Password </button> </a>
    <a href="logout.php"><button>Logout</button></a>
</body>
</html>