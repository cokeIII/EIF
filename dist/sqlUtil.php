<?php
    function genProvinces($conn){  
        $sql = "select * from provinces";
        $result = $conn->query($sql);
        $res = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res.='<option value="'.$row['id'].'">'.$row['name_th'].'</option>';
            }
        } 
        return $res;
    }
    function genProvincesSe($conn,$selected){  
        $sql = "select * from provinces";
        $result = $conn->query($sql);
        $res = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res.='<option value="'.$row['id'].'"';
                if($row['id'] == $selected){
                    $res.='selected'; 
                }
                $res.='>'.$row['name_th'].'</option>';
            }
        } 
        return $res;
    }
    function genAmphures($conn){  
        $sql = "select * from amphures";
        $result = $conn->query($sql);
        $res = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res.='<option value="'.$row['id'].'">'.$row['name_th'].'</option>';
            }
        } 
        return $res;
    }
    function genAmphuresSe($conn,$selected){  
        $sql = "select * from amphures";
        $result = $conn->query($sql);
        $res = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res.='<option value="'.$row['id'].'"';
                if($row['id'] == $selected){
                    $res.='selected'; 
                }
                $res.='>'.$row['name_th'].'</option>';
            }
        } 
        return $res;
    }
    function genDistricts($conn){  
        $sql = "select * from districts";
        $result = $conn->query($sql);
        $res = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res.='<option value="'.$row['id'].'">'.$row['name_th'].'</option>';
            }
        } 
        return $res;
    }
    function genDistrictsSe($conn,$selected){  
        $sql = "select * from districts";
        $result = $conn->query($sql);
        $res = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res.='<option value="'.$row['id'].'"';
                if($row['id'] == $selected){
                    $res.='selected'; 
                }
                $res.='>'.$row['name_th'].'</option>';
            }
        } 
        return $res;
    }
    function genGroupEEC($conn){
        $sql = "select * from group_eec";
        $result = $conn->query($sql);
        $res = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res.='<option value="'.$row['id'].'">'.$row['name_th'].'</option>';
            }
        } 
        return $res;
    }
    function genGroupEECSe($conn,$selected){
        $sql = "select * from group_eec";
        $result = $conn->query($sql);
        $res = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res.='<option value="'.$row['id'].'"';
                if($row['id'] == $selected){
                    $res.='selected'; 
                }
                $res.='>'.$row['name_th'].'</option>';
            }
        } 
        return $res;
    }
?>