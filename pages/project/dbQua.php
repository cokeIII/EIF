<?php
    require_once "../connect.php";
    if(isset($_POST["formQua"])){

        $month = date("n");
        $yearQuarter = ceil($month / 3);
        $topic = $_POST["topicQua"];
        $project_id = $_POST["project_id"];
        $detail = $_POST["detail-qua"];
        $sql = "insert into quarter_project (
            project_id,
            topic,
            detail,
            status,
            quater
            ) values(
            '$project_id',
            '$topic',
            '$detail',
            'สรุปโครงการ_user',
            '$yearQuarter'
        )";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
            print_r($sql);
        }
    }
    if(isset($_POST["delQua"])){
        $id = $_POST["qua_id"];
        $sql = "delete from quarter_project where qua_id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    if(isset($_POST["editQua"])){
        $detailQua = $_POST["detailQua"];
        $id = $_POST["qua_id"];

        $sql = "update quarter_project set detail = '$detailQua' where qua_id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }

    }

?>