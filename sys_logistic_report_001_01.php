<!-- <script type="text/javascript">
window.onload = function() {
    window.print();
}
</script> -->

<!doctype html>
<meta http-equiv="content-type" content=";text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php 
include('main_script.php');
include('db/connection.php');
?>
<html>
<?php
    $htem=@$_GET['id'];
?>

<!-- // วันที่ปัจจุบัน    -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
$time=date("H:i:s");    
?>

<head>
    <title>Logistic Manage System</title>

    <style>
    .container {
        width: 100%;
        margin: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 0px;
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 0px;
        padding: 0px;
    }

    .table-striped tbody>tr:nth-child(odd)>td,
    .table-striped tbody>tr:nth-child(odd)>th {
        background-color: #f9f9f9;
    }

    @media print {
        #print {
            display: none;
        }
    }

    #print {
        width: 100px;
        height: 10px;
        font-size: 9px;
        background: white;
        border-radius: 1px;
        margin-left: 0px;
        cursor: hand;
    }
    </style>

</head>

<body onLoad="window.print();">
    <?php
	    $result= mysqli_query($conn,"select * from v_asmonitor_b where hyitem='$htem' ") 
                 or die (mysqli_error());
        $row=mysqli_fetch_array ($result);
    ?>

    <!--  -->
    <div class="mydiv5" style="position:absolute; left:12px;top:12px; width:453px;height:19px;">
       <img src="img/hy.png" style="margin-top:0px;float:left;margin-bottom:-6px; width:90px; height:90px;">
    </div>
    <div class="mydiv2" style="position:absolute; left:12px;top:12px; width:453px;height:19px;">
        <h5 style="font-weight:bold;font-size:18px;margin-top:10px;text-align:center;">รหัสงาน<h5>
                <h5 style="font-weight:bold;font-size:20px;margin-top:-10px;text-align:center;">
                    <?php echo $row['dgroup'].'-'.$row['hyitem'];?></h5>
                <hr style="font-weight:bold;margin-top:-10px;text-align:center;">
    </div>
    <!--  -->
</body>

</html>