<?php
    require 'connection.php';

    if(isset($_POST['regBtn']))
    {
        
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $photo = $_FILES['photo'];
        $passwd = $_POST['passwd'];
        $cnfpwd = $_POST['cnfpwd'];
        // echo "<pre>".print_r($_FILES)."</pre>";
        
        $dupli=0;

        $selectCmd2 = "SELECT * FROM user_info";
        $selectResult2 = mysqli_query($conn,$selectCmd2);
        
        while($row2 = mysqli_fetch_assoc($selectResult2))
        {
            if($row2['email'] == $email)
            {
                $dupli=1;
                break;
            }
        }
        if($dupli==1)
        {
            echo "Email ID already exists!";
        }
        else
        {
            $strong_pwd = password_hash($passwd,PASSWORD_BCRYPT);
            $fileName = $photo['name'];
            $fileError = $photo['error'];
            $filePath = $photo['tmp_name'];

            $imgExtarr = array('png','jpg','jpeg');
            $imgExt = pathinfo($fileName, PATHINFO_EXTENSION);

            if($fileError == 4)
            {
                $destFolder = '';
            }
            if($fileError == 0)
            {
                $destFolder = "images/" . $fileName;
                move_uploaded_file($filePath, $destFolder);
            }
            if (in_array($imgExt, $imgExtarr)) 
            {
                if($fileError == 4)
                {
                    $destFolder = '';
                }
                if($fileError == 0)
                {
                    $destFolder = "images/" . $fileName;
                    move_uploaded_file($filePath, $destFolder);
                }
                $insertCmd = "INSERT INTO user_info VALUES('$email','$fname','$lname','$address',$contact,'$destFolder','$strong_pwd')";
                $insertResult = mysqli_query($conn,$insertCmd);
                if($insertResult)
                {
                    echo "Registration Successful";
                    header("Location: login.php");
                }
                else
                {
                    echo "Registration Failed!";
                        // echo $insertCmd;
                        // die(mysqli_error($conn));
                }
            }
            else{
                echo "Only Images are allowed!";

            }
            
        }  
    }   
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Registration </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="formContainer border border-primary border-3 mx-auto w-25">
            <form method="POST" id="regForm" enctype="multipart/form-data" novalidate>
                <h2 class="text-primary"> Register </h2>
                <div class="inputContainer">
                    <label for="email">Enter Email ID </label>
                    <input type="email" name="email" id="email" onkeyup="return emailValid()"> <br>
                    <span id="emailError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="fname">Enter First Name </label>
                    <input type="text" name="fname" id="fname" onkeyup="return fnameValid()"> <br>
                    <span id="fnameError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="lname">Enter Last Name </label>
                    <input type="text" name="lname" id="lname" onkeyup="return lnameValid()"> <br>
                    <span id="lnameError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="address">Enter Address </label>
                    <textarea rows="3" cols="25" name="address" id="address" onkeyup="return addressValid()"></textarea> <br>
                    <span id="addressError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="contact">Enter Contact Number </label>
                    <input type="number" name="contact" id="contact" onkeyup="return contactValid()"> <br>
                    <span id="contactError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="photo">Upload Photo </label>
                    <input type="file" name="photo" id="photo" onchange="return imgValid()"> <br>
                    <span id="imgError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="passwd">Enter Password </label>
                    <input type="password" name="passwd" id="passwd" onkeyup="return pwdValid()"> <br>
                    <span id="pwdError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="cnfpwd">Confirm Password </label>
                    <input type="password" name="cnfpwd" id="cnfpwd" onkeyup="return cnfValid()"> <br>
                    <span id="cnfError" class="errorMsg"></span>
                </div>
                <input type="hidden" name="regBtn">
                <div class="inputContainer">
                    <input type="button" onclick="submitFunc()" value="Register" name="regBtn" class="btn btn-outline-primary">
                </div>

                <div class="inputContainer">
                   <p>Already registered? <a href="login.php">Login Here </a> </p>
                </div>
            </form>
            <script src="script.js"></script>
    </body>
</html>