<!DOCTYPE html>
<html>
<head>
  <?php require_once "../conf.php";?>
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
      <div id="tableSearchVat" class="mt-5 table-responsive" >
          <div class="topic-search-vat mt-10">ค้นหาข้อมูลจากสรรพากร</div>
          <div id="spinners" class="fas fa-spinner fa-spin spinners collapse"></div>                            
      </div>
      <!-- END tableSearchVat -->

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
    $("#formSearchVat").submit(function(e){
        $("#tableSearchVat").html('<div class="topic-search-vat mt-10">ค้นหาข้อมูลจากสรรพากร</div><i id="spinners" class="fa fa-spinner fa-spin spinners collapse"></i>')
        $("#spinners").show()
        e.preventDefault()
        $.ajax({
            type: 'post', 
            dataType: "json",
            url: '../tableVat/tableSearchVat.php',
            data: {submit:"nameSearchVat", name: $("#business_name_search").val()},
            success: function (data) {
                $("#spinners").hide()
                $("#tableSearchVat").html(data)
                $("#busiTable").dataTable()
            },
        })

    }) 
    $('#busiTable tbody').on('click', 'tr', function () {
      var data = table.row($(this).closest('tr')).data();
      console.log(data)
      // alert(data[Object.keys(data)[0]]+' s phone: '+data[Object.keys(data)[1]]);
    });

    // $(document).on('click','#rowData',function(){
    //     $('#formSearchVat').hide()
    //     $('#tableSearchVat').hide()
    //     $('#formInsert').show()  
        
    //     var dataBusi = JSON.parse('<?php if(isset($_SESSION['dataBusi'])){echo json_encode($_SESSION['dataBusi']);} ?>')
    //     var vNID = $(this).attr('val')
    //     console.log(vNID)
    //     // $.each(dataBusi, function( index, value ) {
    //     //   console.log(value.vNID)
    //     //     if(value.vNID == vNID){
    //     //         console.log(value)
    //     //     }
    //     // });
    // });
})
</script>