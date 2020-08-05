<?php
    require_once "../pages/connect.php";

    if(isset($_POST["provinces"])){
        $id = $_POST["id"];
        $sql = "select * from amphures where province_id ='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $json_result[] = [
                    'id'=>$row['id'],
                    'name'=>$row['name_th'],
                ];

            }
        } 
        echo json_encode($json_result);

    }
    if(isset($_POST["district_id"])){
        $id = $_POST["id"];
        $sql = "select * from districts where amphure_id ='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $json_result[] = [
                    'id'=>$row['id'],
                    'name'=>$row['name_th'],
                    'zip_code'=>$row['zip_code'],
                ];

            }
        } 
        echo json_encode($json_result);
    }
    if(isset($_POST["loginBranch"])){
        $id = $_POST["id"];
        $sql = "select branch_no from business where id ='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $json_result[] = [
                    'branch_no'=>$row['branch_no'],
                ];

            }
            $json_result["status"] = true;

        } else {
            $json_result["status"] = false;
        }
        echo json_encode($json_result);

    }
    
    if(isset($_POST["approve"])){
        $id = $_POST["projectId"];
        $sql = "update project set pro_status = 'ผ่านการอนุมัติ' where project_id ='$id'";
        $result = $conn->query($sql);
        if ($result > 0) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    if(isset($_POST["disApprove"])){
        $id = $_POST["projectId"];
        $sql = "update project set pro_status = 'ไม่ผ่านการอนุมัติ' where project_id ='$id'";
        $result = $conn->query($sql);
        if ($result > 0) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    if(isset($_POST["getCountProject"])){
        if(isset($_POST["status"])){
            $status = $_POST["status"];
            $sql = "select count(Project_id) as countProject from project where pro_status = '$status'";
        } else {
            $sql = "select count(Project_id) as countProject from project";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $json_result["countProject"] = $row['countProject'];

            $json_result["status"] = true;

        } else {
            $json_result["status"] = false;
        }
        echo json_encode($json_result);

    }
?>