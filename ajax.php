<?php
include("db/connect_pmk.php");
if (isset($_POST['hn'])) {
    $hn = $_POST['hn'];
    $strSQL = "SELECT ID_CARD,HN,PRENAME,NAME,SURNAME,(PRENAME||NAME||' '||SURNAME) as n
                FROM v_patients
               WHERE HN='".$hn."' ";
    $objParse = oci_parse($objConnect, $strSQL);
    oci_execute($objParse);
        $rows = oci_fetch_all($objParse, $Result);
    if(($rows)< 1){
        echo '
        <script>
            setTimeout(function() {
                swal({
                    title: "การบันทึกประวัติใหม่",
                    text: "ไม่พบรายการข้อมูลประวัติ เจ้าหน้าที่คนนี้ !!",
                    type: "warning"
                }, function() {
                    window.location = "main_timekeeper_regis.php";
                })
            },500);
        </script>
    ';
        }else{
            oci_execute($objParse,OCI_DEFAULT);
            while($objResult = oci_fetch_array($objParse,OCI_BOTH))
            {
                $prename=$objResult['PRENAME'];
                $name=$objResult['NAME'];
                $surname=$objResult['SURNAME'];
                $hn=$objResult['HN'];
                $na=$objResult['N'];
                $idc=$objResult['ID_CARD'];
            }
    }       
}    
//    $Name = $_POST['hn'];
//    $Query = "SELECT Name FROM hn WHERE Name LIKE '%$Name%' LIMIT 5";
//    $ExecQuery = MySQLi_query($con, $Query);
//    echo '<ul>';
//    while ($Result = MySQLi_fetch_array($ExecQuery)) {
//    ?>
//    <li onclick='fill("<?php echo $Result['Name']; ?>")'>
//    <a>
//      <?php 
            echo $Result['Name']; 
            oci_close($objConnect);
        ?>
//    </li></a>
//    <?php
// 	}
//    }
// ?>
</ul>