<?php

require_once "../connect.php";
if(isset($_POST['submit'])){
    $project_name = $_POST['projectName'];
    $reason = $_POST['reason'];
    $maingoal = $_POST['maingoal'];
    $persons = $_POST['persons'];
    $start_duration = $_POST['start_duration'];
    $end_duration = $_POST['end_duration'];
    $locations = $_POST['locations'];
    $budget = $_POST['budget'];
    $product = $_POST['product'];
    $indicator = $_POST['indicator'];
    $persons = json_encode($persons);
    $budget = json_encode($budget);
    $sql = "INSERT INTO project (project_name, reason, maingoal, persons, start_duration,end_duration,locations,budget,product,indicator)VALUES ( '$project_name', '$reason',' $maingoal','$persons','$start_duration','$end_duration','$locations','$budget','$product','$indicator')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}
?>