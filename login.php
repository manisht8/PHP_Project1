<?php
    session_start();
    
    // if(isset($_COOKIE['pass']))
    // {
    //     header("Location: dashboard.php");
    // }
    require 'connection.php';
    if(isset($_POST['loginBtn']))
    {
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];

        $selectCmd = "SELECT passwd FROM user_info WHERE email='$email'";
        $selectResult = mysqli_query($conn,$selectCmd);
        if(mysqli_num_rows($selectResult)>0)
        {
           
            $res = mysqli_fetch_assoc($selectResult);
            
            $verif_pwd = password_verify($passwd,$res['passwd']);
            if($verif_pwd)
            {
                $_SESSION['email'] = $email;

                setcookie("email",$email,time()+60*60*24*30*6);
                setcookie("pass[$email]",$passwd,time()+60*60*24*30*6);
                header("Location: dashboard.php");
            }
            else
            {
                echo "Password incorrect!";
            }

        }
        else
        {
            echo "No such user found!";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        
        <div class="formContainer border border-primary border-3 mx-auto w-25 text-center">
            <form method="POST" novalidate>
                
                <h2 class="text-primary"> Login </h2>
               
                <div class="inputContainer">
                    <label for="select">Select Email ID </label>
                    <select name="select" id="select" onchange="login()">
                        <?php 
                        if (isset($_COOKIE['pass'])) 
                        {
                            foreach ($_COOKIE['pass'] as $Cemail => $Cpass) 
                            {
                            
                        ?>  
                        <option> <?php echo $Cemail; ?> </option>
                        <?php 
                            }
                        }
                        ?>
                    </select>
                    
                </div>
                <div class="inputContainer">
                    <label for="email">Enter Email ID </label>
                    <input type="email" name="email" id="email">
                    <span id="emailError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <label for="passwd">Enter Password </label>
                    <input type="password" name="passwd" id="passwd">
                    <span id="pwdError" class="errorMsg"></span>
                </div>
                <div class="inputContainer">
                    <input type="submit" value="Login" name="loginBtn" class="btn btn-outline-primary">
                </div>
            </form>
            <script>
                var arr = <?php echo json_encode($_COOKIE['pass']); ?>;
                // console.log(arr);
                login();
                function login()
                {
                    var myEmail = document.getElementById("select").value;
                    document.getElementById("email").value = myEmail;
                    document.getElementById("passwd").value = arr[myEmail] ;
                    // console.log(myEmail);
                    // console.log(arr[myEmail]);
                }
                
            </script>
    </body>
</html>