<?php
    require_once "../connect.php";
    if(isset($_POST["updateCheck"])){
        $id = $_POST["qua_id"];
        $status = $_POST["qua_check"];
        $sql = "update quarter_project set qua_check = '$status' where qua_id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }

    }
?>