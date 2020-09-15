<?php
    require_once "../connect.php";
    if(isset($_POST["formQua"])){

        $month = date("n");
        $Y = date("Y");
        $yearQuarter = ceil($month / 3);
        $topic = $_POST["topicQua"];
        $project_id = $_POST["project_id"];
        $detail = $_POST["detail-qua"];
        $costBudget = $_POST["costBudget"];
        $progress = $_POST["progress"];
        $sql = "insert into quarter_project (
            project_id,
            topic,
            detail,
            status,
            quater,
            qua_check
            ) values(
            '$project_id',
            '$topic',
            '$detail',
            'สรุปโครงการ_user',
            '$yearQuarter',
            '2'
        )";

        $sqlSelect = "select id,project_id,quater,quater_year from quarter_progress where project_id='$project_id' and quater='$yearQuarter' and quater_year='$Y'";
        $result = $conn->query($sqlSelect);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row["id"];
            $sqlProgress = "update quarter_progress set cost_budget='$costBudget', progress='$progress' where id='$id'";
    
        } else {
            $sqlProgress = "insert into quarter_progress 
            (project_id,
            cost_budget,
            progress,
            quater,
            quater_year)
            values(
                '$project_id',
                '$costBudget',
                '$progress',
                '$yearQuarter',
                '$Y'
            )";    
        }

        if ($conn->query($sql) === TRUE && $conn->query($sqlProgress) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
            print_r($sqlProgress);
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
    if(isset($_POST["editQuaUser"])){
        $detailQua = $_POST["detailQua"];
        $topicQua = $_POST["topicQua"];
        $id = $_POST["qua_id"];

        $sql = "update quarter_project set topic = '$topicQua', detail = '$detailQua' where qua_id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }

    }
    if(isset($_POST["delQuaUser"])){
        $qua_id = $_POST["qua_id"];
        $sql = "delete from quarter_project where qua_id = '$qua_id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

?>