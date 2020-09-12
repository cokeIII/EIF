<?php
    require_once "../connect.php";

    if(isset($_POST["editBusiness"])){
        $business_name = $_POST["business_name"];
        $affiliation = $_POST["business_branch"];
        $size = $_POST["business_size"];
        $number_emp = $_POST["amount_emp"];
        $job_description = $_POST["job_description"];
        $province_id = $_POST["province_id"];
        $amphure_id = $_POST["district_id"];
        $district_id = $_POST["subdistrict_id"];
        $post_code = $_POST["postcode"];
        $house_number = $_POST["house_code"];
        $home_number = $_POST["address_no"];
        $road = $_POST["road"];
        $country = $_POST["land"];
        $map = $_POST["location"];
        $email = $_POST["email"];
        $tel = $_POST["business_phone"];
        $date_vat = $_POST["registration_date"];
        $regis_capital = $_POST["capital"];
        $tax_deduction = $_POST["tax_break"];
        $group_id = $_POST["group_eec"];
        $id = $_POST["business_id"];
        if($date_vat == ''){$date_vat = '0000-00-00';}
        $sql = "update business set 
        business_name = '$business_name',
        affiliation = '$affiliation',
        size = '$size',
        number_emp = '$number_emp',
        job_description = '$job_description',
        province_id = '$province_id',
        amphure_id = '$amphure_id',
        district_id = '$district_id',
        post_code = '$post_code',
        house_number = '$house_number',
        home_number = '$home_number',
        road = '$road',
        country = '$country',
        map = '$map',
        email = '$email',
        tel = '$tel',
        date_vat = '$date_vat',
        regis_capital = '$regis_capital',
        tax_deduction = '$tax_deduction',
        group_id = '$group_id'        
         where id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo $sql;
        }

    }
    
    if(isset($_POST["delBusi"])){
        $id = $_POST["bus_id"];
        $sql = "delete from business where id = '$id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

?>