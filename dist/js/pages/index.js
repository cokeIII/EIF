$(document).ready(function(){
    $(document).on('click','#project',function(){
        $('#mainContent').load("pages/project/project.php")
    })
    $(document).on('click','#eec',function(){
        $('#mainContent').load("pages/about/eec.php")
    })
    $(document).on('click','#projectPilot',function(){
        $('#mainContent').load("pages/about/projectPilot.php")
    })
    $(document).on('click','#eecTen',function(){
        $('#mainContent').load("pages/about/eecTen.php")
    })
    $(document).on('click','#eecProAll',function(){
        $('#mainContent').load("pages/about/eecProAll.php")
    })
    $(document).on('click','#preProject',function(){
        $('#mainContent').load("pages/project/preProject.php")
    })
    $(document).on('click','#register',function(){
        $("#tableSearchVat").html('<div class="topic-search-vat mt-10">ค้นหาข้อมูลจากสรรพากร</div><div id="spinners" class="canter spinner loader"></div>')
        $("#spinners").hide()
        $("#formInsert").hide()
        $("#tableSearchVat").show()
        // Swal.fire(
        //     'Good job!',
        //     'You clicked the button!',
        //     'success'
        // )
    })
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
          url: 'pages/tableVat/tableSearchVat.php',
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
          url: 'dist/ajax.php',
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
          url: 'dist/ajax.php',
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
  
  
    $(document).on('click', '.row-vat', function () {
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
        let password = $("#passRegis").val()
        if(password != $("#passCon").val()){
            $("#checkPass").html(
                '<b style="color: red;" class="ml-3">รหัสผ่านไม่ตรงกัน</b>'
            )
            return
        }
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: 'pages/register/dbRegister.php',
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
                password: password,
                group_eec: $("#group_eec").val(),
            },
            success: function (data) {
                if(data){
                Swal.fire({
                    icon: 'success',
                    title: 'สมัครใช้งานสำเร็จ',
                    text: '',
                    footer: ''   
                })
                $("#regisContent").html("")
                $('#modal-register').modal('hide');
                } else {
                Swal.fire({
                    icon: 'error',
                    title: 'สมัครใช้งานไม่สำเร็จ',
                    text: '',
                    footer: ''   
                })
                }
            },
        })
    }) 

  
    function replaceStr($str){
      return $str.replace(/-/g, "")
    }

})
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

