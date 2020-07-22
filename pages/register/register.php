<!DOCTYPE html>
<html>
<head>
    <?php require_once "../conf.php";?>
    <?php require_once "../../dist/util.php";?>
    <?php require_once "../../dist/sqlUtil.php";?>
    <?php require_once "../connect.php";?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../dist/css/register.css">
  <link rel="stylesheet" href="../../dist/css/public.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition container bg-color">
<div class="">
  <div class="register-logo">
    <a href="#"><b class="h-txt">EIF</b></a>
  </div>

  <div class="card">
    <div class="card-body ">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post" id="formSearchVat" class="form mt-3">
          <div class="form-group">
              <label for="business_vat" class="col-md-2 control-label">ชื่อผู้ประกอบการฯ</label>
              <div class="input-group col-md-5">
                  <input  type="text" class="form-control" required="" id="business_name_search" name="business_vat"value="" placeholder="" minlength="3">
                  <span class="input-group-btn ml-3">
                      <button type="submit" id="btnSearchVat" class="btn btn-primary"><div class="fa fa-search mr-2"></div>ค้นหา</button>
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
                        <div class="input-group col-md-1">
                            <input type="text" class="form-control" required="" id="amount_emp" name="amount_emp"value="">
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
      <a href="../login/login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

</body>
</html>
<script>
  $(document).ready(function(){
    $("#formSearchVat").submit(function(e)  {
      $("#tableSearchVat").html('<div class="topic-search-vat mt-10">ค้นหาข้อมูลจากสรรพากร</div><div id="spinners" class="canter spinner loader"></div>')
      $("#spinners").show()
      $("#formInsert").hide()
      $("#tableSearchVat").show()
      setEmpty()
      e.preventDefault()
      $.ajax({
        type: 'post', 
        dataType: "json",
        url: '../tableVat/tableSearchVat.php',
        data: {submit:"nameSearchVat", name: $("#business_name_search").val()},
        success: function (data) {
          $("#spinners").hide()
          $("#tableSearchVat").html(data)
          $('#busiTable').dataTable();            
        },
    })
  }) 
  var rowData = {}
  $(document).on('change', '#province_id', function () {
    $.ajax({
        type: 'post', 
        dataType: "json",
        url: '../../dist/ajax.php',
        data: {provinces: true, id: $(this).val()},
        success: function (data) {
            $("#district_id").html("")
            $("#district_id").append(
                    '<option id="district_id_list" > -- กรุณาเลือกอำเภอ/เขต -- </option>'
                )

            $.each( data, function( key, value ) {
                $("#district_id").append(
                    '<option value="'+value.id+'">'+value.name+'</option>'
                )
            });
            $("#postcode").val("")
            $("#subdistrict_id").html('<option id="subdistrict_id_list"> -- กรุณาเลือกตำบล -- </option>')
        },
    })

  })
  let zipCode
  $(document).on('change', '#district_id', function () {
    $.ajax({
        type: 'post', 
        dataType: "json",
        url: '../../dist/ajax.php',
        data: {district_id: true, id: $(this).val()},
        success: function (data) {
            $("#subdistrict_id").html("")
            $("#subdistrict_id").append(
                '<option id="subdistrict_id_list"> -- กรุณาเลือกตำบล -- </option>'
            )

            $.each( data, function( key, value ) {
                $("#subdistrict_id").append(
                    '<option zip="'+value.zip_code+'" value="'+value.id+'">'+value.name+'</option>'
                )
            });
        },
    })

  })

  $(document).on('change', '#subdistrict_id', function () {
    $("#postcode").val($(this).val())
  })


  $(document).on('click', 'tr', function () {
    $(this).find('td').each(function() {
      var cellText = $(this).html()
      rowData[$(this).attr("key")] = cellText
    });
    let vDate = rowData.vBusinessFirstDate.split('/')
    let address = rowData.vaddress.split(',')
    $("#business_vat").val(rowData.vNID)
    $("#branch_number_vat").val(rowData.vBranchNumber)
    $("#business_name").val(replaceStr(rowData.vName))
    $("#registration_date").val(vDate[0]+"-"+vDate[1]+"-"+vDate[2])
    $("#postcode").val(rowData.vPostCode)
    $("#address_no").val(address[0]+" หมู่ "+address[1]+" ซอย "+address[2])
    $("#province_id").find("option").each(function(){
        if($(this).text() == address[5].replace(/ /g,"")){
            $(this).attr("selected", true)
        }
    })
    $("#district_id").find("option").each(function(){
        if($(this).text() == address[4].replace(/ /g,"")){
            $(this).attr("selected", true)
        }
    })
    $("#subdistrict_id").find("option").each(function(){
        if($(this).text() == address[3].replace(/ /g,"")){
            $(this).attr("selected", true)
        }
    })
    
    $("#formInsert").show()
    $("#tableSearchVat").hide()

  });

  $("#formRegister").submit(function(e){
        e.preventDefault()
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'dbRegister.php',
            data: {
                submit:"formRegister", 
                business_vat: $("#business_vat").val(),
                branch_number_vat: $("#branch_number_vat").val(),
                business_name: $("#business_name").val(),
                business_branch: $("#business_branch").val(),
                business_size: $("#business_size").val(),
                amount_emp: $("#amount_emp").val(),
                job_description: $("#job_description").val(),
                province_id: $("#province_id").val(),
                district_id: $("#district_id").val(),
                subdistrict_id: $("#subdistrict_id").val(),
                postcode: $("#postcode").val(),
                house_code: $("#house_code").val(),
                address_no: $("#address_no").val(),
                road: $("#road").val(),
                land: $("#land").val(),
                location: $("#location").val(),
                email: $("#email").val(),
                business_phone: $("#business_phone").val(),
                registration_date: $("#registration_date").val(),
                capital: $("#capital").val(),
                tax_break: $("#tax_break").val(),
            },
            success: function (data) {
                if(data){
                    alert("เพิ่มข้อมูลสำเร็จ")
                } else {
                    alert("ERROR เกิดข้อผิดพลาด")
                }
            },
        })
    }) 


  function replaceStr($str){
    return $str.replace(/-/g, "")
  }
  function setEmpty() {
    $("#business_vat").val("")
    $("#branch_number_vat").val("")
    $("#business_name").val("")
    $("#business_branch").val("")
    $("#amount_emp").val("")
    $("#job_description").val("")
    $("#house_code").val("")
    $("#address_no").val("")
    $("#road").val("")
    $("#land").val("")
    $("#location").val("")
    $("#email").val()
    $("#business_phone").val("")
    $("#registration_date").val("")
    $("#capital").val("")
  }
})
</script>