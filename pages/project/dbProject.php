<?php

require_once "../connect.php";
if(isset($_POST['submit'])){
    $project_name = $_POST['projectName'];
    $busi_id = $_POST['busi_id'];
    $branch_no = $_POST['branch_no'];
    $reason = $_POST['reason'];
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
?>