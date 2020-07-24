<?php
require_once "../connect.php";
session_start();
if(isset($_POST["submit"])){
    if($_POST["username"] == "Admin" && $_POST["password"]=="Admin"){
        $_SESSION["login"] = true;
        $_SESSION["username"] = "Admin";
        header("Location: ../../index.php");
    } else {
        header("Location: login.php");
        $_SESSION["login"] = false;
    }
}

?>