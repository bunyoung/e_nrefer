<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Refer</title>
</head>
<?php
    require_once("db/connection.php");
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];

 #ตรวจสอบสิทธิการเข้าใช้งาน
 if ($hcode=="") 
{
    echo (
        "<script>
                Swal.fire({
                    title: 'ไม่พบสิทธิ [admin]'',
                    text: 'ข้อความนี้สำหรับแจ้งให้ผู้ใช้งานทราบ',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
           });
           window.location.href='dashboard.php';
        </script>");
}
?>
<?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
?>
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>

<body style="font-family:K2D;font-size:18px;">
    <div class="container" >
        <p>
        <div class="outer">
            <div class="inner bg-light lter">
                <br>
                <div class="row-fluid">
                    <div class="span4">
                        <div class="alert alert-success">
                            <form class="form-inline" action="monitor_now_powerbi_now_real.php" name="ins_fund_main"
                                method="POST" target="_blank">
                                <input type="hidden" name='pid' id='pid' value=<?php '1'; ?> >
                                <span>
                                    <i class="fa fa-clock-o"></i>&nbsp;&nbsp; ค้นหาข้อมูล ระหว่างวันที่ :
                                    <input data-provide="datepicker" data-date-language="th-th" type="text"
                                        name="d_start" value="<?php echo $d_start; ?>" class="form-control autotab"
                                        placeholder="วัน / เดือน / ปี ระหว่างวันที่" />
                                    ถึงวันที่ :
                                    <input data-provide="datepicker" data-date-language="th-th" type="text" name="d_end"
                                        value="<?php echo $d_end; ?>" class="form-control autotab"
                                        placeholder="วัน / เดือน / ปี ถึงวันที่" />

                                    <button type="submit" class="btn btn-info" value="submit"> แสดงข้อมูล </button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>