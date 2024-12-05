<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>E-Ward</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.gif" />
    <meta http-equiv="refresh" content="800;URL=ward_main_monotor.php">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link href="assets/lightbox/css/lightbox.min.css" />

    <style>
    @import url('https://fonts.googleapis.com/css?family=Taviraj');

    .scGridLabelFont {
        color: #077700;
        text-align: center;
        font-family: 'Taviraj', sans-serif;
        font-size: 48px;
        font-weight: bold;
        padding: 2px 4px;
        text-decoration: none;
    }

    @import url('https://fonts.googleapis.com/css?family=Taviraj');

    .scGridLabelFont1 {
        color: #FFF;
        font-family: 'Taviraj', sans-serif;
        font-size: 39px;
        font-weight: bold;
        padding: 2px 4px;
        text-decoration: none;
    }

    @import url('https://fonts.googleapis.com/css?family=Kanit:600');

    .scGridLabelFont2 {
        color: #481;
        font-family: 'Taviraj', sans-serif;
        font-size: 40px;
        font-weight: bold;
        padding: 2px 4px;
        text-decoration: none;
    }

    @import url('https://fonts.googleapis.com/css?family=Kanit:600');

    .scGridLabelFont3 {
        font-family: 'Taviraj', sans-serif;
        font-size: 28px;
        font-weight: bold;
        /* color: white; */
        padding: 2px 4px;
    }

    #lightbox .modal-content {
        display: inline-block;
        text-align: center;
    }

    #lightbox .close {
        opacity: 1;
        color: rgb(255, 255, 255);
        background-color: rgb(25, 25, 25);
        padding: 5px 8px;
        border-radius: 30px;
        border: 2px solid rgb(255, 255, 255);
        position: absolute;
        top: -15px;
        right: -55px;
        width: 50%;

        z-index: 1032;
    }
    }
    </style>
    <style>
    /**
        * Tooltip Styles
    */
    /* Add this attribute to the element that needs a tooltip */
    [data-tooltip] {
        position: relative;
        z-index: 2;
        cursor: pointer;
    }

    /* Hide the tooltip content by default */
    [data-tooltip]:before,
    [data-tooltip]:after {
        visibility: hidden;
        -ms-filter: “progid:DXImageTransform.Microsoft.Alpha(Opacity=0)”;
        filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
        opacity: 0;
        pointer-events: none;
    }

    /* Position tooltip above the element */
    [data-tooltip]:before {
        position: absolute;
        bottom: 150%;
        left: 40%;
        margin-bottom: 5px;
        margin-left: -600px;
        padding: 5px;
        width: 700px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 10px;
        border-color: hsla(0, 0%, 20%, 10.9);
        background-color: hsla(0, 0%, 20%, 10.9);
        background-color: hsl(120, 100%, 2%);
        color: hsl(120, 100%, 80%);
        content: attr(data-tooltip);
        text-align: left;
        font-size: 22px;
        line-height: 1.4;
    }

    /* Triangle hack to make tooltip look like a speech bubble */
    [data-tooltip]:after {
        position: absolute;
        bottom: 150%;
        left: 5%;
        margin-left: -500px;
        width: 0;
        border-top: 5px solid #000;
        border-top: 5px solid hsla(0, 0%, 20%, 10.9);
        border-right: 5px solid transparent;
        border-left: 5px solid transparent;
        content: “ “;
        font-size: 0;
        line-height: 0;
    }

    /* Show tooltip content on hover */
    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after {
        visibility: visible;
        -ms-filter: “progid:DXImageTransform.Microsoft.Alpha(Opacity=100)”;
        filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
        opacity: 1;
    }
    </style>
    <?php
require_once('db/date_format.php');
require_once("db/connection.php");
require_once("db/connect_pmk.php");
?>

    <?php 
$strKeyword=null;
if(isset($_GET["place"]))
{
    $strKeyword = $_GET["place"];
}
?>

    <?php
include('main_script.php');
include('main_top_panel_sub_head.php');
?>
    <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- วันที่ปัจจุบัน -->
    <?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
    <!-- ใช้เรียกเวลาจาก server -->
    <script language="JavaScript">
    // function server_date(now_time) {
    //     current_time1 = new Date(now_time);
    //     current_time2 = current_time1.getTime() + 1000;
    //     current_time = new Date(current_time2);
    //     server_time.innerHTML = current_time.getDate() + "/" + (current_time.getMonth() + 1) + "/" +
    //         current_time
    //         .getYear() + " " + current_time.getHours() + ":" + current_time.getMinutes() + ":" + current_time
    //         .getSeconds();
    //     setTimeout("server_date(current_time.getTime())", 1000);
    // }
    // setTimeout("server_date('<?=$current_server_time?>')", 1000);
    </script>

    <?php
// $current_server_time = date("H:i:s");
?>
    <?php
    $a4='0';$a3='0';$b3='0';$a2b2='0';$a1c2='0';
    $sqlt="SELECT COUNT(I.DEGREE_OF_PATIENT_CODE) AS A4,I.DEGREE_OF_PATIENT_CODE AS D
           FROM IPDTRANS I
           LEFT JOIN DEGREE_OF_IPD_PT_TYPE DOIPT ON DOIPT.CODE = I.DEGREE_OF_PATIENT_CODE
           WHERE I.PLA_PLACECODE = '$strKeyword' AND DATEDISCH IS NULL
           GROUP BY I.DEGREE_OF_PATIENT_CODE";
           $sted = oci_parse($objConnect, $sqlt);
           oci_execute ($sted,OCI_DEFAULT);
           while($rs=oci_fetch_array($sted,OCI_ASSOC))
           {
                if($rs['D']=='4A')
                {
                    $a4=$rs['A4'];
                }
                if($rs['D']=='3A'){
                    $a3=$rs['A4'];
                }
                if($rs['D']=='3B'){
                    $b3=$rs['A4'];
                }
                if($rs['D']=='2B'||$rs['D']=='2A'){
                    $a2b2=$rs['A4'];
                }
                if($rs['D']=='1A' || $rs['D']=='2C'){
                    $a1c2=$rs['A4'];
                }
            }
    ?>

    <?php
    $sql1 = "SELECT ROW_NUMBER() OVER(ORDER BY T.PLA_PLACECODE,BED_NO) AS ROWNO, 
    T.AN,T.HN,T.BED_NO,TO_CHAR(T.DATEADMIT,'DD-MM-YYYY') AS DATEADMIT,
    T.DEGREE_OF_PATIENT_CODE,DOIPT.NAME AS DONA,T.PROCDIAG,T.TREATMNT,
    TO_DATE(SYSDATE,'DD-MM-YY')-TO_DATE(T.DATEADMIT, 'DD-MM-YY') AS NDAY,
    DPA.ALLERGIC_DESC AS DS,T.M_TOTAL,T.CF_CHAR_ID,CF.NAME,(DD.PAT_RUN_HN||'/'||DD.PAT_YEAR_HN) AS DHN,
    DD.PLA_PLACECODE AS DOUTL,(VP.PRENAME||VP.NAME||' '||VP.SURNAME) AS FNAME
    FROM IPDTRANS T
    LEFT JOIN DEGREE_OF_IPD_PT_TYPE DOIPT ON DOIPT.CODE = T.DEGREE_OF_PATIENT_CODE
    LEFT JOIN DRUG_PT_ALLERGY DPA ON DPA.PAT_RUN_HN=T.PAT_RUN_HN AND DPA.PAT_YEAR_HN=T.PAT_YEAR_HN
    LEFT JOIN CHAR_FOODS CF ON CF.CHAR_ID = T.CF_CHAR_ID
    LEFT JOIN V_PATIENTS VP ON VP.HN=T.HN
    LEFT JOIN DATE_DBFS DD ON (DD.PAT_RUN_HN||'/'||DD.PAT_YEAR_HN)=T.HN AND 
              TO_DATE(DD.APP_DATE,'DD-MM-YY')>=TO_DATE(SYSDATE,'DD-MM-YY') AND DD.PLA_PLACECODE='OUTL'
    WHERE T.PLA_PLACECODE = '$strKeyword' AND DATEDISCH IS NULL";

	$stid = oci_parse($objConnect, $sql1);
	oci_execute ($stid,OCI_DEFAULT);
    
	$Num_Rows = oci_fetch_all($stid, $Result);
	$Per_Page = $_GET['rc'];   // Per Page
    if(!isset($_GET['rc']))
     {
        $Per_Page=30;
     }else{
        $Per_Page = $_GET['rc'];
     }

	if(!isset($_GET["Page"]))
	{
		$Page=1;
	}
	else
	{
		$Page = $_GET["Page"];
	}

	$Prev_Page = $Page-1;
	$Next_Page = $Page+1;

	$Page_Start = (($Per_Page*$Page)-$Per_Page);
	if($Num_Rows<=$Per_Page)
	{
		$Num_Pages =1;
	}
	else if(($Num_Rows % $Per_Page)==0)
	{
		$Num_Pages =($Num_Rows/$Per_Page) ;
	}
	else
	{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
	}
	$Page_End = $Per_Page * $Page;
	if ($Page_End > $Num_Rows)
	{
		$Page_End = $Num_Rows;
	}

	$Row_End = $Per_Page * $Page;
	if($Row_End > $Num_Rows)
	{
		$Row_End = $Num_Rows;
	}
	?>

<body>
    <!-- <div class="row"> -->
        <table id="#" cellpadding="35" style="margin-top:50px;"
            class="table table-sm table-border-collapse text-nowrap table-responsive" 
            style="margin-top:-30px;background-color:#008080; height: 3em;
                      white-space: wrap; text-overflow: ellipsis;color:black;">
            <thead>
            <tr style="font-size: 28px;font-weight:bold;height: 30px;">
                <th>
                    <center>HN</center>
                </th>
                <th>NAME</th>
                <th>
                    <center>ADMIT DATE</center>
                </th>
                <th>
                    <center>BED NO.</center>
                </th>

                <th><button class="btn btn-success" style="font-size: 22px;font-weight:bold;">
                        <center>SEVERITY</center>
                    </button>
                </th>
                <th><button class="btn btn-warning" style="font-size: 22px;font-weight:bold;">
                        <center>LOS</center>
                    </button>
                </th>
                <th>
                    <center><i class="fa-solid fa-allergies fa-1x" style="color:#f40428;"></i></center>
                </th>
                <th>
                    <center><i class="fa-solid fa-flask fa-1x" style="color:#f40428;"></i></center>
                </th>
                <th>
                    <center><i class="fa-solid fa-bacteria fa-1x" style="color:#f40428;"></i></center>
                </th>

                <th>
                    <center>DIET</center>
                </th>
                <th>
                    <center>STATUS</i></center>
                </th>
                <th>
                    <center><i class="fa-solid fa-clock"></i></center>
                </th>
                <th>
                    <center>ORIGIN</center>
                </th>
                <th>
                    <center></center>
                </th>
                <th>
                    <center>DESTINATION</i></center>
                </th>
                <th>
                    COMMENTS
                </th>
            </tr>
            </thead>
            <tbody class="scGridLabelFont3">
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
                    $outl=$rs['DOUTL'];

                    // $i++;
                    // if($i%2==0)
                    // {
                    //     $bg = "hsl(0,0%,40%)	";
                    // }
                    // else
                    // {
                    //     $bg = "hsl(240,100%,20%)	";
                    // }
                ?>
                <!-- <tr bgcolor="<?=$bg;?>"> -->
                <tr>
                    <td>
                        <center>
                            <?php
                               echo $hn;
                               echo '</a'; 
                            ?>

                        </center>
                    </td>
                    <td>
                        <?php 
                            echo '<a class="text" style="color:#fafff4;">';                              
                            echo $name;
                            echo '</a>'; 
                        ?>
                    </td>

                    <td>
                        <center>
                            <?php 
                            echo '<a class="text" style="color:#ffff0f;">';
                            echo $dsp; 
                            echo '</a>';
                            ?>
                        </center>
                    </td>
                    <!-- ส่วนงานเตียง -->
                    <td>
                        <center>
                            <?php 
                            echo $bedno; 
                        ?>
                        </center>
                    </td>
                    <!-- จบส่วนงานเตียง -->

                    <!-- ระดับความรุนแรงของโรค -->
                    <td>
                        <center>
                            <?php
                           
                            if($dlc=='4A'){
                                echo '<span class="fa-stack">';
                                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
                                echo '<i class="fa-solid fa-bed fa-stack-1x" style="color:#ffffff;"></i>';
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
                            // เขียว
                            if($dlc=='2A'||$dlc=='2B'){
                                echo '<span class="fa-stack">';
                                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#06D44E;"></i>';
                                echo '<i class="fa-solid fa-bed fa-stack-1x" style="color:#eefdfd;"></i>';
                                echo '</span>';
                            }
                            // ขาว
                            if($dlc=='2C' || $dlc=='1A' || $dlc=='1B'){
                                echo '<span class="fa-stack">';
                                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#eefdfd;"></i>';
                                echo '<i class="fa-solid fa-bed fa-stack-1x" style="color:blue;"></i>';
                                echo '</span>';
                            }
                        ?>
                        </center>
                    </td>
                    <!-- สิ้นสุดระดับความรุ่นแรงของโรค -->

                    <!-- รายการจากวันนอน และรวมค่าใช้จ่ายที่เกิดขึ้นในระหว่างการรักษาตัว โดยการแยกส่วน คชจ ออกมา -->
                    <td>
                        <?php             
                        echo '<center>';
                        echo '<span class="fa-stack">';
                        //  แดง
                        if($nday>='28'){
                            if(($da>='100000') AND $da <='299999'){
                                echo'<a href="#" data-toggle="modal"
                                        class="view_data" data-id="'.$rs['AN'].'">';
                                echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#df0000;"></i>';
                                echo '<i class="fa-solid fa-euro-sign fa-shake fa-stack-1x" style="color:#eefdfd;"></i>';
                            }else{   
                                if(($da>='300000') AND $da <='499999'){
                                    echo '<a href="#">';
                                    echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#df0000;"></i>';
                                    echo '<i class="fa-solid fa-yen-sign fa-shake fa-stack-1x" style="color:#eefdfd;"></i>';
                                    echo '</a>';
                                }else{
                                    if(($da>='500000') AND $da <='799999'){
                                        echo '<a href="#">';
                                        echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#df0000;"></i>';
                                        echo '<i class="fa-solid fa-dollar-sign fa-shake fa-stack-1x" style="color:#eefdfd;"></i>';
                                        echo '</a>';
                                    }else{
                                        if($da>='800000'){
                                            echo '<a href="#">';
                                            echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#df0000;"></i>';
                                            echo '<i class="fa-solid fa-won-sign fa-shake fa-stack-1x" style="color:#eefdfd;"></i>';
                                            echo '</a>';
                                        }else{
                                            echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#df0000;"></i>';
                                        }
                                    }       
                                }
                            }
                        }

                        // 
                        if($nday>='14' AND $nday<=27){
                            if(($da>='100000') AND $da <='299999'){
                                    echo'<a href="#" data-toggle="modal"
                                            class="view_data" data-id="'.$rs['AN'].'">';
                                    echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#FFE162;"></i>';
                                    echo '<i class="fa-solid fa-euro-sign fa-shake fa-stack-1x" style="color:#ff3737;"></i>';
                                }else{   
                                    if(($da>='300000') AND $da <='499999'){
                                        echo '<a href="#">';
                                        echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#FFE162;"></i>';
                                        echo '<i class="fa-solid fa-yen-sign fa-shake fa-stack-1x" style="color:#ff3737;"></i>';
                                        echo '</a>';
                                    }else{
                                        if(($da>='500000') AND $da <='799999'){
                                            echo '<a href="#">';
                                            echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#FFE162;"></i>';
                                            echo '<i class="fa-solid fa-dollar-sign fa-shake fa-stack-1x" style="color:#ff3737></i>';
                                            echo '</a>';
                                        }else{
                                            if($da>='800000'){
                                                echo '<a href="#">';
                                                echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#FFE162;"></i>';
                                                echo '<i class="fa-solid fa-won-sign fa-shake fa-stack-1x" style="color:#ff3737;"></i>';
                                                echo '</a>';
                                            }else{
                                                echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#FFE162;"></i>';
                                            }
                                        }       
                                    }
                                }
                            }

                        // 
                        if($nday <'14'){
                            if(($da>='100000') AND $da <='299999'){
                                echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#06D44E;"></i>';
                                echo '<i class="fa-solid fa-euro-sign fa-shake fa-stack-1x" style="color:#003500;"></i>';
                            }else{   
                                if(($da>='300000') AND $da <='499999'){
                                    echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#06D44E;"></i>';
                                    echo '<i class="fa-solid fa-yen-sign fa-shake fa-stack-1x" style="color:#003500;"></i>';
                                }else{
                                    if(($da>='500000') AND $da <='799999'){
                                        echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#06D44E;"></i>';
                                        echo '<i class="fa-solid fa-dollar-sign fa-shake fa-stack-1x" style="color:#003500;"></i>';
                                    }else{
                                        if($da>='800000'){
                                            echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#06D44E;"></i>';
                                            echo '<i class="fa-solid fa-won-sign fa-shake fa-stack-1x" style="color:#003500;"></i>';
                                        }else{
                                            echo '<i class="fa-solid fa-square fa-stack-2x" style="color:#06D44E;"></i>';
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </td>

                    <!-- Alert การแพ้ยา -->
                    <!-- ถ้ามีรายการแพ้ยาให้มีการแสดง POPUP -->
                    <td>
                        <center>
                            <?php
                            IF($ds<>''){
                                echo '<a href="#patientAlert" data-toggle="modal" data-id="'.$hn.'">';
                                echo '<span class="fa-stack ">';
                                echo '<i class="fa-solid fa-circle fa-stack-2x" style="color:#df0000;"></i>';
                                echo '<i class="fa-solid fa-bell fa-shake" style="color:#fff9f9;"></i>';
                                echo '</span>';
                                echo '</a>';
                            }
                            ?>
                        </center>
                    </td>


                    <!-- รายการLAB -->
                    <td>
                        <center>
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


                    <!--ตรวจสอบข้อมูลที่ขอเปล  -->
                    <?php
                        $slq="SELECT * FROM v_monitor WHERE x1 IN('W','R','E') AND an='$an' AND 
                                hdate='$d_default' AND 
                                ward='$strKeyword'";
                        $rsq=mysqli_query($conn,$slq);               
                        $rw=mysqli_fetch_array($rsq);
                    ?>

                    <!-- Hys-mest  -->
                    <td>
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
                        <div class="fa-2x">
                            <a href="#patientDiet" data-toggle="modal" data-id="<?=$hn?>">
                                <span class="fa-layers fa-fw">
                                    <i class="fas fa-square" style="color:#fffbfb;"></i>
                                    <span class="fa-layers-text" data-fa-transform="shrink-8 down-0"
                                        style="font-weight:bold;font-size:44px;color:<?=$cfc;?>"><?=$cfn;?>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </td>

                    <!--  -->
                    <td>
                        <?php                      
                        echo '<center>';
                        if($rw['x1']=='W'){
                            echo '<i class="fa-solid fa-circle-plus fa-beat fa-2x" style="color:#FFE162;"></i>';
                        }

                        if($rw['x1']=='R'){
                            echo '<i class="fa-solid fa-rotate fa-spin fa-2x" style="color:#FFE162;"></i>';
                        }

                        if($rw['x1']=='E'){
                            echo '<i class="fa-solid fa-wheelchair fa-beat fa-2x" style="color: #FFE162"></i>';
                        }
                        echo '</center>';
                        echo '</td>';    
                    ?>

                        <!-- ต้นทาง -->
                    <td>
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
                    </td>

                    <?php
                        echo '<td>';
                        if($rw['x1']=='W'||$rw['x1']=='R'||$rw['x1']=='E')

                        {
                            echo $rw['fplace'];
                        }
                        echo '</td>';                             

                        //จุดหมาย
                        echo '<td>';
                        if($rw['x1']=='W'||$rw['x1']=='R'||$rw['x1']=='E')
                        {
                            echo '<i class="fa-solid fa-circle-right fa-2x fa-beat " style="color:#06D44E"></i>';
                        }
                        echo '</td>';                             

                        echo '<td>';
                        if($rw['x1']=='W'||$rw['x1']=='R'||$rw['x1']=='E')
                        {
                            echo $rw['tplace'];
                        }
                        echo '</td>';  
                    ?>
                    <!-- <td>
                        <div class="fa-2x">
                            <span class="fa-layers fa-fw">
                                <i class="fas fa-square"></i>
                                <span class="fa-layers-text" data-fa-transform="shrink-8 down-0"
                                    style="font-weight:bold;font-size:44px;color:<?=$cfc;?>"><?=$cfn;?>
                                </span>
                            </span>
                        </div>
                    </td> -->

                    <?php
                    echo '<td>';
                        if($outl <> '' || $cm=='')
                        {        
                            if($cm<>'')
                            {
                                echo '<a href="#" style="color: #2feaff;>';
                                echo $cm;
                                echo '</a>';
                            }
                            if($outl<>''){
                                ?>
                    <div class="fa-2x">
                        <a href="#" data-toggle="modal" data-target="#lightbox" <span class="fa-layers fa-fw">
                            <i class="fas fa-square" style="color:#004040;"></i>
                            <span class="fa-layers-text" data-fa-transform="shrink-8 down-0"
                                style="font-weight:bold;font-size:44px;color:#ffffff">OUT
                            </span>
                            </span>
                        </a>
                    </div>

                    <?php
//                                 echo '<div class="fa-2x">';
//                                 echo '<a href="#" data-toggle="modal" data-target="#lightbox"';
//                                 ECHO '<span class="fa-layers fa-fw">';
//                                 ECHO '<i class="fas fa-square" style="background-color:#006c6c></i>';
//                                 ECHO '<span class="fa-layers-text" data-fa-transform="shrink-8 down-0"';
//                                 ECHO ' style="font-weight:bold;font-size:40px;color:#a60053">OL';
//                                 ECHO '</span>';
//                                 ECHO '</span>';
//                                 ECHO '</a>'; 

// echo '</div>';
                                // echo '<a href="#" data-toggle="modal" data-target="#lightbox" 
                                //         style="color: #ffb3cd; background-color:#a60053;">
                                //          <i class="fa-solid fa-bacteria fa-1x fa-lg"></i>
                                //       </a>';
                            }        
                        }
                    ?>
                    </td>
                </tr>
                <?php   
                oci_close($objConnect);
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- <div class="alert alert-warning">
        <div class="row">
            <center>
                <div class="col-md-1 a4cir">
                    <?php echo $a4?>
                </div>

                <div class="col-md-1 a4cir">
                    <?php echo $a3?>
                </div>
                <div class="col-md-1 a4cir">
                    <?php echo $b3;?>
                </div>
                <div class="col-md-1 a4cir">
                    <?php echo $a2b2?>
                </div>
                <div class="col-md-1 a4cir">
                    <?php echo $a1c2;?>
                </div>
            </center>
        </div>
    </div>
 -->
    <P>
    <div class="row" style="font-size:18px;font-weight:bold;color:rgb(230, 236, 255);">
        <div class="col-md-4" style="margin-top:15px;">
            <div class="alert">
                <span class="fa-stack fa-lg">
                    <i class="fa-solid fa-circle fa-stack-2x" style="color:#ad013e;"></i>
                    <i class="fa-solid fa-bed fa-stack-1x" style="color:#eefdfd;"></i>
                </span>
                =4A

                <span class="fa-stack fa-lg">
                    <i class="fa-solid fa-circle fa-stack-2x" style="color:#f339ed;"></i>
                    <i class="fa-solid fa-bed fa-stack-1x" style="color:#eefdfd;"></i>
                </span>
                =3A
                <span class="fa-stack fa-lg">
                    <i class="fa-solid fa-circle fa-stack-2x" style="color:#FFE162;"></i>
                    <i class="fa-solid fa-bed fa-stack-1x" style="color:#eefdfd;"></i>
                </span>
                =3B
                <span class="fa-stack fa-lg">
                    <i class="fa-solid fa-circle fa-stack-2x" style="color:#06D44E;"></i>
                    <i class="fa-solid fa-bed fa-stack-1x" style="color:#eefdfd;"></i>
                </span>
                =2A 2B
                <span class="fa-stack fa-lg">
                    <i class="fa-solid fa-circle fa-stack-2x" style="color:#eefdfd;"></i>
                    <i class="fa-solid fa-bed fa-stack-1x" style="color:blue;"></i>
                </span>
                =2C 1A 1B
            </div>
        </div>

        <div class="col-md-4" style="margin-top:15px;">
            <div class="alert">
                นอน < 14 วัน=<span class="fa-stack fa-lg">
                    <i class="fa fa-square fa-2x" style="color:#06D44E;"></i>
                    </span>

                    14-27 วัน =
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-2x" style="color:#FFE162;"></i>
                    </span>

                    >=28 วัน =
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-2x" style="color:#ad013e;"></i>
                    </span>
            </div>
        </div>

        <div class="col-md-4" style="margin-top:15px;">
            <div class="alert">
                100-300K=
                <span class="fa-stack fa-lg">
                    <!-- <i class="fa fa-square fa-stack-1x" style="color:#ad013e;"></i> -->
                    <i class="fa-solid fa-euro-sign fa-2x" style="color:#eefdfd;"></i>
                </span>

                300-500K=
                <span class="fa-stack fa-lg">
                    <!-- <i class="fa fa-square fa-stack-1x" style="color:#ad013e;"></i> -->
                    <i class="fa-solid fa-yen-sign fa-2x" style="color:#eefdfd;"></i>
                </span>

                500-800K=
                <span class="fa-stack fa-lg">
                    <!-- <i class="fa fa-square fa-stack-1x" style="color:#ad013e;"></i> -->
                    <i class="fa-solid fa-dollar-sign fa-2x" style="color:#eefdfd;"></i>
                </span>
                >800K=
                <span class="fa-stack fa-lg">
                    <!-- <i class="fa fa-square fa-stack-2x" style="color:#ad013e;"></i> -->
                    <i class="fa-solid fa-won-sign fa-2x" style="color:#eefdfd;"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="container row-fluid scGridLabelFont2" style="margin-left:20px;font-size:22px;font-weight:bold;">
        <form>
            <p>
            <p> ทั้งหมด <?php echo $Num_Rows;?> คน -> มี <?php echo $Num_Pages;?> หน้า :
                <?php
                if($Prev_Page)
                {
                    echo "<a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&place=$strKeyword&rc=$Per_Page'></a>";
                }
                for($i=1; $i<=$Num_Pages; $i++)
                {
                    if($i != $Page)
                    {
                       echo "[<a href='$_SERVER[SCRIPT_NAME]?Page=$i&place=$strKeyword&rc=$Per_Page' >$i</a >] ";
                    }
                    else
                    {
                        echo "<b> $i </b>";
                    }
                }
                if($Page!=$Num_Pages)
                {
                echo "<script type='text/javascript'>
                        setInterval(function(){
                            window.location.href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&place=$strKeyword&rc=$Per_Page';
                        },60000);
                      </script>";
                }
                else
                {
                echo "<script type='text/javascript'>
                    setInterval(function(){
                        window.location.href ='$_SERVER[SCRIPT_NAME]?Page=1&place=$strKeyword&rc=$Per_Page';
                    },60000);
                    </script>";
                }
                ?>
        </form>
    </div>
    <script src="assets/lightbox/js/lightbox.min.js"></script>
</body>

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
                    <i class='fa fa-warning'></i>แจ้งเตือนรายการแพ้ยา
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
                    <i class="text text-danger"></i> รายการอาหารสำหรับคนไข้
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

</html>

<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-content">
            <div class="modal-body">
                <video width="1200" height="800" loop="true" autoplay="autoplay" controls="controls" id="vid" muted>
                    <source src="img/fama.mp4" type="video/mp4">
                </video>
                <!-- <img src="img/famatext.jpg" align="center" alt="" /> -->
            </div>
        </div>
    </div>
</div>