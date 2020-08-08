<?php 
    require_once "../conf.php";
    require_once "../connect.php";
    require_once "../../dist/util.php";
    $sql = "select b.id as Bid, b.branch_no, b.business_name, b.province_id, p.id, p.name_th as Pname,b.amphure_id, a.id, a.name_th as Aname,b.district_id, d.id, d.zip_code, d.name_th as Dname, b.post_code, b.home_number, b.road from business b, provinces p, amphures a, districts d where b.province_id = p.id and b.amphure_id = a.id and b.district_id = d.id";
    $result = $conn->query($sql);
$jsonData =  "" ;

$jsonData.='<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">รายชื่อบริษัท/อุตสาหกรรม</h1>
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
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered hover" id="allBusiness">
                            <thead>
                                <tr>
                                    <td>ลำดับ</td>  
                                    <td>เลขประจำตัวผู้เสียภาษี 13 หลัก</td>  
                                    <td>ชื่อสถานประกอบการ</td>  
                                    <td>สาขา</td>                                      
                                    <td>ที่อยู่</td>  
                                    <td></td>  
                                </tr>
                            </thead>
                            <tbody>';
                                                        
                            if ($result->num_rows > 0) {
                                $no = 1;
                                while($row = $result->fetch_assoc()) {
                                     if($row['Bid'] != "Admin"){           
                                        $jsonData.='<tr>
                                            <td>'.$no.'</td> 
                                            <td>'.$row['Bid'].'</td>  
                                            <td>'.$row['business_name'].'</td>  
                                            <td>'.$row['branch_no'].'</td>  
                                            <td>'.$row['home_number'].' '.$row['road'].' '.$row['Pname'].' '.$row['Aname'].' '.$row['Dname'].' '.$row['post_code'].'</td>  
                                            <td><a class="ml-3 mt-3 btn btn-info btn-sm btn-editBusi" val="'.$row["Bid"].'">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            แก้ไข
                                        </a>
                                        <a class="ml-3 mt-3 btn btn-danger btn-sm btn-delBusi" val="'.$row["Bid"].'">
                                            <i class="fas fa-trash">
                                            </i>
                                            ลบ
                                        </a></td>  
                                        </tr>';
                                     }
                                    ++$no; 
                                }
                            }
                        $jsonData.='</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';
echo json_encode($jsonData);