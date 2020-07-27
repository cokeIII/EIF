<?php
    function genProvinces($conn){  
        $sql = "select * from provinces";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">'.$row['name_th'].'</option>';
            }
        } 
    }
    function genAmphures($conn){  
        $sql = "select * from amphures";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">'.$row['name_th'].'</option>';
            }
        } 
    }
    function genDistricts($conn){  
        $sql = "select * from districts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">'.$row['name_th'].'</option>';
            }
        } 
    }
    function genGroupEEC($conn){
        $sql = "select * from group_eec";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">'.$row['name_th'].'</option>';
            }
        } 
    }
?>