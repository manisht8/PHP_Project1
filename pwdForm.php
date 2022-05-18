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

    $oldPwd = $rowResult['passwd'];
    
    if(isset($_POST['updateBtn']))
    {
    
        $oldpwd = $_POST['oldPwd'];
        $newpwd = $_POST['newPwd'];
    
        $verif_pwd = password_verify($oldpwd,$oldPwd);
        
        if($verif_pwd)
        {
            $strong_pwd = password_hash($newpwd,PASSWORD_BCRYPT);
            $updateCmd = "UPDATE user_info SET passwd='$strong_pwd' WHERE email = '$emailid'";
            $updateResult = mysqli_query($conn,$updateCmd);
            if ($updateResult)
            {
                echo "Password Changed Successfully!";
                header("Location: profile.php?email=$emailid");
            }
            else 
            {
                    echo "$updateCmd";
                    echo "Update Failed!";
            }
        }
        else
        {
            echo "Old Password is incorrect!";
        }

    }
    

    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Change Password </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="formContainer border border-primary border-3 mx-auto w-25">
            <form method="POST" action="pwdForm.php" id="regForm" enctype="multipart/form-data" novalidate onsubmit="return submitFunc2()">
                <h2 class="text-primary"> Change Password </h2>
                <div class="inputContainer">
                    <label for="oldpasswd">Enter Old Password </label>
                    <input type="password" name="oldPwd" id="oldpasswd"> <br>
                    <!-- onkeyup="return pwdValid()" -->
                    <!-- <span id="pwdError" class="errorMsg"></span> -->
                </div>
                <div class="inputContainer">
                    <label for="passwd">Enter New Password </label>
                    <input type="password" name="newPwd" id="passwd" onkeyup="return pwdValid()"> <br>
                    <span id="pwdError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="cnfpwd">Confirm Password </label>
                    <input type="password" name="cnfpwd" id="cnfpwd" onkeyup="return cnfValid()"> <br>
                    <span id="cnfError" class="errorMsg"></span>
                </div>
                <!-- <input type="hidden" name="updateBtn"> -->
                <div class="inputContainer">
                    <input type="submit" value="Change" id="updateBtn" name="updateBtn" class="btn btn-outline-primary">
                </div>
            </form>
            <script src="script.js"></script>
    </body>
</html>