<!-- แสดงวันที่เป็นภาษาไทย -->
<?php
date_default_timezone_set('Asia/Bangkok');
$thai_day_arr = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$thai_month_arr = array(

    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน",
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"
);
function thai_date($time){
    global $thai_day_arr,$thai_month_arr;
    $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return.= "ที่ ".date("j",$time);
    $thai_date_return.=" ".$thai_month_arr[date("n",$time)];
    $thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);

    return $thai_date_return;
}
$eng_date=time();
 ?>

<!DOCTYPE html>
<html>

<head>
    <title>รายชื่อผู้ป่วย</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="img/hh.png">
    <meta http-equiv="refresh" content="500;URL=ward_main_monotor.php">

    <style>
    body {
        padding-top: 70px;
    }
    </style>
</head>
<?php
include('db/connect_pmk.php');
include('main_script.php');
?>

<body>
    <?php
    $strKeyword=null;
    if(isset($_GET["place"]))
    {
        $strKeyword = $_GET["place"];
    }
    ?>
    <?php
    include('db/connect_pmk.php');
    ?>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Taviraj');

    .scGridLabelFont {
        color: #FFF;
        font-family: 'Taviraj', sans-serif;
        font-size: 58px;
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
        color: #000;
        font-family: 'Taviraj', sans-serif;
        font-size: 40px;
        font-weight: bold;
        padding: 2px 4px;
        text-decoration: none;
    }

    @import url('https://fonts.googleapis.com/css?family=Kanit:600');

    .scGridLabelFont3 {
        color: #000;
        font-family: 'Taviraj', sans-serif;
        font-size: 25px;
        font-weight: bold;
        padding: 2px 4px;
        text-decoration: none;
    }
    </style>

    <!-- วันที่ปัจจุบัน -->
    <?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header" style="text-align:center">
                <form class="navbar-form navbar-center"></form>
                <form class="navbar-form navbar-center">
                    <div class="scGridLabelFont2">
                        รายชื่อผู้ป่วย Ward : <?php echo $_GET['place']; ?> &nbsp;
                        วันที่ <?php echo ($d_default); ?>
                        <!-- <?php echo thai_date($eng_date); ?> -->
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <?php
    // require_once('db/date_format.php');
    require_once("db/connection.php");
    require_once("db/connect_pmk.php");
    ?>

    <?php
    $sql1 = "SELECT ROW_NUMBER() OVER(ORDER BY DATEADMIT DESC) AS ROWNO, 
             T.AN,T.FLNAME,T.BED_NO,TO_CHAR(T.DATEADMIT,'DD-MM-YYYY') AS DATEADMIT
             FROM IPDTRANS T
			 WHERE T.PLA_PLACECODE = '$strKeyword' AND DATEDISCH IS NULL AND BED_NO IS NOT NULL";
	$stid = oci_parse($objConnect, $sql1);
	oci_execute ($stid,OCI_DEFAULT);
    
	$Num_Rows = oci_fetch_all($stid, $Result);
	$Per_Page = 9;   // Per Page

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
    <div class="container" style="width:100%;">
        <br>
        <table id="Table" style="word-wrap: break-word;  overflow: hidden;" class="table table-condensed table-hover">
            <thead>
                <tr class="scGridLabelFont" bgcolor="#20B2AA">
                    <th>#</th>
                    <th>AN</th>
                    <th>ชื่อผู้ป่วย</th>
                    <th>เตียง</th>
                    <th>พักรักษา</th>
                    <th> เปล </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2 = "SELECT C.* FROM ($sql1) C WHERE C.ROWNO > $Page_Start AND C.ROWNO <= $Row_End";
                $stid = oci_parse($objConnect, $sql2);
                oci_execute ($stid,OCI_DEFAULT);

                while($row = oci_fetch_array($stid,OCI_ASSOC))
                {
                    $an= $row["AN"];
                ?>
                <tr class="scGridLabelFont1" bgcolor="#000000">
                    <td><?php echo $row["ROWNO"];?></td>
                    <td><?php echo $row["AN"];?></td>
                    <td><?php echo $row["FLNAME"];?></td>
                    <td><?php echo $row["BED_NO"];?></td>
                    <td><?php echo $row["DATEADMIT"];?></td>

                    <?php
                    $slq="SELECT * FROM hycent WHERE an='$an' and 
                            hdate='$d_default' and ward='$strKeyword' and x1 in('W','R','E','F') ";
                    $rsq=mysqli_query($conn,$slq);               
                    $rw=mysqli_fetch_array($rsq);
                    ?>
                    <td class="text-center">
                        <?php 
                        // รอีับงาน
                        if($rw['x1']=='W'){
                            echo '<a class="btn btn-default btn-grad">';
                            echo '<i class="fa fa-bed fa-3x" style="color:blue"></i>';
                            echo '</a>';                                        
                        }else{
                        // รับงาย
                            if($rw['x1']=='R'){
                                echo '<a class="btn btn-default btn-grad">';
                                echo '<i class="fa fa-bed fa-3x" style="color:orange"></i>';
                                echo '</a>';                                        
                            }else{
                                // .'ดำเนินการ'
                                if($rw['x1']=='E'){
                                  echo '<a class="btn btn-default btn-grad">';
                                  echo '<i class="fa fa-bed fa-3x" style="color:green"></i>';
                                  echo '</a>';                                        
                                }else{
                                // จบงาน
                                    if($rw['x1']=='F'){
                                        echo '<a class="btn btn-default btn-grad">';
                                        echo '<i class="fa fa-bed fa-3x" style="color:red"></i>';
                                        echo '</a>';                                        
                                    }  
                                }
                            }             
                        }
                    ?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <form class="navbar-form navbar-center">
            <div class="scGridLabelFont3">
                ทั้งหมด <?php echo $Num_Rows;?> คน : มี <?php echo $Num_Pages;?> หน้า :
                <?php
                if($Prev_Page)
                {
                    echo "<a href='$_SERVER[SCRIPT_NAME]?Page=$Prev_Page&place=$strKeyword'></a>";
                }
                for($i=1; $i<=$Num_Pages; $i++){
                    if($i != $Page)
                    {
                       echo "[<a href='$_SERVER[SCRIPT_NAME]?Page=$i&place=$strKeyword' >$i</a >] ";
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
                            window.location.href ='$_SERVER[SCRIPT_NAME]?Page=$Next_Page&place=$strKeyword';
                        },20000);
                      </script>";
                }
                else
                {
                echo "<script type='text/javascript'>
                    setInterval(function(){
                        window.location.href ='$_SERVER[SCRIPT_NAME]?Page=1&place=$strKeyword';
                    },20000);
                    </script>";
                }
            oci_close($objConnect);
            ?>
            </div>
        </form>
    </div>
</body>

</html>