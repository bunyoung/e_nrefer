<?php
// include('main_script.php');
require_once("db/connect_pmk.php");
$hn=$_POST['hn'];
?>
<?php
$sqlp="SELECT 
        (DPA.PAT_RUN_HN||'/'||DPA.PAT_YEAR_HN) AS DPHN,(VP.PRENAME||VP.NAME||' '||VP.SURNAME) AS DNAME,
            D.POPUP_NAME, dpa.ALLERGIC_DESC,TO_CHAR(DPA.DATE_CREATED,'DD/MM/YYYY') AS DADD
    FROM DRUG_PT_ALLERGY DPA   
        INNER JOIN V_PATIENTS VP ON VP.HN=(DPA.PAT_RUN_HN||'/'||DPA.PAT_YEAR_HN)
        LEFT JOIN DRUGCODES D ON D.CODE=dpa.DRU_CODE
    WHERE (DPA.PAT_RUN_HN||'/'||DPA.PAT_YEAR_HN)= '$hn' ";
$stp = oci_parse($objConnect, $sqlp);
oci_execute ($stp,OCI_DEFAULT);
while($rp = oci_fetch_array($stp,OCI_ASSOC))
{
    $allery= $rp['ALLERGIC_DESC'];
    $allname=$rp['DNAME'];
    // $alldate=$rp['DADD'];
    $alldrug=$rp['POPUP_NAME'];

    $allddmm=SUBSTR($rp['DADD'],0,5); 
    $allyy=SUBSTR($rp['DADD'],6,4) + 543;
    $alldate=$allddmm.'/'.$allyy;

}                            
?>

<div class="modal-body text-danger">
    <div id="collapse4" class="body">
        <div class="alert" style="text-align:center;font-size:40px;font-weight:bold;color:#c8063c;margin-top:10px;">
            <div class="row">
                <?php echo 'รายการยาที่แพ้เป็นสำคัญของ';?>
            </div>
            <p>
                <p>
            <div class="text" style="font-size:30px;background-color:#b91133;color:#fdfdfd">
                <div class="row">
                    <?php echo 'HN :'.$hn;?>
                </div>
                <div class="row">
                    <?php echo 'ชื่อ-นามสกุล :'.$allname;?>
                </div>
                <div class="row">
                    <?php echo 'วันที่บันทึก :'.$alldate;?>
                </div>
                <div class="row">
                    <?php echo 'ยาที่แพ้ :'. $alldrug;?>
                </div>
                <div class="row">
                    <?php echo 'อาการคือ :'.$allery;?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
 oci_close($objConnect);
?>