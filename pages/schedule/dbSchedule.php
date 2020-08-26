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
    if(isset($_POST['getSch'])){
        $project_id = $_POST["project_id"];
        $sql  = "select * from schedule where project_id = '$project_id' and date = '0000-00-00'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $json_result[] = [
                    'sch_id'=>$row['sch_id'],
                    'detail'=>$row['detail'],
                ];
            }   
        }
        echo json_encode($json_result);
    }
?>