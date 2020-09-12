<?php
    require_once "../connect.php";

    if(isset($_POST['insertSch'])){
        $project_id = $_POST["project_id"];
        $detail = $_POST["detail"];
        $sql = "insert into schedule (project_id,detail,start_date,end_date) values('$project_id','$detail','0000-00-00','0000-00-00')";

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
    if(isset($_POST['updateDate'])){
        $dateStr = $_POST['dateStr'];
        $eventId = $_POST['eventId'];
        $sql = "update schedule set start_date = '$dateStr', end_date = '$dateStr' where sch_id = '$eventId'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    if(isset($_POST['getSch'])){
        $sql="select * from schedule where start_date != '0000-00-00'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $json_result[] = [
                    'title'=>$row['detail'],
                    'start'=>$row['start_date'],
                    'end'=>$row['end_date'],
                    'id'=>$row['sch_id'],
                ];

            }
        } 
        echo json_encode($json_result);
    }
    if(isset($_POST['updateEndDate'])){
        $dateStr = $_POST['startDate'];
        $eventId = $_POST['eventId'];
        $sql = "update schedule set end_date = DATE_ADD(end_date,INTERVAL $dateStr DAY) where sch_id = '$eventId'";
        if ($conn->query($sql) === TRUE) {
            echo $sql;
        } else {
            echo json_encode(false);
        }
    }

    if(isset($_POST['updateMoveDate'])){
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $eventId = $_POST['eventId'];
        $sql = "update schedule set end_date = '$endDate', start_date = '$startDate' where sch_id = '$eventId'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
?>