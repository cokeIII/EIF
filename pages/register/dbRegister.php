<?php
require_once "../connect.php";
if(isset($_POST['submit'])){
    $business_vat = $_POST['business_vat'];
    $branch_number_vat = $_POST['branch_number_vat'];
    $business_name = $_POST['business_name'];
    $business_branch = $_POST['business_branch'];
    $business_size = $_POST['business_size'];
    $amount_emp = $_POST['amount_emp'];
    $job_description = $_POST['job_description'];
    $province_id = $_POST['province_id'];
    $district_id = $_POST['district_id'];
    $subdistrict_id = $_POST['subdistrict_id'];
    $postcode = $_POST['postcode'];
    $house_code = $_POST['house_code'];
    $address_no = $_POST['address_no'];
    $road = $_POST['road'];
    $land = $_POST['land'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $business_phone = $_POST['business_phone'];
    $registration_date = $_POST['registration_date'];
    $capital = $_POST['capital'];
    $tax_break = $_POST['tax_break'];

    $sql = "INSERT INTO business (
    id , 
    branch_no , 
    business_name, 
    affiliation, 
    size,
    number_emp,
    job_description,
    province_id,
    amphure_id,
    district_id,
    post_code,
    house_number,
    home_number,
    road,
    country,
    map,
    email,
    tel,
    date_vat,
    regis_capital,
    tax_deduction,
    create_time
    )VALUES ( 
        '$business_vat', 
        '$branch_number_vat',
        '$business_name',
        '$business_branch',
        '$business_size',
        '$amount_emp',
        '$job_description',
        '$province_id',
        '$district_id',
        '$subdistrict_id',
        '$postcode',
        '$house_code',
        '$address_no',
        '$road',
        '$land',
        '$location',
        '$email',
        '$business_phone',
        '$registration_date',
        '$capital',
        '$tax_break',
         NOW()
    )";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}
?>