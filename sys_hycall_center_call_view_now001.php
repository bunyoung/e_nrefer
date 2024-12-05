<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-hycenter</title>
</head>

<style>
#toolbar {
    margin: 0;
}
</style>

<?php
include("db/connection.php");
include('main_script.php');
?>

<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php
$sta='';
$sql ="SELECT * FROM v_monitor WHERE  hdate = '$d_default' order by name";
$result_sql = mysqli_query( $conn,$sql);
?>

<body>
    <script>
    $(document).ready(function() {
        $("#export_to_excel").click(function() {
            $("#dataTable").table2excel({
                exclude: ".noExl",
                name: "E-Hycenter",
                // filename: "ทะเบียนบัญชีลูกหนี้_<?php echo $client_name; ?>_วันที่_<?php echo $d_start; ?>_ถึงวันที่_<?php echo $d_end; ?>.xls",
                filename: "การบริการเคลื่อนย้ายผู้ป่วย<?php echo 'xxxx'; ?>_วันที่_<?php echo 'xxxx'?>_ถึงวันที่_<?php echo 'xxxx'; ?>.xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
    </script>
    <div class="inner bg-light lter" style="margin-top:-40px;">
        <div class="col-md-12">
            <div class="box">
                <header>
                    <div class="icons">
                        <button id="export_to_excel" class="btn btn-success btn-xs btn-grad">
                            <i class="fa fa-file-excel-o"></i></button>
                    </div>
                    <h5 id="div1">ทะเบียนผู้ป่วยที่อยู่ระหว่างการดำเนินการเคลื่อนย้าย (สำหรับตรวจสอบ) ประจำวันที่_
                        <a class="text-success">
                            <?PHP echo $d_default; ?>
                        </a>
                    </h5>

                </header>

                <div id="collapse4" class="body" style="overflow:scroll">
                    <table id="dataTable" style="word-wrap: break-word;  overflow: hidden;"
                        class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr class="gradeA">
                                <th> <strong> เลขที่ อ้างอิง </strong></th>
                                <th> <strong> HN </strong></th>
                                <th> <strong> ชื่อ - สกุลผู้ป่วย </strong></th>
                                <th> <strong> รับจาก </strong></th>
                                <th> <strong> ไปส่งที่ </strong></th>
                                <th> <strong> วัตถุประสงค์ เพื่อ </strong></th>
                                <th> <strong> วิธีการเคลื่อนย้าย </strong></th>
                                <th> <strong> อุปกรณ์เพิ่ม </strong></th=>
                                <th> <strong> ผป.เฉพาะ </strong></th>
                                <th> <strong> เวลาร้องขอ </strong></th>
                                <th> <strong> เวลาจ่ายงาน </strong></th>
                                <th> <strong> เวลารับงาน </strong></th>
                                <th> <strong> เวลาจบงาน </strong></th>
                                <th align='center'> <strong> ผู้รับผิดชอบ </strong></th>
                                <th align='center'> <strong> สถานะงาน </strong></th>
                                <th align='center'> <strong> ยกเลิก </strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                            <tr class="gradeA" valign='top'>
                                <td> <?php echo $arr['hyitem']; ?> </td>
                                <td> <?php echo $arr['hn']; ?> </td>
                                <td> <?php echo $arr['patients'] ?> </td>
                                <td> <?php echo $arr['fplace'] ?> </td>
                                <td> <?php echo $arr['tplace'] ?> </td>
                                <td> <?php echo $arr['assname'] ?> </td>
                                <td> <?php echo $arr['hassnamea']?> </td>
                                <td> <?php echo $arr['hassnameb']?> </td>
                                <td>
                                    <?php if($arr['ems']=='EMS'){
                        echo '<a class="btn btn-danger btn-grad">'.$arr['ems'];
                        echo '</a>';
                    }else{
                        echo $arr['sicka'].' '.$arr['sickb'].' '
                             .$arr['sickc'].' '.$arr['sickd'].' '.$arr['sicke'].' '
                             .$arr['sickf'].' '.$arr['sickg'].' '.$arr['ems'].' '
                             .$arr['sickh'].' '.$arr['covidgp'];
                    }
                    ?>
                                </td>
                                <td> <?php echo $arr['htime']; ?> </td>
                                <td> <?php echo $arr['x1_pertime']; ?> </td>
                                <td> <?php echo $arr['perto']; ?> </td>
                                <td> <?php echo $arr['perfinish']; ?> </td>

                                <td> <?php echo $arr['name']; ?> </td>
                                <td align="center">
                                    <?php
                                    IF($arr['x1']=="C"){
                                    echo'<a class="btn btn-danger btn-grad">';
                                    } ELSE
                                    if($arr['x1']=='F'){
                                    echo'<a class="btn btn-success btn-grad">';
                                    }else
                                    if($arr['x1']=='W'){
                                    echo'<a class="btn btn-info btn-grad">';

                                    }IF($arr['x1']=="C"){
                                    echo '<i class="fa fa-thumbs-o-up"></i>: กำลังดำเนินการ';
                                    } ELSE
                                        IF($arr['x1']=="F"){
                                        echo '<i class="fa fa-thumbs-o-up"></i>: ดำเนินการสิ้นสุด';}
                                    else {
                                    echo '<i class="fa fa-times"></i>  : รอดำเนินการ';}
                                    echo'</a>';
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                IF($arr['x1']=='W') {
                                    echo'<a href="#myModal_receive_cancel" data-toggle="modal"
                                    data-id="'.$arr['hyitem'].'" class="btn btn-danger btn-grad">';
                                }else{
                                    echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                                    echo'</a>';
                                }
                                IF($arr['x1']=='W') {
                                    echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                                    echo'</a>';
                                }
                                ?>
                                </td>
                            </tr>
                            <?php
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#dataTable').dataTable();
    });
    </script>
</body>
<!-- Preloader -->
<!-- ajax selection   -->
<!-- <script type="text/javascript" src="./assets/js/ajax_jquery.min.js"></script> -->
<!--- Script layout -->
<!-- App scripts -->
<script type="text/javascript">
$(function() {
    $('#boxed-layout').click(function() {
        if ($('body').hasClass('boxed')) {
            $('body').removeClass('boxed');
            $('.status-boxed-layout').html("Off")
        } else {
            $('body').addClass('boxed');
            $('.status-boxed-layout').html("<span class='text-success font-bold'>On</span>");
            $('body').removeClass('fixed-small-header');
            $('body').removeClass('sidebar-scroll');
            $('#navigation').slimScroll({
                destroy: true
            });
            $('#navigation').attr('style', '');
            $('body').removeClass('fixed-navbar');
            $('body').removeClass('fixed-footer');
            $('.status-fixed-small-header').html("Off");
            $('.status-fixed-footer').html("Off");
            $('.status-fixed-sidebar').html("Off");
            $('.status-fixed-navbar').html("Off");
        }
    });
});
</script>
<!--- End Script layout -->
<script type="text/javascript">
//<![CDATA[
$(window).load(function() {
    // makes sure the whole site is loaded
    $('#status').fadeOut();
    // will first fade out the loading animation
    $('#preloader').delay(500).fadeOut('slow');
    // will fade out the white DIV that covers the website.
    $('body').delay(800).css({
        'overflow': 'visible'
    });
})
//]]>
</script>
<script>
$(document).ready(function() {
    $('#dataTable').dataTable();
});
</script>

</html>