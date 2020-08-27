<?php
    require_once "../connect.php";

    if(isset($_POST['insertSch'])){
        $project_id = $_POST["project_id"];
        $detail = $_POST["detail"];
        $sql = "insert into schedule (project_id,detail) values('$project_id','$detail')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    if(isset($_POST['delSch'])){
        $sch_id = $_POST['sch_id'];
        $sql = "delete from schedule where sch_id = '$sch_id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
?>