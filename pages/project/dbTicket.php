<?php
    require_once "../connect.php";
    if(isset($_POST["formTicket"])){
        $tmp = $_FILES["files"]["tmp_name"];
        $files = $_FILES['files']['name'];
        $d = new DateTime();
        $nameD = $d->format('YmdHis');
        $final_files = $nameD."_".$files;
        $month = date("n");
        $yearQuarter = ceil($month / 3);
        $path = 'uploads/';
        $path = $path.strtolower($final_files); 
        if(!empty($_FILES['files']['name'])){
            move_uploaded_file($tmp,$path);
        } else {
            $final_files = "";
        }
        $topic = $_POST["topic"];
        $detail = $_POST["detail"];
        $project_id = $_POST["project_id"];
        $sql = "insert into quarter_project (
            project_id,
            topic,
            detail,
            status,
            quater,
            file_name
        ) values(
            '$project_id',
            '$topic',
            '$detail',
            'รายงานปัญหา',
            '$yearQuarter',
            '$final_files'
        )";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    if(isset($_POST["delTicket"])){
        $id = $_POST["qua_id"];
        $sql = "delete from quarter_project where qua_id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
            print_r($sql);
        }
    }
?>