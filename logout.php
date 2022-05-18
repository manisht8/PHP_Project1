<?php

    session_start();
    // setcookie("email","",time()-86400);
    // setcookie("passwd","",time()-86400);
    session_destroy();

    header("Location: login.php");
?>