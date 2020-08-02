<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once "../conf.php";?>
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">แบบฟอร์มเสนอโครงการ</h1>
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
            <div class="card" id="formProjects">
                <form id="formProjectInsert" method="post" class="form-horizontal" action="">
                    <input type="hidden" id="busi_id" value="<?php echo $_SESSION["id"]; ?>">
                    <input type="hidden" id="branch_no" value="<?php echo $_SESSION["branch_no"]; ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="projectName" class="col-md-2 control-label h5">1. ชื่อโครงการ</label>
                            <div class="input-group col-md-5">
                                <input  type="text" class="form-control" required="" id="projectName" name="projectName" value="" required="">
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="reason" class="col-md-3 control-label h5">2. หลักการและเหตุผล</label>
                            <div class="input-group col-md-5">
                                <textarea name="reason" class="form-control" id="reason" cols="30" rows="5" required=""></textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="objective" class="col-md-2 control-label h5">3. วัตถุประสงค์</label>
                            <div class="input-group col-md-5">
                                <textarea name="reason" class="form-control" id="objective" cols="30" rows="5" required=""></textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="mainGoal" class="col-md-2 control-label h5">4. เป้าหมายหลัก</label>
                            <div class="input-group col-md-5">
                                <textarea name="mainGoal" class="form-control" id="mainGoal" cols="30" rows="5" required=""></textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="persons" class="col-md-3 control-label h5">5. ผู้รับผิดชอบโครงการ</label>
                            <div class="input-group col-md-1 ml-2">
                                <label for="personsNum" class="control-label">จำนวนคน</label>
                                <input class="form-control" type="number" id="personsNum" name="personsNum" value="1" min="1" max="50">
                            </div>
                            <div class="input-group col-md-12">
                                <div id="inputPerson" class="col-md-12">

                                </div>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="duration" class="col-md-2 control-label h5">7. ระยะเวลา</label>
                            <div class="input-group col-md-7">
                                <label for="startDuration" class="col-md-2 control-label">เริ่ม</label>
                                <input name="startDuration" type="date" class=" col-md-5 form-control" id="startDuration">
                                <label for="endDuration" class="col-md-2 control-label">สิ้นสุด</label>
                                <input name="startDuration" type="date" class="col-md-5 form-control" id="endDuration">
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="location" class="col-md-2 control-label h5">8. สถานที่</label>
                            <div class="input-group col-md-5">
                                <input name="location" type="text" class="form-control" id="location" >
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="budget" class="col-md-2 control-label h5">9. งบประมาณ</label>
                            <div class="input-group col-md-6">
                                <label for="budget" class="col-md-5 control-label ">เงินงบประมาณ รวมทั้งสิ้น</label>
                                <input name="budget" type="number" class="col-md-4 form-control" id="budget" min="1"> <div class="ml-1">บาท</div>
                            </div>
                            <div class="input-group col-md-12 mt-1">
                                <label for="budgetNum" class="col-md-2 control-label mr-2">จำนวนค่าใช้จ่าย</label>
                                <input class=" col-md-1 form-control" type="number" id="budgetNum" name="budgetNum" value="1" min="1" >
                                <h6 class="col-md-12 control-label">รายละเอียด</h6>
                                <div id="inputBudget" class='col-md-12'>

                                </div>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="product" class="col-md-5 control-label h5">10. ผลผลิต/ผลลัพธ์/ประโยชน์ที่คาดว่าจะได้รับ</label>
                            <div class="input-group col-md-5">
                                <textarea name="product" class="form-control" id="product" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="form-group">
                            <label for="indicator" class="col-md-5 control-label h5">11. วิธีการประเมินผลและดัชนีชี้วัดความสำเร็จของโครงการ</label>
                            <div class="input-group col-md-5">
                                <textarea name="indicator" class="form-control" id="indicator" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        <button type="submit" class="btn btn-primary mb-5">เสนอโครงการ</button>
                    </div>
                </form>                                
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>


