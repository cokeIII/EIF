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
?>