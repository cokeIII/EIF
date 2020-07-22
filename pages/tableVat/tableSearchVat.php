<?php
    require_once "../../dist/nusoap/nusoap.php";
    require_once "../../dist/util.php";

    session_start();
    $wsdl = 'https://rdws.rd.go.th/serviceRD3/vatserviceRD3.asmx?wsdl';
    header('Content-Type: text/html; charset=utf-8');
    $soapclient = new nusoap_client($wsdl, true);
    $soapclient->soap_defencoding = 'UTF-8';
    $soapclient->decode_utf8 = false;
    $err = $soapclient->getError();

    $nameSearchVat = "";
    if(isset($_POST['submit']) && $_POST['submit'] == "nameSearchVat") {
        $nameSearchVat = $_POST['name'];
    }

    $var_name = array(
        'username' => 'anonymous',
        'password' => 'anonymous',
        'TIN'=> '',
        'Name' => $nameSearchVat,
        'ProvinceCode' => 0,
        'BranchNumber' => 0,
        'AmphurCode' => 0,
    );
    $dataBusi = array();

    $result = $soapclient->call('Service', $var_name);
    if(!empty($result)){
        foreach($result['ServiceResult'] as $i=>$value){
            if(isset($value['anyType'])){
                foreach ($value['anyType'] as $j => $value) {
                    $dataBusi[$j][$i] = $value;                                          
                }
            }
        }
    }

$_SESSION["dataBusi"] = $dataBusi;
// print_r($_SESSION["dataBusi"]);
$json = '';
$json.='<div id="searchVat" class="">
    <h4 class="center-txt">เลือกสถาณประกอบการ</h4>
    <table class="table table-bordered hover" id="busiTable">
        <thead>
            <tr>
                <td>ลำดับ</td>  
                <td>เลขประจำตัวผู้เสียภาษี 13 หลัก</td>  
                <td>สาขา</td>  
                <td>ชื่อผู้ประกอบการฯ</td>  
                <td>ชื่อสถานประกอบการ</td>  
                <td>รหัสไปรษณีย์</td>  
                <td>วันที่จดทะเบียน</td>  
            </tr>
        </thead>
        <tbody>';

        $No = 1;
        foreach($dataBusi as $key=>$value){
            if(EC3($value['vProvince'])){
                        
            $json.='<tr id="rowData" val="'.$value['vNID'].'">
                <td>'.$No. '</td> 
                <td>'.$value['vNID'].'</td>  
                <td>' .setBranchNumber($value['vBranchNumber']). '</td>  
                <td>' .$value['vtitleName']." ".$value['vName']." ".$value['vSurname']. '</td>
                <td>' .$value['vBranchName']. '</td>  
                <td>' .$value['vPostCode']. '</td>  
                <td>' .$value['vBusinessFirstDate']. '</td>  
            </tr>';

        $No++; 
            }
        }

        $json.='</tbody>
    </table>
</div>';
echo json_encode($json);