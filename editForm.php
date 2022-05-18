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
    
    $email = $rowResult['email'];
    $fname = $rowResult['fname'];
    $lname = $rowResult['lname'];
    $address = $rowResult['address'];
    $contact = $rowResult['mobile'];
    $photo = $rowResult['photo'];

    $Uflag = 0;
    
    if(isset($_POST['updateBtn']))
    {
       
        $fnaME = $_POST['fname'];
        $lnaME = $_POST['lname'];
        $emaIL = $_POST['email'];
        $contaCT = $_POST['contact'];
        $addreSS = $_POST['address'];
        $phoTO = $_FILES['photo'];

        $fileName = $phoTO['name'];
        $fileError = $phoTO['error'];
        $filePath = $phoTO['tmp_name'];
        
        if($emaIL == "")
        {
            echo "Email ID field is required!";
            
        }
        else
        {
                
                $updateCmd = "UPDATE user_info SET ";
                if(!$fnaME == '')
                {
                    $updateCmd .= "fname = '$fnaME'";
                    $Uflag++;
                }
                if(!$lnaME == '')
                {
                    if($Uflag!=0)
                    {
                        $updateCmd = $updateCmd . ",";
                        $Uflag--;
                    }
                    $updateCmd = $updateCmd . "lname = '$lnaME'";
                    $Uflag++;
                }
                if(!$contaCT == '')
                {
                    if($Uflag!=0)
                    {
                        $updateCmd = $updateCmd . ",";
                        $Uflag--;
                    }
                    $updateCmd = $updateCmd . "mobile = $contaCT";
                    $Uflag++;
                }
                if(!$addreSS == '')
                {
                    if($Uflag!=0)
                    {
                        $updateCmd = $updateCmd . ",";
                        $Uflag--;
                    }
                    $updateCmd = $updateCmd . "address = '$addreSS'";
                    $Uflag++;
                }
                if($fileError == 0)
                {
                    $destFolder = "images/" . $fileName;
                    move_uploaded_file($filePath, $destFolder);
                    if($Uflag!=0)
                    {
                        $updateCmd = $updateCmd . ",";
                        $Uflag--;
                    }
                    $updateCmd = $updateCmd . "photo = '$destFolder'";
                    
                }
                $updateCmd = $updateCmd . " WHERE email = '$emaIL'";
                $updateResult = mysqli_query($conn,$updateCmd);
               
                if ($updateResult)
                {
                    echo "Update Successful!";
                    header("Location: profile.php?email=$emailid");
                }
                else 
                {
                    echo "$updateCmd";
                    echo "Update Failed!";
                }
        }   
    }

    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Update Details </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="formContainer border border-primary border-3 mx-auto w-25">
            <form method="POST" action="editForm.php" id="regForm" enctype="multipart/form-data" novalidate onsubmit="return submitFunc2()">
                <h2 class="text-primary"> Update Details </h2>
                <div class="inputContainer">
                    <label for="email">Enter Email ID </label>
                    <input type="email" name="email" id="email" onkeyup="return emailValid()" value="<?php echo $email; ?>" readonly> <br>
                    <span id="emailError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="fname">Enter First Name </label>
                    <input type="text" name="fname" id="fname" onkeyup="return fnameValid()" value="<?php echo $fname; ?>"> <br>
                    <span id="fnameError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="lname">Enter Last Name </label>
                    <input type="text" name="lname" id="lname" onkeyup="return lnameValid()" value="<?php echo $lname; ?>"> <br>
                    <span id="lnameError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="address">Enter Address </label>
                    <textarea rows="3" cols="25" name="address" id="address" onkeyup="return addressValid()" ><?php echo $address; ?></textarea> <br>
                    <span id="addressError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="contact">Enter Contact Number </label>
                    <input type="number" name="contact" id="contact" onkeyup="return contactValid()" value="<?php echo $contact; ?>"> <br>
                    <span id="contactError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <img src="<?php echo  $photo; ?>" width=50 height=50>
                    <label for="photo">Upload Photo </label>
                    <input type="file" name="photo" id="photo"> <br>
                    <span id="imgError" class="errorMsg"></span>
                </div>
                
                <!-- <div class="inputContainer">
                    <label for="passwd">Enter Password </label>
                    <input type="password" name="passwd" id="passwd" onkeyup="return pwdValid()"> <br>
                    <span id="pwdError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="cnfpwd">Confirm Password </label>
                    <input type="password" name="cnfpwd" id="cnfpwd" onkeyup="return cnfValid()"> <br>
                    <span id="cnfError" class="errorMsg"></span>
                </div> -->
                <!-- <input type="hidden" name="updateBtn"> -->
                <div class="inputContainer">
                    <input type="submit" value="Update" name="updateBtn" class="btn btn-outline-primary">
                </div>
            </form>
            <script src="script.js"></script>
    </body>
</html>