<?php
    require_once "../../dist/nusoap/nusoap.php";
    require_once "../../dist/util.php";
    
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
                <td>ที่อยู่</td>   
            </tr>
        </thead>
        <tbody>';
        
        $No = 1;
        foreach($dataBusi as $key=>$value){
            if(EC3($value['vProvince'])){
                        
            $json.='<tr id="rowData" class="row-vat" val="'.$value['vNID'].'">
                <td key="no">'.$No. '</td> 
                <td key="vNID" >'.$value['vNID'].'</td>  
                <td key="vBranchNumber" >' .setBranchNumber($value['vBranchNumber']). '</td>  
                <td key="vName" >' .$value['vtitleName']." ".$value['vName']." ".$value['vSurname']. '</td>
                <td key="vBranchName">' .$value['vBranchName']. '</td>  
                <td key="vPostCode">' .$value['vPostCode']. '</td>  
                <td key="vBusinessFirstDate">' .$value['vBusinessFirstDate']. '</td>  
                <td key="vaddress">' .$value['vHouseNumber'].', '.$value['vMooNumber'].', '.$value['vSoiName'].', '.$value['vThambol'].', '.$value['vAmphur'].', '.$value['vProvince'].'</td>  
            </tr>';

        $No++; 
            }
        }

        $json.='</tbody>
    </table>
</div>';
echo json_encode($json);