<?php 
require_once "../../dist/util.php"; 
require_once "../../dist/sqlUtil.php"; 
require_once "../connect.php";  
$jsonData = "";
$id = $_POST["id"];
$sql ="select * from business where id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$jsonData.='<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">แก้ไขข้อมูล สถานประกอบการ</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">บริษัท/อุตสาหกรรม</li>
        </ol>
        </div>
    </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="card" id="formProjects">
                    <div class="card-body">
                        <div class="card-header with-border">
                            <h3 class="card-title"></h3>
                        </div>
                        <form method="post" class="form-horizontal" id="formEditBusi" action="">
                            <input type="hidden" name="editBusiness" value="true">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="business_vat" class="col-md-2 control-label">เลขประจำตัวผู้เสียภาษี</label>
                                    <div class="input-group col-md-5">
                                    <input type="hidden" name="business_id" value="'.$row["id"].'">
                                    <input disabled type="text" class="form-control" required="" id="business_vat"  value="'.$row["id"].'">
                                        <span class="input-group-btn">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="branch_number_vat" class="col-md-2 control-label">รหัสสาขา</label>
                                    <div class="input-group date col-md-4">
                                        <input type="hidden" name="branch_number_vat" value="'.$row["branch_no"].'">
                                        <input  disabled type="text" class="form-control" required="" id="branch_number_vat" value="'.$row["branch_no"].'">
                                    </div>
                                </div>

                                <div id="form-insert">
                                <div class="form-group">
                                    <label for="business_name" class="col-md-2 control-label">ชื่อสถานประกอบการ</label>
                                    <div class="input-group col-md-5">
                                        <input type="text" class="form-control" required="" id="business_name"name="business_name" value="'.$row["business_name"].'">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="business_branch" class="col-md-2 control-label">สาขา/หน่วยงานภายใต้สังกัด</label>
                                    <div class="input-group col-md-4">
                                        <input type="text" class="form-control" id="business_branch"name="business_branch"value="'.$row["affiliation"].'">
                                    </div>
                                </div>';
                                
                                
                                    $business_opt = array('ไม่ระบุ' => 'ไม่ระบุ','SME'=>'SME', 'เล็ก' => 'เล็ก', 'กลาง' => 'กลาง', 'ใหญ่' => 'ใหญ่');
                                

                                $jsonData.='<div class="form-group">
                                    <label for="business_size" class="col-md-3 control-label">ขนาดสถานประกอบการ</label>
                                    <div class="input-group col-md-2">
                                        <select class="form-control" id="business_size" name="business_size">
                                            '; $jsonData.=genOptionSe($business_opt,$row["size"]);

                                        $jsonData.='</select>
                                    </div>
                                </div>   

                                <div class="form-group">
                                    <label for="amount_emp" class="col-md-2 control-label">จำนวนพนักงาน</label>
                                    <div class="input-group col-md-2">
                                        <input type="text" class="form-control" required="" id="amount_emp" name="amount_emp" value="'.$row["number_emp"].'">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="job_description" class="col-md-2 control-label">ลักษณะงาน</label>
                                    <div class="input-group col-md-4">
                                        <textarea class="form-control" id="job_description" rows="3" name="job_description">'.$row["job_description"].'</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="group_eec" class="col-md-2 control-label">กลุ่มอุตสาหกรรม</label>
                                    <div class="input-group col-md-4">
                                        <select class="form-control" id="group_eec" name="group_eec" required>
                                            <option id="groupEEC_id_list" disabled selected  value=""> -- กรุณาเลือกกลุ่ม -- </option>';
                                            $jsonData.=genGroupEECSe($conn,$row["group_id"]);
                                        $jsonData.='</select>
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-offset-1">ที่ตั้งสถานประกอบการ</label>
                                </div>
                                <div class="form-group">
                                    <label for="province_id" class="col-md-2 control-label">จังหวัด</label>
                                    <div class="input-group col-md-2">
                                        <select class="form-control select2" id="province_id" name="province_id">
                                        <option id="province_id_list" disabled selected  value=""> -- กรุณาเลือกจังหวัด -- </option>';
                                        $jsonData.=genProvincesSe($conn,$row["province_id"]);
                                        $jsonData.='</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="district_id" class="col-md-2 control-label">อำเภอ/เขต</label>
                                    <div class="input-group col-md-2">
                                        <select class="form-control select2" id="district_id" name="district_id">
                                            <option id="district_id_list" disabled selected  value=""> -- กรุณาเลือกอำเภอ/เขต -- </option>';
                                            $jsonData.=genAmphuresSe($conn,$row["amphure_id"]);
                                            $jsonData.='</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subdistrict_id" class="col-md-2 control-label">ตำบล/แขวง</label>
                                    <div class="input-group col-md-2">
                                        <select class="form-control select2" id="subdistrict_id" name="subdistrict_id">
                                            <option id="subdistrict_id_list" disabled selected  value=""> -- กรุณาเลือกตำบล -- </option>';
                                            $jsonData.=genDistrictsSe($conn,$row["district_id"]);
                                            $jsonData.='</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="postcode" class="col-md-2 control-label">รหัสไปรษณีย์</label>
                                    <div class="input-group col-md-2">
                                        <input type="text" class="form-control" required="" id="postcode" name="postcode" value="'.$row["post_code"].'">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="house_code" class="col-md-2 control-label">เลขรหัสประจำบ้าน</label>
                                    <div class="input-group col-md-3">
                                        <input type="text" class="form-control" id="house_code" name="house_code" placeholder="เลขรหัสประจำบ้าน 11 หลัก"  value="'.$row["house_number"].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address_no" class="col-md-2 control-label">เลขที่</label>
                                    <div class="input-group col-md-3">
                                        <input type="text" class="form-control" required="" id="address_no" name="address_no" placeholder="บ้านเลขที่ หมู่ ซอย"  value="'.$row["home_number"].'">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="road" class="col-md-2 control-label">ถนน</label>
                                    <div class="input-group col-md-2">
                                        <input type="text" class="form-control" id="road" name="road"  value="'.$row["road"].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="land" class="col-md-2 control-label">ประเทศ</label>
                                    <div class="input-group col-md-2">
                                        <input type="text" class="form-control" id="land" placeholder="ประเทศไทย" name="land" value="ประเทศไทย">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="location" class="col-md-2 control-label">พิกัดแผนที่</label>
                                    <div class="input-group col-md-4">
                                        <input type="text" class="form-control" placeholder="หาจาก google maps" id="location" name="location" value="'.$row["map"].'">
                                        <div class="input-group-addon">
                                            <a href="https://www.google.com/maps" target="_blank">
                                                <i class="fa fa-map ml-3"></i>
                                            </a> 
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="email" class="col-md-2 control-label">อีเมล์</label>
                                    <div class="input-group col-md-3">
                                        <input type="email" class="form-control" id="email" placeholder="อีเมล์หลักของสถานประกอบการ"name="email"value="'.$row["email"].'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="business_phone" class="col-md-2 control-label">เบอร์โทรศัพท์</label>
                                    <div class="input-group col-md-3">
                                        <input type="text" class="form-control"  id="business_phone" name="business_phone" placeholder="เบอร์โทรศัพท์ของสถานประกอบการ" value="'.$row["tel"].'">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="registration_date" class="col-md-2 control-label">วันที่จดทะเบียน</label>
                                    <div class="input-group date col-md-3">
                                        <input type="date" class="form-control pull-right" id="registration_date" name="registration_date" value="'.$row["date_vat"].'" />
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar ml-3"></i>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="capital" class="col-md-2 control-label">ทุนการจดทะเบียน</label>
                                    <div class="input-group col-md-2">
                                        <input type="number" min="0" class="form-control" id="capital"name="capital" value="'.$row["regis_capital"].'">
                                    </div>
                                </div>';
                                
                                $tax_break_opt = array('ใช้สิทธิ์' => 'ใช้สิทธิ์', 'กำลังดำเนินการ' => 'กำลังดำเนินการ', 'ไม่ใช้สิทธิ์' => 'ไม่ใช้สิทธิ์');
                                
                                $jsonData.='<div class="form-group">
                                    <label for="tax_break" class="col-md-2 control-label">การลดหย่อนภาษี</label>
                                    <div class="input-group col-md-2">
                                        <select class="form-control" id="tax_break"name="tax_break">';
                                        $jsonData.=genOptionSe($tax_break_opt,$row["tax_deduction"]);
                                        $jsonData.='</select>
                                    </div>
                                </div> 
            
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="submit" class="btn btn-primary" name="submit">แก้ไขข้อมูล</button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </form> 
                    </div>  
                </div>  
            </div>  
        </div>
    </div> 
</section>'; 
echo json_encode($jsonData);
