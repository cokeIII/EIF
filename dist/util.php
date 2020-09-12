<?php
    function setBranchNumber($BranchNumber){
        if($BranchNumber == 0){
            $r =  "สำนักงานใหญ่";
        } else {
            strlen($BranchNumber);
            $r = strrev(str_pad($BranchNumber,5,"0"));
        }
        return $r;
    }
    function EC3($provinceName){
        $name = array("ชลบุรี" => true ,"ระยอง" => true,"ฉะเชิงเทรา" => true);
        return isset($name[$provinceName]);                     
    }

    function genOption($opt){
        $res = "";
        foreach ($opt as $key => $value) {
            $res.='<option value="'.$value.'">'.$value.'</option>';
        }
        return $res;
    }
    function genOptionSe($opt,$selected){
        $res = "";
        foreach ($opt as $key => $value) {
            $res.='<option value="'.$value.'" ';
                if($value == $selected){
                    $res.='selected'; 
                }
            $res.='>'.$value.'</option>';
        }
        return $res;
    }
?>