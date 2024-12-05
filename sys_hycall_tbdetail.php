<meta http-equiv="refresh" content="200;URL=sys_hycall_tbdetail.php">
<script src="assets/js/bootstrap.min.js"></script>
<link href="css/style.css" rel="stylesheet">
<style>
@import url('https://fonts.googleapis.com/css2?family=Fahkwang:wght@300;400;600&family=Montserrat:ital,wght@0,100;0,200;0,300;1,200&display=swap');

.scGridLabelFont3 {
    font-family: 'Fahkwang', sans-serif;
    font-size: 28px;
    color: #dfdfff;
    padding: 2px 4px;
}
</style>
<?php
   require_once("db/connection.php");
   require_once("db/connect_pmk.php");
?>

<tbody class="scGridLabelFont3">
<?php 

?>
<?php
$sql2 = "SELECT C.* FROM ($sql1) C WHERE C.ROWNO > $Page_Start AND 
C.ROWNO <= $Row_End";
$stid = oci_parse($objConnect, $sql2);
oci_execute ($stid,OCI_DEFAULT);
while($rs = oci_fetch_array($stid,OCI_ASSOC))
{
$bedno=$rs['BED_NO'];
$an=$rs['AN'];
$hn=$rs['HN'];
$name=$rs['FNAME'];
$pl=$rs['PLA_PLACECODE'];
$dateadm=$rs['DATEADMIT'];
$dd=substr($rs['DATEADMIT'],0,2);
$mm=substr($rs['DATEADMIT'],3,2);
$yy=substr($rs['DATEADMIT'],6,4);
$yy=$yy+543;
$dsp=$dd.'-'.$mm.'-'.substr($yy,2,2);               // วันที่ Admit
$dpa=$rs['ALLERGIC_DESC'];                           //รายการแพ้ยา
// $dla=$rs['DONA'];
$dlc=$rs['DEGREE_OF_PATIENT_CODE'];
$nday=$rs['NDAY'];
$ds=$rs['DS'];
$dc=$rs['PROCDIAG'];
$cm=$rs['TREATMNT'];
$da=$rs['M_TOTAL'];
$cf=$rs['NAME'];
$cfid=$rs['CF_CHAR_ID'];
$dhn=$rs['DHN'];
$dname=$rs['DOCNAME'];
$sname=$rs['SURNAME'];
$i++;
if($i%2==0)
{
$bg="linear-gradient(to right, #0E3EDA, #021b79)"; 
// $bg = "#0E3EDA";
}
else
{
$bg="linear-gradient(to right, #021b79, #0E3EDA)"; 
// $bg ="#051367";
}
?>
    <tr bgcolor="<?=$bg;?>">
        <!-- ส่วนงานเตียง -->
        <td width="1%">
            <center>
                <?php 
echo $bedno; 
?>
            </center>
        </td>

        <td width="1%">
            <center>
                <?php
echo $hn;    
?>
            </center>
        </td>

        <!--เริ่มรายการย่อยใน Column NAME  -->
        <td style="width:14%; align:left;">

            <!-- NAME -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6" style="font-size: 40px;">
                        <p> <?php echo $name;?></p>
                    </div>
                </div>
                <div class="row">

                    <!-- DIET -->
                    <div class="col-lg-2">
                        <p>
                            <?php
if($dlc=='4A'){
    echo '<span class="fa-stack">';
    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
    echo '<i class="fa-solid fa-bed fa-stack-1x" style="color:#f9f9f9;"></i>';
    echo '</span>';
}

if($dlc=='3A'){
    echo '<span class="fa-stack">';
    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#f339ed;"></i>';
    echo '<i class="fa-solid fa-bed fa-stack-1x" style="color:#eefdfd;"></i>';
    echo '</span>';
}
if($dlc=='3B'){
    echo '<span class="fa-stack">';
    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#FFE162;"></i>';
    echo '<i class="fa-solid fa-bed fa-stack-1x" style="color:#eefdfd;"></i>';
    echo '</span>';
}

if($dlc=='2A'||$dlc=='2B'){
    echo '<span class="fa-stack">';
    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#06D44E;"></i>';
    echo '<i class="fa-solid fa-bed fa-stack-1x" style="color:#eefdfd;"></i>';
    echo '</span>';
}
if($dlc=='2C' || $dlc=='1A' || $dlc=='1B'){
    echo '<span class="fa-stack">';
    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#eefdfd;"></i>';
    echo '<i class="fa-solid fa-bed fa-stack-1x" style="color:blue;"></i>';
    echo '</span>';
}
?>
                        </p>
                    </div>

                    <div class="row">

                        <!-- LOS -->
                        <div class="col-lg-2">
                            <p>
                                <?php
echo '<span class="fa-stack">';
//  แดง
if($nday>='28'){
    if(($da>='100000') AND $da <='299999'){
        echo'<a href="#" data-toggle="modal"
                class="view_data" data-id="'.$rs['AN'].'">';
        echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
        echo '<i class="fa-solid fa-euro-sign fa-shake fa-stack-1x" style="color:#eefdfd;"></i>';
    }else{   
        if(($da>='300000') AND $da <='499999'){
            echo '<a href="#">';
            echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
            echo '<i class="fa-solid fa-yen-sign fa-shake fa-stack-1x" style="color:#eefdfd;"></i>';
            echo '</a>';
        }else{
            if(($da>='500000') AND $da <='799999'){
                echo '<a href="#">';
                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
                echo '<i class="fa-solid fa-dollar-sign fa-shake fa-stack-1x" style="color:#eefdfd;"></i>';
                echo '</a>';
            }else{
                if($da>='800000'){
                    echo '<a href="#">';
                    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
                    echo '<i class="fa-solid fa-won-sign fa-shake fa-stack-1x" style="color:#eefdfd;"></i>';
                    echo '</a>';
                }else{
                    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
                }
            }       
        }
    }
}

// 
if($nday >='14' AND $nday <=27){
    if(($da>='100000') AND $da <='299999'){
            echo'<a href="#" data-toggle="modal"
                    class="view_data" data-id="'.$rs['AN'].'">';
            echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#FFE162;"></i>';
            echo '<i class="fa-solid fa-euro-sign fa-shake fa-stack-1x" style="color:#ff3737;"></i>';
        }else{   
            if(($da>='300000') AND $da <='499999'){
                echo '<a href="#">';
                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#FFE162;"></i>';
                echo '<i class="fa-solid fa-yen-sign fa-shake fa-stack-1x" style="color:#ff3737;"></i>';
                echo '</a>';
            }else{
                if(($da>='500000') AND $da <='799999'){
                    echo '<a href="#">';
                    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#FFE162;"></i>';
                    echo '<i class="fa-solid fa-dollar-sign fa-shake fa-stack-1x" style="color:#ff3737></i>';
                    echo '</a>';
                }else{
                    if($da>='800000'){
                        echo '<a href="#">';
                        echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#FFE162;"></i>';
                        echo '<i class="fa-solid fa-won-sign fa-shake fa-stack-1x" style="color:#ff3737;"></i>';
                        echo '</a>';
                    }else{
                        echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#FFE162;"></i>';
                    }
                }       
            }
        }
    }
    if($nday <'14'){
        if(($da>='100000') AND $da <='299999'){
            echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#06D44E;"></i>';
            echo '<i class="fa-solid fa-euro-sign fa-shake fa-stack-1x" style="color:#003500;"></i>';
        }else{   
            if(($da>='300000') AND $da <='499999'){
                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#06D44E;"></i>';
                echo '<i class="fa-solid fa-yen-sign fa-shake fa-stack-1x" style="color:#003500;"></i>';
            }else{
                if(($da>='500000') AND $da <='799999'){
                    echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#06D44E;"></i>';
                    echo '<i class="fa-solid fa-dollar-sign fa-shake fa-stack-1x" style="color:#003500;"></i>';
                }else{
                    if($da>='800000'){
                        echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#06D44E;"></i>';
                        echo '<i class="fa-solid fa-won-sign fa-shake fa-stack-1x" style="color:#003500;"></i>';
                    }else{
                        echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#06D44E;"></i>';
                    }
                }
            }
    }
}
?>
                            </p>
                        </div>

                        <div class="row" style="margin-left:-10px;">
                            <div class="col-lg-2" style="margin-left:-10px;">
                                <p>
                                    <?php
    $cfn='';
    $cfc='';
    if($cfid=='1'){
    $cfn='RD';
    $cfc='green';
    }else{
        if($cfid=='2'){
            $cfn='SD';
            $cfc='blue';
        }else{
        if($cfid=='3'){
            $cfn='LD';
            $cfc='purple';
            }else{
                if($cfid=='5'){
                    $cfn='SP';
                    $cfc='orange';
                }else{
                    if($cfid=='A'){
                        $cfn='BM';
                        $cfc='brown';
                    }else{
                        if($cfid=='B'){
                            $cfn='IF';
                            $cfc='rgb(44, 127, 124)';
                        }else{
                            if($cfid=='D'){
                                $cfn='NPO';
                                $cfc='RED';
                            }else{
                                if($cfid=='C'){
                                    $cfn='B/I';
                                    $cfc='rgb(44, 127, 124)';
                                }else{
                                    $cfn='FT';
                                    $cfc='green';
                                }                                  
                            }                              
                        }                            
                    }
                }
            }              
        }
    }
    ?>
                                <div class="fa-2x" style="margin-top:-18px;">
                                    <a href="#patientDiet" data-toggle="modal" data-id="<?=$hn?>">
                                        <span class="fa-layers fa-fw">
                                            <i class="fas fa-circle" style="color:#e7ccff ;"></i>
                                            <span class="fa-layers-text" data-fa-transform="shrink-6 down-0"
                                                style="font-weight:bold;font-size:40px;"><?=$cfn;?>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                </p>
                            </div>

                            <p style="color:#ffff46;"> <?php echo $dsp;?></p>
                            <p style="color:#FFA1C9;"> <?php echo $dname;?></p>

                        </div>
                    </div>
                </div>
            </div>
        </td>

        <!-- ถ้ามีรายการแพ้ยาให้มีการแสดง POPUP -->
        <td>
            <center>
                <?php
                IF($ds<>''){
                echo '<a href="#patientAlert" data-toggle="modal" data-id="'.$hn.'">';
                echo '<span class="fa-stack ">';
                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
                echo '<i class="fa-solid fa-allergies fa-shake" style="color:#fff9f9;"></i>';
                echo '</span>';
                echo '</a>';
                }else{
                echo '';
                }
                ?>
            </center>
        </td>

        <!-- รายการLAB -->
        <?php 
        $lcount='0';
// $sqlb = "SELECT 
//             COUNT(HN) AS DD, X.LAB_NAME,HN
//          FROM
//             (SELECT *
//                 FROM H4U_LAB 
//              WHERE 
//                 LAB_RESULT < '2.5' OR LAB_RESULT > '6.5' AND
//                 DATE_SERVE<=TRUNC(SYSDATE-2) 
//              )x
//          WHERE  
//             SUBSTR(UPPER(LAB_NAME),1,4) IN('POTA') AND X.HN='$hn'
//          GROUP BY X.LAB_NAME,HN";
// $stil=oci_parse($objConnect, $sqlb);
// oci_execute ($stil,OCI_DEFAULT);
// while($rs=oci_fetch_array($stil,OCI_ASSOC))
// {
//    $lcount=$rs['DD'];
// }
?>
        <td>
            <center>
                <?php
                if($lcount <> 0){
                echo '<a href="#patientLabAlert" data-toggle="modal" data-id="'.$hn.'">';
                echo '<span class="fa-stack ">';
                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
                echo '<i class="fa-solid fa-exclamation-triangle fa-shake" style="color:#fff9f9;"></i>';
                echo '</span>';
                echo '</a>';
                }
                ?>
            </center>
        </td>

        <!-- ISOLATION -->

        <?php
        if($dc==''){
        echo '<td>';
        }else{
        echo '<td style="background-color:#df0000;color:#fffff9;">';
        }                                     
        ?>
        <center>
            <?php
            echo $dc;
            ?>
        </center>
        </td>

        <!-- ตรวจสอบข้อมูลที่ขอเปล  -->
        <?php
            $slq="SELECT x1,pers,pers2,hdate,perto,fplace,toplace,htime,x1_pertime,tplace,name,empname FROM v_monitor 
            WHERE x1 IN('W','R','E') AND an='$an' AND 
            hdate='$d_default' AND 
            ward='$strKeyword'";
             $rsq=mysqli_query($conn,$slq);               
             $rw=mysqli_fetch_array($rsq);
        ?>
        <td>
            <center>
                <?php                      
                // if($rw['x1']=='W'){
                //     echo '<i class="fa-solid fa-circle-plus fa-beat fa-2x" style="color:#FFE162;"></i>';
                // }

                // if($rw['x1']=='R'){
                //     echo '<i class="fa-solid fa-rotate fa-spin fa-2x" style="color:#FFE162;"></i>';
                // }

                // if($rw['x1']=='E'){
                //     echo '<i class="fa-solid fa-wheelchair fa-beat fa-2x" style="color: #FFE162"></i>';

                // }
                ?>
            </center>
        </td>

        <!-- ต้นทาง -->
        <td>
            <center>
                <?php
                // if($rw['x1']=='W'){
                //     echo $rw['htime'].'น.';
                // }

                // if($rw['x1']=='R'){
                //     echo $rw['x1_pertime'].'น.';
                // }

                // if($rw['x1']=='E'){
                //     echo $rw['perto'].'น.';
                // }
                ?>
            </center>
        </td>

        <td style="font-size: 35px;">
            <?php
            if($rw['x1']=='W'||$rw['x1']=='R'||$rw['x1']=='E')

            {
            echo $rw['fplace'];
            }
            ?>
        </td>
        <td>
            <div class="col-lg-12">
                <div class="row">
                    <p>
                        <center>
                            <?php                      
                            if($rw['x1']=='W'){
                                echo '<i class="fa-solid fa-circle-plus fa-beat fa-2x" style="color:#FFE162;"></i>';
                            }

                            if($rw['x1']=='R'){
                                echo '<i class="fa-solid fa-rotate fa-spin fa-2x" style="color:#FFE162;"></i>';
                            }

                            if($rw['x1']=='E'){
                                echo '<i class="fa-solid fa-wheelchair fa-beat fa-2x" style="color: #FFE162"></i>';                                    
                            }
                            ?>
                        </center>
                    </p>
                </div>

                <div class="row">
                    <?php
                    if($rw['x1']=='W'||$rw['x1']=='R'||$rw['x1']=='E')
                    {
                    echo '<i class="fa-solid fa-circle-right fa-2x fa-beat " style="color:#06D44E"></i>';

                    }
                    ?>
                </div>

                <div class="row">
                    <center>
                        <?php
                        if($rw['x1']=='W'){
                            echo $rw['htime'].'น.';
                        }

                        if($rw['x1']=='R'){
                            echo $rw['x1_pertime'].'น.';
                        }

                        if($rw['x1']=='E'){
                            echo $rw['perto'].'น.';
                        }
                        ?>
                    </center>
                </div>
            </div>
        </td>

        <!--จุดหมาย -->
        <td style="font-size:35px;">
            <?php
                if($rw['x1']=='W'||$rw['x1']=='R'||$rw['x1']=='E')
                {
                echo $rw['tplace'];
                }
            ?>
        </td>

        <td>
            <div class="col-lg-12">
                <div class="row" style="color:#ffff46;">
                    <?php 
                    if($rw['pers']<>''){
                        echo $rw['name'];
                    }
                    ?>
                </div>
                <div class="row" style="color:#ffff46;">
                    <?php 
                    if($rw['pers2']<>'100'){
                        echo $rw['empname'];
                    }
                    ?>
                </div>

                <!-- อ่านข้อมูลรายการแลบล่วงหน้า OUTL, 501,0101 -->
                <?php
                $ls="SELECT T.AN,T.HN,T.M_TOTAL,DD.PLA_PLACECODE AS DOUTL   
                    FROM IPDTRANS T
                    LEFT JOIN DATE_DBFS DD ON (DD.PAT_RUN_HN||'/'||DD.PAT_YEAR_HN)=T.HN AND 
                                TO_DATE(DD.APP_DATE,'DD-MM-YY')>=TO_DATE(SYSDATE,'DD-MM-YY') AND 
                                DD.PLA_PLACECODE IN('OUTL','0101','0501')
                 WHERE T.PLA_PLACECODE = '$strKeyword' AND 
                       (DD.PAT_RUN_HN||'/'||DD.PAT_YEAR_HN)='$hn' AND 
                        T.DATEDISCH IS NULL AND DD.PLA_PLACECODE IS NOT NULL
                 GROUP BY T.AN,T.HN,T.M_TOTAL,DD.PLA_PLACECODE";
                 $stls=oci_parse($objConnect, $ls);
                 oci_execute($stls,OCI_DEFAULT);
                 while($lrs=oci_fetch_array($stls,OCI_ASSOC))
                 {
                    IF($lrs['DOUTL']=='OUTL'){
                        echo '<div class="row">';
                        echo '<div class="fa-2x">';
                        echo '<a href="#" data-toggle="modal" data-target="#lightbox">';
                        echo '<span class="fa-layers fa-fw">';
                        echo '<i class="fas fa-calendar" style="color:#06D44E;"></i>';
                        echo '<span class="fa-layers-text" data-fa-transform="shrink-8 down-5"';
                        echo 'style="font-weight:bold;font-size:30px;color:#000000">OUT';
                        echo '</span>';
                        echo '</a>';
                        echo '</div>';       
                        echo '</div>';       
                    }
                    IF($lrs['DOUTL']=='0101')
                        {
                        echo '<div class="row">';
                        echo '<div class="fa-2x">';
                        echo '<a href="#" data-toggle="modal" data-target="#lightbox">';
                        echo '<span class="fa-layers fa-fw">';
                        echo '<i class="fas fa-calendar" style="color:#ffff46;"></i>';
                        echo '<span class="fa-layers-text" data-fa-transform="shrink-8 down-5"';       
                        echo 'style="font-weight:bold;font-size:30px;color:#000000">0101';
                        echo '</span>';
                        echo '</a>';
                        echo '</div>';       
                        echo '</div>';        
                    }
                    if($lrs['DOUTL']=='0501')
                        {
                        echo '<div class="row">';
                        echo '<div class="fa-2x">';
                        echo '<a href="#" data-toggle="modal" data-target="#lightbox">';
                        echo '<span class="fa-layers fa-fw">';
                        echo '<i class="fas fa-calendar" style="color:#ffff46;"></i>';
                        echo '<span class="fa-layers-text" data-fa-transform="shrink-8 down-5"';    
                        echo 'style="font-weight:bold;font-size:30px;color:#000000">0501';
                        echo '</span>';
                        echo '</a>';
                        echo '</div>';       
                        echo '</div>';                                                       
                    }
                 }                                     
                ?>
                <div class="row">
                    <?php
                    if($cm<>''){
                        echo $cm;
                    }
                    ?>
                </div>

            </div>
        </td>
    </tr>
    <?php   
    }
    ?>
</tbody>
<?php oci_close($objConnect);?>

<script type="text/javascript">
$(document).ready(function() {
    $('#patientLabAlert').on('show.bs.modal', function(e) {
        var lhn = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_lab_allgery.php', //Here you will fetch records
            data: {
                'lhn': lhn
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
            }
        });
    });
});
</script>

<div class="modal fade" id="patientLabAlert" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="fa-solid fa-exclamation-triangle fa-shake"></i> แจ้งการรายงาผลแลบ
                </h3>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#patientAlert').on('show.bs.modal', function(e) {
        var hn = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_drug_allgery.php', //Here you will fetch records
            data: {
                'hn': hn
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
            }
        });
    });
});
</script>

<div class="modal fade" id="patientAlert" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class='fa fa-warning'></i>รายการยาที่แพ้เป็นสำคัญของ
                </h3>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#patientDiet').on('show.bs.modal', function(e) {
        var hn = $(e.relatedTarget).data('id')
        $.ajax({
            type: 'post',
            url: 'sys_hycall_diet.php', //Here you will fetch records
            data: {
                'hn': hn
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
            }
        });
    });
});
</script>

<div class="modal fade" id="patientDiet" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h3 class="modal-title">
                    <i class="text text-danger"></i>อาหาร/อาหารทางการแพทย์'
                </h3>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>