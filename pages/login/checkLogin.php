<?php
    if(isset($_SESSION["login"]) && $_SESSION["login"] == true){

    } else {
        header("Location: pages/login/login.php");
    }
?>