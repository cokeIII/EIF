<?php
    require_once "../connect.php";
    if(isset($_POST["formIndicator"])){

        $month = date("n");
        $yearQuarter = ceil($month / 3);
        
        $topic = $_POST["topicIndicator"];
        $project_id = $_POST["project_id"];
        $sql = "insert into quarter_project (
            project_id,
            topic,
            status,
            quater
            ) values(
            '$project_id',
            '$topic',
            'สรุปโครงการ',
            '$yearQuarter'
        )";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    if(isset($_POST["delIndicator"])){
        $id = $_POST["qua_id"];
        $sql = "delete from quarter_project where qua_id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    if(isset($_POST["editIndicator"])){
        $topic = $_POST["topicIndicator"];
        $id = $_POST["qua_id"];

        $sql = "update quarter_project set topic = '$topic' where qua_id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }

    }

?>