<?php
include('main_script.php');
require_once("db/connect_pmk.php");
$an=$_POST['an'];
// echo $an;
?>
<?php
?>

<div class="modal-body text-default">
    <?php
    $tt='0';
    $sqlp = "SELECT 
    OL.HN,OL.AN,OL.GROUP_CODE2,OFG.NAME,SUM(OL.M_TOTAL_SELL) AS TT,SUM(OL.M_TOTAL_FUND),
    SUM(OL.M_CREDIT),SUM(OL.M_DISCOUNT),SUM(OL.M_RESIDUAL),SUM(OL.M_RETURN)
    FROM OFH_LIKE OL,OWN_FINANCE_GROUP OFG       
    WHERE 1=1 AND
          OFG.GROUP_CODE2=OL.GROUP_CODE2 AND
          AN='$an' AND OL.OPDIPD='I'
    GROUP BY OL.GROUP_CODE2,OFG.NAME,OL.HN,OL.AN
    ORDER BY ol.GROUP_CODE2";

    $stp = oci_parse($objConnect, $sqlp);
    oci_execute ($stp,OCI_DEFAULT);
    while($rp = oci_fetch_array($stp,OCI_ASSOC))
    {
        $tt=$rp['TT'] + $tt;
    }                            
    ?>
</div>
<div class="box">
    <header style="font-size: 30px;">
        <h2>สรุป ค่าใช้จ่าย AN :
            <a class="text text-success">
                <?php echo $an.' : '.$tt.'   บาท';?>
            </a>
        </h2>
    </header>
</div>

<?php 
 oci_close($objConnect);
?>