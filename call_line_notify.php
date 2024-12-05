<!-- Call Line notify -->
<?php
include 'db/connection.php';
?>
<?php
$sql ="SELECT * FROM v_consult_detail WHERE an='$request['an'] ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) 
{
        while($row1 = mysqli_fetch_assoc($result)) 
        {
        $fan=$row1['an'];

        // $da=$row1['rec_date'];
        $pn=$row1['pname'];
        $line = $row1['doc_line'];

        define('LINE_API', "https://notify-api.line.me/api/notify");
        $token = "mJUlnzSvZ76guI1RhrGuzunQFGJ1IDBDUNjonvIP71D";
        // $token = $row1['doc_line'];
        $headers    = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$token
        ];
        $str= 
        "\r\n".'มีการร้องของ Consult'.
        "\r\n".'...........................................'.                       
        "\r\n".'เลขที่ใบ Consult : '.$row1['mcode'].'-'.$row1['cons_id'].
        "\r\n".'ความเร่งด่วน  : '.$row1['e_fast'].              
        "\r\n".'วันที่ร้องขอ : '.$row1['cons_date'].'  เวลา :'.$row1['cons_time'].' น.'.
        "\r\n".'AN :'.$row1['an'].'  HN: '.$row1['hn'].'  '.$row1['pname'].
        "\r\n".'Ward: '.$row1['fullplace'].
        "\r\n".'Bed : '.$row1['beds'].

        // เพิ่มเติม
        "\r\n".'กลุ่มงานที่จะปรึกษา : '.$row1['m_depname'].
        "\r\n".'สาขา/หน่วงาน : '.$row1['s_ename'].
        "\r\n".'ประวัติการตรวจร่างกาย : '.$row1['a1'].
        "\r\n".'ผลการตรวจทางห้องปฎิบัติการณ์ : '.$row1['a2'].
        "\r\n".'ประวัติการตรวจร่างกาย : '.$row1['a1'].
        "\r\n".'การรักษา : '.$row1['a3'].
        "\r\n".'จุดประสงค์การปรึกษาครั้งนี้ : '.$row1['exp'].
        "\r\n".'การวินิจฉัย (ICD10) : '.$row1['icd_desca'].'-'.$row1['icd_descb'].'-'.$row1['icd_desc'].
        "\r\n".'การวินิจฉัยโรคระบุ : '.$row1['ftext'].
        "\r\n".'ชื่อแพทย์ผู้ปรึกษา : '.$row1['prea'].''.$row1['namea'].' '.$row['surnamea'].
        "\r\n".'Ward staff : '.$row1['nameb'].'  '.$row1['surnameb'].
        "\r\n".'กลุ่มงาน : '.$row1['conmdepname'].
        "\r\n".'http://192.168.99.17/e_ward/sys_eward_view.php?an='.$row1['an'].
        "\r\n".'(ใช้ wifi โรงพยาบาล)';
        $res = notify_message($str,$token,$message_data);
        print_r($res);
        unset($_SESSION['success']);
        }
}

function notify_message($message,$token)
{
$queryData = array('message' => $message);
$queryData = http_build_query($queryData,'','&');
$headerOptions = array( 
        'http'=>array(
        'method'=>'POST',
        'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                        ."Authorization: Bearer ".$token."\r\n"
                        ."Content-Length: ".strlen($queryData)."\r\n",
        'content' => $queryData
        ),
);
$context = stream_context_create($headerOptions);
$result = file_get_contents(LINE_API,FALSE,$context);
$res = json_decode($result);
}
?>