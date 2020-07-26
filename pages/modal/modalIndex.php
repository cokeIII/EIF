<!-- LOGIN -->
<div class="modal fade" id="modal-login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เข้าสู่ระบบ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="pages/login/dbLogin.php" method="post" id="loginForm">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">เลขประจำตัวผู้เสียภาษี</label>
              <input type="tel" maxlength="13" name="username" class="form-control" id="username" placeholder="เลขประจำตัวผู้เสียภาษี 13 หลัก" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">รหัสผ่าน</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="">
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="#" class="text-center" id="register" data-toggle="modal" data-target="#modal-register">สมัครเข้าใช้งาน</a>
            <button type="submit" name="submit" class="btn btn-primary float-sm-right color-menu">ตกลง</button>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- END LOGIN -->
<!-- REGISTER-->
<div class="modal fade" id="modal-register">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">สมัครเข้าใช้งาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="formSearchVat" class="form mt-3">
            <div class="form-group">
                <label for="business_vat" class="col-md-3 control-label">ชื่อผู้ประกอบการฯ</label>
                <div class="input-group col-md-5">
                    <input  type="text" class="form-control" required="" id="business_name_search" name="business_vat"value="" placeholder="" minlength="3">
                    <span class="input-group-btn ml-3">
                        <button type="submit" id="btnSearchVat" class="btn color-menu"><div class="fa fa-search mr-2"></div>ค้นหา</button>
                    </span>
                </div>
            </div>
            <hr class="hr"></hr>
        </form>

        <!-- tableSearchVat -->
        <div id="tableSearchVat" class="mt-5" >
            <div class="topic-search-vat mt-10">ค้นหาข้อมูลจากสรรพากร</div>
            <div id="spinners" class="canter spinner loader collapse"></div>                            
        </div>
        <!-- END tableSearchVat -->
        <div class="box info-box collapse" id="formInsert">
            <div class="box-header with-border">
                <h3 class="box-title">แบบฟอร์มสำหรับกรอกข้อมูลสถานประกอบการ</h3>
            </div>
            <form method="post" class="form-horizontal" id="formRegister" action="">
                <div class="box-body">
                    <div class="form-group">
                        <label for="business_vat" class="col-md-2 control-label">เลขประจำตัวผู้เสียภาษี</label>
                        <div class="input-group col-md-5">
                            <input type="hidden" name="vat_id" id="vat_id" value="">
                            <input disabled type="text" class="form-control" required="" id="business_vat" name="business_vat"value="">
                            <span class="input-group-btn">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="branch_number_vat" class="col-md-2 control-label">รหัสสาขา</label>
                        <div class="input-group date col-md-4">
                            <input type="hidden" name="vat_branch_no" id="vat_branch_no" value="">
                            <input  disabled type="text" class="form-control" required="" id="branch_number_vat" name="branch_number_vat" value="">
                        </div>
                    </div>

                    <div id="form-insert">
                    <div class="form-group">
                        <label for="business_name" class="col-md-2 control-label">ชื่อสถานประกอบการ</label>
                        <div class="input-group col-md-5">
                            <input type="text" class="form-control" required="" id="business_name"name="business_name"value="">
                            <div class="input-group-addon">
                                <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_branch" class="col-md-2 control-label">สาขา/หน่วยงานภายใต้สังกัด</label>
                        <div class="input-group col-md-4">
                            <input type="text" class="form-control" id="business_branch"name="business_branch"value="">
                        </div>
                    </div>
                    
                    <?php
                        $business_opt = array('ไม่ระบุ' => 'ไม่ระบุ','SME'=>'SME', 'เล็ก' => 'เล็ก', 'กลาง' => 'กลาง', 'ใหญ่' => 'ใหญ่');
                    ?>

                    <div class="form-group">
                        <label for="business_size" class="col-md-3 control-label">ขนาดสถานประกอบการ</label>
                        <div class="input-group col-md-2">
                            <select class="form-control" id="business_size" name="business_size">
                                <?php genOption($business_opt)?>
                            </select>
                        </div>
                    </div>    

                    <div class="form-group">
                        <label for="amount_emp" class="col-md-2 control-label">จำนวนพนักงาน</label>
                        <div class="input-group col-md-2">
                            <input type="text" class="form-control" required="" id="amount_emp" name="amount_emp"value="">
                            <div class="input-group-addon">
                                <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="job_description" class="col-md-2 control-label">ลักษณะงาน</label>
                        <div class="input-group col-md-4">
                            <textarea class="form-control" id="job_description" rows="3" name="job_description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-offset-1">ที่ตั้งสถานประกอบการ</label>
                    </div>
                    <div class="form-group">
                        <label for="province_id" class="col-md-2 control-label">จังหวัด</label>
                        <div class="input-group col-md-2">
                            <select class="form-control select2" id="province_id" name="province_id">
                            <option id="province_id_list" > -- กรุณาเลือกจังหวัด -- </option>
                                <?php genProvinces($conn); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="district_id" class="col-md-2 control-label">อำเภอ/เขต</label>
                        <div class="input-group col-md-2">
                            <select class="form-control select2" id="district_id" name="district_id">
                                <option id="district_id_list" > -- กรุณาเลือกอำเภอ/เขต -- </option>
                                <?php genAmphures($conn)?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subdistrict_id" class="col-md-2 control-label">ตำบล/แขวง</label>
                        <div class="input-group col-md-2">
                            <select class="form-control select2" id="subdistrict_id" name="subdistrict_id">
                                <option id="subdistrict_id_list"> -- กรุณาเลือกตำบล -- </option>
                                <?php genDistricts($conn)?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postcode" class="col-md-2 control-label">รหัสไปรษณีย์</label>
                        <div class="input-group col-md-2">
                            <input type="text" class="form-control" required="" id="postcode" name="postcode" value="">
                            <div class="input-group-addon">
                                <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="house_code" class="col-md-2 control-label">เลขรหัสประจำบ้าน</label>
                        <div class="input-group col-md-3">
                            <input type="text" class="form-control" id="house_code" name="house_code" placeholder="เลขรหัสประจำบ้าน 11 หลัก"  value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address_no" class="col-md-2 control-label">เลขที่</label>
                        <div class="input-group col-md-3">
                            <input type="text" class="form-control" required="" id="address_no" name="address_no" placeholder="บ้านเลขที่ หมู่ ซอย"  value="">
                            <div class="input-group-addon">
                                <i class="fa fa-asterisk ml-3" style="color:red;" aria-hidden="true"> บังคับ</i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="road" class="col-md-2 control-label">ถนน</label>
                        <div class="input-group col-md-2">
                            <input type="text" class="form-control" id="road" name="road"  value="">
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
                            <input type="text" class="form-control" placeholder="หาจาก google maps" id="location" name="location" value="">
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
                            <input type="email" class="form-control" id="email" placeholder="อีเมล์หลักของสถานประกอบการ"name="email"value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_phone" class="col-md-2 control-label">เบอร์โทรศัพท์</label>
                        <div class="input-group col-md-3">
                            <input type="text" class="form-control"  id="business_phone" name="business_phone" placeholder="เบอร์โทรศัพท์ของสถานประกอบการ"value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="registration_date" class="col-md-2 control-label">วันที่จดทะเบียน</label>
                        <div class="input-group date col-md-3">
                            <input type="date" class="form-control pull-right" id="registration_date" name="registration_date" value="" />
                            <div class="input-group-addon">
                                <i class="fa fa-calendar ml-3"></i>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="capital" class="col-md-2 control-label">ทุนการจดทะเบียน</label>
                        <div class="input-group col-md-2">
                            <input type="number" min="0" class="form-control" id="capital"name="capital"value="">
                        </div>
                    </div> 
                    <?php
                    $tax_break_opt = array('ใช้สิทธิ์' => 'ใช้สิทธิ์', 'กำลังดำเนินการ' => 'กำลังดำเนินการ', 'ไม่ใช้สิทธิ์' => 'ไม่ใช้สิทธิ์');
                    ?>
                    <div class="form-group">
                        <label for="tax_break" class="col-md-2 control-label">การลดหย่อนภาษี</label>
                        <div class="input-group col-md-2">
                            <select class="form-control" id="tax_break"name="tax_break">
                            <?php genOption($tax_break_opt)?>
                            </select>
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </div>
                </div>
            </form>   
        </div>                             
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- END REGISTER -->
