<?php require_once "../conf.php";
require_once "../connect.php";
require_once "../../dist/util.php";
$jsonData ="";
$project_id = $_POST["project_id"];
$sql = "select * from project where project_id = '$project_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$jsonData.='<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">แก้ไขโครงการ</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">โครงการ</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <form id="formProjectEdit" method="post" class="form-horizontal" action="">
                    <input type="hidden" id="busi_id" value="'.$_SESSION["id"].'">
                    <input type="hidden" id="branch_no" value="'.$_SESSION["branch_no"].'">
                    <input type="hidden" id="project_id" value="'.$project_id.'">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="editProjectName" class="col-md-2 control-label h5">1. ชื่อโครงการ</label>
                            <div class="input-group col-md-5">
                                <input  type="text" class="form-control" required="" id="editProjectName" name="editProjectName" value="'.$row["project_name"].'" required="">
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editReason" class="col-md-3 control-label h5">2. หลักการและเหตุผล</label>
                            <div class="input-group col-md-5">
                                <textarea name="editReason" class="form-control" id="editReason" cols="30" rows="5" required="">'.$row["reason"].'</textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editObjective" class="col-md-2 control-label h5">3. วัตถุประสงค์</label>
                            <div class="input-group col-md-5">
                                <textarea name="editObjective" class="form-control" id="editObjective" cols="30" rows="5" required="">'.$row["objective"].'</textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editMainGoal" class="col-md-2 control-label h5">4. เป้าหมายหลัก</label>
                            <div class="input-group col-md-5">
                                <textarea name="editMainGoal" class="form-control" id="editMainGoal" cols="30" rows="5" required="">'.$row["maingoal"].'</textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editPersons" class="col-md-3 control-label h5">5. ผู้รับผิดชอบโครงการ</label>
                            <div class="input-group col-md-1 ml-2">
                                <label for="personsNum" class="control-label">จำนวนคน</label>';
                                $personsArray = json_decode($row["persons"], true);
                                $jsonData.='<input class="form-control" type="number" id="personsNum" name="personsNum"  min="1" max="50" value="'.count($personsArray).'">
                            </div>
                            <div class="input-group col-md-12">
                                <div id="inputPerson" class="col-md-12">';

                                
                                $i = 0;
                                foreach ($personsArray as $key => $value) {
                                    $i++;
                                $jsonData.='<div class="row" rid="'.$i.'">'.
                                    '<label for="perName" class="col-md-2 control-label">ชื่อผู้รับผิดชอบ</label>'.
                                    '<input rows="'.$i.'" type="text" class="addPerson col-md-3 mt-1 form-control" required="" id="perName" name="perName" value="'.$value["perName"].'" placeholder="ชื่อผู้รับผิดชอบ หรือหน่วยงาน" required="">'.
                                    '<label for="tel" class="mr-1 col-md-1 control-label">โทรศัพท์ </label>'.
                                    '<input rows="'.$i.'" type="tel" class="addPerson col-md-2 mt-1 form-control" required="" id="tel" name="tel" value="'.$value["tel"].'" required="">'.
                                    '<label for="email" class="col-md-1 control-label">E-mail</label>'.
                                    '<input rows="'.$i.'" type="email" class="addPerson col-md-2 mt-1 form-control" required="" id="email" name="email" value="'.$value["email"].'" required="">'.
                                '</div>';
                
                                }

                                $jsonData.='</div>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editDuration" class="col-md-2 control-label h5">7. ระยะเวลา</label>
                            <div class="input-group col-md-7">
                                <label for="starteditDuration" class="col-md-2 control-label">เริ่ม</label>
                                <input name="starteditDuration" type="date" class=" col-md-5 form-control" id="editStartDuration" value="'.$row["start_duration"].'">
                                <label for="endeditDuration" class="col-md-2 control-label">สิ้นสุด</label>
                                <input name="starteditDuration" type="date" class="col-md-5 form-control" id="editEndDuration" value="'.$row["end_duration"].'">
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editLocation" class="col-md-2 control-label h5">8. สถานที่</label>
                            <div class="input-group col-md-5">
                                <input name="editLocation" type="text" class="form-control" id="editLocation" value="'.$row["locations"].'">
                            </div>
                        </div>
                        <hr class="hr">';
                        $budgetArray = json_decode($row["budget"], true);
                        $jsonData.='<div class="form-group">
                            <label for="editBudget" class="col-md-2 control-label h5">9. งบประมาณ</label>
                            <div class="input-group col-md-6">
                                <label for="editBudget" class="col-md-5 control-label ">เงินงบประมาณ รวมทั้งสิ้น</label>
                                <input name="editBudget" type="number" class="col-md-4 form-control" id="editBudget" min="1" value="'.$budgetArray["sumPrice"].'"> <div class="ml-1">บาท</div>
                            </div>
                            <div class="input-group col-md-12 mt-1">
                                <label for="budgetNum" class="col-md-2 control-label mr-2">จำนวนค่าใช้จ่าย</label>
                                <input class=" col-md-1 form-control" type="number" id="budgetNum" name="budgetNum" value="'.(count($budgetArray)-1).'" min="1" >
                                <h6 class="col-md-12 control-label">รายละเอียด</h6>
                                <div id="inputBudget" class="col-md-12">';
                                
                                $j = 0;
                                foreach ($budgetArray as $key => $value) {
                                    $j++;
                                    if($key != "sumPrice"){
                                    $jsonData.='<div class="row" rid="'.$j.'">'.
                                    ''.
                                        '<input rows="'.$j.'" type="text" class="addBudget col-md-2 mt-1 form-control" required="" id="disBudget" name="disBudget" value="'.$value["disBudget"].'" placeholder="ค่าอาหารและเครื่องดื่ม" required="">'.
                                        '<label for="num" class="mr-1 col-md-1 control-label">จำนวน</label>'.
                                        '<input rows="'.$j.'" type="number" class="addBudget col-md-1 mt-1 form-control" required="" id="num" name="num" value="'.$value["num"].'" required="">'.
                                        '<label for="unit" class="mr-1 col-md-1 control-label">หน่วยนับ</label>'.
                                        '<input rows="'.$j.'" type="text" class="addBudget col-md-1 mt-1 form-control" required="" id="unit" name="unit" value="'.$value["unit"].'" placeholder="มื้อ" required="">'.
                                        '<label for="price" class="col-md-2 control-label">ราคาหน่วยละ</label>'.
                                        '<input rows="'.$j.'" type="number" class="addBudget col-md-2 mt-1 form-control" required="" id="price" name="price" value="'.$value["price"].'" required="">'.
                                    '</div>';
                                    }
                                }
                
                                $jsonData.='</div>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editProduct" class="col-md-5 control-label h5">10. ผลผลิต/ผลลัพธ์/ประโยชน์ที่คาดว่าจะได้รับ</label>
                            <div class="input-group col-md-5">
                                <textarea name="editProduct" class="form-control" id="editProduct" cols="30" rows="5">'.$row["product"].'</textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editIndicator" class="col-md-5 control-label h5">11. วิธีการประเมินผลและดัชนีชี้วัดความสำเร็จของโครงการ</label>
                            <div class="input-group col-md-5">
                                <textarea name="editIndicator" class="form-control" id="editIndicator" cols="30" rows="5">'.$row["indicator"].'</textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="editIndicator" class="col-md-5 control-label h5">12. สถานะ</label>
                            <div class="input-group col-md-5">
                                <select name="proStatus" id="proStatus" class="form-control">';
                                if($_SESSION["status"] == "admin"){
                                $jsonData.='<option value="รอการอนุมัติ">รอการอนุมัติ</option>
                                    <option value="ผ่านการอนุมัติ">ผ่านการอนุมัติ</option>
                                    <option value="ไม่ผ่านการอนุมัติ">ไม่ผ่านการอนุมัติ</option>';
                                }
                                $jsonData.='<option value="ขั้นดำเนินกิจกรรม">ขั้นดำเนินกิจกรรม</option>
                                    <option value="ดำเนินงานแล้วเสร็จ">ดำเนินงานแล้วเสร็จ</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-5">แก้ไขโครงการ</button>
                    </div>
                </form>                                
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>';

echo json_encode($jsonData);
