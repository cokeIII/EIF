<?php

require_once "../connect.php";
if(isset($_POST['submit'])){
    $project_name = $_POST['projectName'];
    $busi_id = $_POST['busi_id'];
    $branch_no = $_POST['branch_no'];
    $reason = $_POST['reason'];
    $objective = $_POST['objective'];
    $maingoal = $_POST['maingoal'];
    $persons = $_POST['persons'];
    $start_duration = $_POST['start_duration'];
    $end_duration = $_POST['end_duration'];
    $locations = $_POST['locations'];
    $budget = $_POST['budget'];
    $product = $_POST['product'];
    $indicator = $_POST['indicator'];
    $persons = json_encode($persons,JSON_UNESCAPED_UNICODE);
    $budget = json_encode($budget,JSON_UNESCAPED_UNICODE);
    $sql = "INSERT INTO project (
     project_name,
     busi_id, 
     branch_no, 
     reason,
     objective,
     maingoal, 
     persons, 
     start_duration, 
     end_duration, 
     locations, 
     budget, 
     product, 
     indicator, 
     pro_status) VALUES ( 
    '$project_name', 
    '$busi_id', 
    '$branch_no', 
    '$reason',
    '$objective',
    '$maingoal',
    '$persons',
    '$start_duration',
    '$end_duration',
    '$locations',
    '$budget',
    '$product',
    '$indicator',
    'รอการอนุมัติ')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
} 
if(isset($_POST['formProjectEdit'])){
    $project_id = $_POST['project_id'];
    $projectName = $_POST['projectName'];
    $reason = $_POST['reason'];
    $objective = $_POST['objective'];
    $maingoal = $_POST['maingoal'];
    $persons = $_POST['persons'];
    $budget = $_POST['budget'];
    $product = $_POST['product'];
    $indicator = $_POST['indicator'];
    $locations = $_POST['locations'];
    $start_duration = $_POST['start_duration'];
    $end_duration = $_POST['end_duration'];
    $persons = json_encode($persons,JSON_UNESCAPED_UNICODE);
    $budget = json_encode($budget,JSON_UNESCAPED_UNICODE);

    $sql = "update project set
    project_name = '$projectName',
    reason = '$reason',
    objective = '$objective',
    maingoal = '$maingoal',
    persons = '$persons',
    start_duration = '$start_duration',
    end_duration = '$end_duration',
    locations = '$locations',
    product = '$product',
    indicator = '$indicator',
    budget = '$budget'
    where project_id = '$project_id'
    ";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
        print_r($sql);
    }

}
if(isset($_POST["delProject"])){
    $id = $_POST["project_id"];
    $sql = "delete from project where project_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }

}
?>