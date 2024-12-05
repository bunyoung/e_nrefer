<?php
require_once("db/connect_pmk.php");
$hn=$_POST['hn']
?>
<?php
      $sqlp="SELECT
      (VP.PRENAME||VP.NAME||' '||VP.SURNAME) AS NN, CF.NAME,I.CF_CHAR_ID,
        NVL(TO_CHAR(I.DATE_MODIFIED,'DD-MM-YY'),TO_CHAR(I.DATE_CREATED,'DD/MM/YYYY')) AS DFD,
        I.FOOD_DETAIL
      FROM IPDTRANS I
      INNER JOIN V_PATIENTS VP ON VP.HN=I.HN AND I.DATEDISCH IS NULL 
      LEFT JOIN CHAR_FOODS CF ON CF.CHAR_ID = I.CF_CHAR_ID
    WHERE I.HN = '$hn'";
      $stp = oci_parse($objConnect, $sqlp);
      oci_execute ($stp,OCI_DEFAULT);
      while($rp = oci_fetch_array($stp,OCI_ASSOC))
      {
        $allfood=$rp['NAME'];
        $allname=$rp['NN'];
        $allddmm=SUBSTR($rp['DFD'],0,5); 
        $allyy=SUBSTR($rp['DFD'],6,4) + 543;
        $alldfd=$allddmm.'/'.$allyy;
        $alldd=$rp['FOOD_DETAIL'];
    }                            

    ?>
<div class="modal-body text-danger">
    <div id="collapse4" class="body">
        <div class="alert" style="text-align:center;font-size:40px;font-weight:bold;color:#c8063c;margin-top:10px;">
            <div class="row">
                <?php echo 'อาหาร/อาหารทางการแพทย์';?>
            </div>
            <p>
            <div class="text" style="font-size:30px;background-color:#008000;color:#fdfdfd">
                <div class="row">
                    <?php echo 'HN :'.$hn;?>
                </div>
                <div class="row">
                    <?php echo 'ชื่อ-นามสกุล :'.$allname;?>
                </div>
                <div class="row">
                    <?php echo 'วันที่บันทึก :'.$alldfd;?>
                </div>
                <div class="row">
                    <?php echo 'ประเภท :'. $allfood;?>
                </div>
                <div class="row">
                    <?php echo 'ชนิด/ประมาณ :'.$alldd;?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
 oci_close($objConnect);
?>