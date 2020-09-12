<?php
require_once "../connect.php";
session_start();
if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $branch_no = $_POST["branch_no"];
    $sql = "select id,branch_no,password,business_name from business where id='$username' and branch_no='$branch_no' and password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["login"] = true;
            $_SESSION["branch_no"] = $row["branch_no"];
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["business_name"];
            if($row["id"] == "Admin"){
                $_SESSION["status"] = "admin";
            } else if($row["id"] == "MD") {
                $_SESSION["status"] = "MD";
            } else {
                $_SESSION["status"] = "user";
            }            
        }
    } else {
        $_SESSION["login_fail"] = true;
        $_SESSION["login"] = false;
    }
    header("Location: ../../index.php");
}

?>