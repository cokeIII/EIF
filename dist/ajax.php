<?php
    require_once "../pages/connect.php";
    $Y = date("Y");
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

    if(isset($_POST["getCountGroupProject"])){

        $sql = "select 
        count(p.Project_id) as countProject, 
        p.busi_id, b.id, b.group_id, 
        g.id as gId, g.name_th 
        from 
        project p,
        business b,
        group_eec g 
        where 
        p.pro_status != 'ไม่ผ่านการอนุมัติ' and 
        p.busi_id = b.id and 
        g.id = b.group_id 
        group by b.group_id";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $json_result[] = [
                    'countProject'=> $row['countProject'],
                    'gId' => $row['gId'],
                    'name_th' => $row['name_th']
                ];
            }

            $json_result["status"] = true;

        } else {
            $json_result["status"] = false;
        }
        echo json_encode($json_result);

    }
    if(isset($_POST["getProgress"])){
        $name = $_POST["project_name"];
        $sql = "SELECT quater_year,quater,progress,p.project_id,q.project_id,project_name FROM quarter_progress q, project p WHERE p.project_name = '$name' and p.project_id = q.project_id";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $json_result[] = [
                'progress'=> $row['progress'],
                'quater' => $row['quater'],
                'quater_year' => $row['quater_year']
            ];
        }        
        echo json_encode($json_result);
    }

    if(isset($_POST["getProgressMost"])){

        $sql="SELECT p.project_id,qp.project_id,p.project_name,qp.quater,qp.quater_year,qp.progress FROM quarter_progress qp,project p WHERE 
        p.project_id = qp.project_id AND qp.quater_year = '$Y' group by qp.progress DESC LIMIT 0,1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $json_result["MaxProgress"] = $row["project_id"];   
        $json_result["projectName"] = $row["project_name"];   
        echo json_encode($json_result);
        
    }
    if(isset($_POST["getAllNameProject"])){
        $sql = "select project_name from project";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $json_result[] = [
                $row['project_name']
            ];
        }        
        echo json_encode($json_result);
    }
    if(isset($_POST["getSchData"])){
        $projectId = $_POST["projectId"];
        $sqlSch = "select  * from schedule where project_id = '$projectId' and start_date != '0000-00-00' and end_date !='0000-00-00'";
        $resultSch = $conn->query($sqlSch);
        $jsonData['sch'] = [];
        $jsonData['ticket'] = [];
        $jsonData['indicator'] = [];
        
        if ($resultSch->num_rows > 0) {
            while($rowSch = $resultSch->fetch_assoc()){
                $jsonData['sch'][] = [
                    "sch_id"=>$rowSch["sch_id"],
                    "project_id"=>$rowSch["project_id"],
                    "detail"=>$rowSch["detail"],
                    "start_date"=>$rowSch["start_date"],
                    "end_date"=>$rowSch["end_date"]
                ];
            }
        }
        $sqlTicket = "select  topic,detail,quater,qua_date,qua_check from quarter_project where project_id = '$projectId' and status = 'รายงานปัญหา'";
        $resultTicket = $conn->query($sqlTicket);
        if ($resultTicket->num_rows > 0) {
            while($rowTicket = $resultTicket->fetch_assoc()){
                $jsonData['ticket'][] = [
                    "topic"=>$rowTicket["topic"],
                    "detail"=>$rowTicket["detail"],
                    "quater"=>$rowTicket["quater"],
                    "qua_date"=>$rowTicket["qua_date"],
                    "qua_check"=>$rowTicket["qua_check"]
                ];
            }
        }
        $sqlIndicator = "select  topic,detail,quater,qua_date,qua_check from quarter_project where project_id = '$projectId' and status != 'รายงานปัญหา'";
        $resultIndicator = $conn->query($sqlIndicator);
        if ($resultIndicator->num_rows > 0) {
            while($rowIndicator = $resultIndicator->fetch_assoc()){
                $jsonData['indicator'][] = [
                    "topic"=>$rowIndicator["topic"],
                    "detail"=>$rowIndicator["detail"],
                    "quater"=>$rowIndicator["quater"],
                    "qua_date"=>$rowIndicator["qua_date"],
                    "qua_check"=>$rowIndicator["qua_check"]
                ];
            }
        }


        echo json_encode($jsonData);
    }
    if(isset($_POST["getTicket"])){
        $projectId = $_POST["projectId"];
        $sqlSch = "select  topic,detail,quater,qua_date,qua_check from quarter_project where project_id = '$projectId' and status = 'รายงานปัญหา'";
        $resultSch = $conn->query($sqlSch);
        if ($resultSch->num_rows > 0) {
            while($rowSch = $resultSch->fetch_assoc()){
                $jsonData[] = [
                    "topic"=>$rowSch["topic"],
                    "detail"=>$rowSch["detail"],
                    "quater"=>$rowSch["quater"],
                    "qua_date"=>$rowSch["qua_date"],
                    "qua_check"=>$rowSch["qua_check"]
                ];
            }
        }
        echo json_encode($jsonData);
    }
    if(isset($_POST["getIndicator"])){
        $projectId = $_POST["projectId"];
        $sqlSch = "select  topic,detail,quater,qua_date,qua_check from quarter_project where project_id = '$projectId' and status = 'สรุปโครงการ_user' or status = 'สรุปโครงการ'";
        $resultSch = $conn->query($sqlSch);
        if ($resultSch->num_rows > 0) {
            while($rowSch = $resultSch->fetch_assoc()){
                $jsonData[] = [
                    "topic"=>$rowSch["topic"],
                    "detail"=>$rowSch["detail"],
                    "quater"=>$rowSch["quater"],
                    "qua_date"=>$rowSch["qua_date"],
                    "qua_check"=>$rowSch["qua_check"]
                ];
            }
        }
        echo json_encode($jsonData);
    }

?>