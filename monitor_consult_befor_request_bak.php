<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e_consult</title>
    <link rel="stylesheet" href="/node_modules/font-awesome-animation/css/font-awesome-animation.min.css">
</head>
<?php    
if(!isset($_SESSION)) {  
    session_start();  
    $sm_code =  $_SESSION['n_code'];
    $sm_mcode= $_SESSION['n_depart'];
}
?>

<style>
.btn-red {
    background-color: #ff0000;
    color: white;
}

.btn-orange {
    background-color: #ff8c00;
    color: white;
}

.btn-yellow {
    background-color: #FFFF00;
    color: black;
}

.btn-green {
    background-color: #00331a;
    color: white;
}

.btn-skyblue {
    background-color: #87eeeb;
    color: white;
}
</style>

<!-- ทำ Refresh หากไม่มีการเลื่อน Mouse -->
<script>
var time = new Date().getTime();
$(document.body).bind("mousemove keypress", function(e) {
    time = new Date().getTime();
});

function refresh() {
    if (new Date().getTime() - time >= 180000)
        window.location.reload(true);
    else
        setTimeout(refresh, 30000);
}

setTimeout(refresh, 10000);
</script>

<?php include('main_top_panel_head.php'); ?>
<?php include('db/connection.php'); ?>
<?php include('main_script.php');?>

<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult; 
?>

<!-- มอบหมายงานให้กับแพทย์ ผู้ที่ถูก Consult -->
<?PHP
if(@$_POST['RFT'])
{ 
$date = date("d-m-Y");
$time = date("H:i:s");
$consid=@$_POST['hy_cons'];
$uptime=date("d-m-Y H:i:s");
$pstatus='S';
$doctor=$_POST['doctor'];
$dcomment=$_POST['d_comment'];

$sql_hycenter = "
    UPDATE e_cons_detail SET status='S',mdoc=TRIM('$doctor') ,
    rec_date='$date',rec_time='$time'
    WHERE cons_id='$consid'; ";
$result_comment = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_comment) {
    $error1 = ' UPDATER ให้คำปรึกษา';
    $error2 = ' บันทึก มอบให้คำปรึกษา เรียบร้อยแล้ว';

    // Call Line notify
    $sql ="SELECT *, REPLACE(hn,'/','')||REPLACE(an,'/','') FROM v_consult_detail WHERE cons_id='$consid' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        while($row1 = mysqli_fetch_assoc($result)) 
        {
            $fan=$row1['an'];
        
            // $da=$row1['rec_date'];
            $pn=$row1['pname'];
            $line = $row1['doc_line'];
    
             define('LINE_API', "https://notify-api.line.me/api/notify");
            //  xXTej2PuQaXaJ9uBhqHy1ufpnkDzZVU5tQd9Txxmkmv
            //  $token = "TUbVGTCUuDP12IMtu7YbtnmfgvRPMSbRZo9OCPzgtdN"; //ใส่Token ที่copy เอาไว้
             $token = "xXTej2PuQaXaJ9uBhqHy1ufpnkDzZVU5tQd9Txxmkmv"; //ใส่Token ที่copy เอาไว้
            // $token = $row1['doc_line'];
             $headers    = [
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer '.$token
                ];
                $str= 
                "\r\n".'มีการร้องของ Consult'.
                "\r\n".'...........................................'.                       
                "\r\n".'เลขที่ใบ Consult : '.$row1['mcode'].'-'.$row1['cons_id'].
                "\r\n".'ความเร่งด่วน  : '.$row1['e_fast'].              
                "\r\n".'วันที่ร้องขอ : '.$row1['cons_date'].'  เวลา :'.$row1['cons_time'].' น.'.
                "\r\n".'AN :'.$row1['an'].'  HN: '.$row1['hn'].'  '.$row1['pname'].
                "\r\n".'Ward: '.$row1['fullplace'].
                "\r\n".'Bed : '.$row1['beds'].
                "\r\n".'จุดประสงค์ปรึกษา : '.$row1['exp'].
                "\r\n".'ชื่อแพทย์ผู้ปรึกษา : '.$row1['namea'].'  '.$row1['surnamea'].
                "\r\n".'Ward staff : '.$row1['nameb'].'  '.$row1['surnameb'].
                "\r\n".'กลุ่มงาน : '.$row1['conmdepname'].
                "\r\n".'http://192.168.4.246/pt/?idx='.$row1['nidx'].
                "\r\n".'(ใช้ wifi โรงพยาบาล)';
                $res = notify_message($str,$token,$message_data);
                print_r($res);
                unset($_SESSION['success']);
        }
    }
 }else {
   $error1 = ' Update Error ';
   $error2 = ' ไม่สามารถดำเนินการได้  ';
 }
}
?>
<!-- สิ้นสุดการให้ consult แพทย์ -->

<body>
    <div class="inner bg-light lter" style="margin-top: -25px;">
        <div id="content3" class="container-fluid" id="navcolor">
            <div class="table-responsive-sm">
                <br>
                <table id="vfdataTable" class="table table-sm table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <td align='center'><strong>ลำดับ</strong></td>
                            <td align='center'><strong>CONS NO.</strong></td>
                            <td><strong>วันที่ขอ </strong></td>
                            <td><strong>เวลาขอ</strong></td>
                            <td><strong>AN </strong></td>
                            <td><strong>HN </strong></td>
                            <td><strong>ผู้ป่วย </strong></td>
                            <td><strong>เพศ </strong></td>
                            <td><strong>อายุ (ปี)</strong></td>
                            <td><strong>WARD</strong></td>
                            <td><strong>กลุ่มงาน-หน่วยที่ขอ Consults</strong></td>
                            <td><strong>ชื่อแพทย์รับ Consults</strong></td>
                            <td><strong>ความเร่งด่วน</strong></td>
                            <td align='center'><strong>สถานะ</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        #SQL
                        $sql="SELECT * FROM  v_consult_detail WHERE mcode =  '$sm_code'  ORDER BY cons_id DESC";
                        $result_sql = mysqli_query($conn,$sql);
                        $i=1;
                        WHILE($arr=mysqli_fetch_array($result_sql)) {
                        ?>
                        <tr id="monitor">
                            <td>
                                <center>
                                    <?php    
                                    $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else if(strlen($n)=='3'){echo '0';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}
                                    ?>
                                </center>
                            </td>
                            <td>
                                <?php 
                                    echo'
                                     <a href="print_consult_a4.php?id='.$arr['cons_id'].' data-toggle="modal" data-id="'.$arr['cons_id'].'" target="_blank"
                                          class="btn btn-success btn-grad ">';
                                    echo'
                                       <i class="fa fa-print fa-2x" aria-hidden="true" style="font-size:15px;"></i>'.' '.$arr['mcode'].'-'.$arr['cons_id'];
                                   echo'
                                   </a>';        
                                ?>
                                <?php 
                                echo $arr['mcode'].'-'.$arr['cons_id'];
                                ?>
                            </td>
                            <td><?php echo $arr['cons_date']; ?> </td>
                            <td><?php echo $arr['cons_time']; ?> </td>
                            <td><?php echo $arr['an']; ?> </td>
                            <td><?php echo $arr['hn']; ?> </td>
                            <td><?php echo $arr['pname']; ?> </td>
                            <td><?php echo $arr['sex']; ?> </td>
                            <td><?php echo $arr['age'];?> </td>
                            <td><?php echo $arr['fullplace']; ?> </td>
                            <td><?php echo $arr['m_depname'].'-'.$arr['s_ename']; ?> </td>
                            <!-- แพทย์ -->
                            <td>
                                <?php
                                IF($arr['mdoc']==''){
                                    echo'<a href="#" data-toggle="modal"
                                    data-id="" class="btn btn-warning btn-grad">';
                                    echo 'รอระบุ'; 
                                }else{
                                    if($arr['status']<>'C'){
                                        echo'<a href="#myModal_receive_consult" data-toggle="modal"
                                        data-id="'.$arr['cons_id'].'" class="btn btn-success btn-grad">';
                                        echo '['.$arr['mdoc'].'] '.$arr['prec'].' '.$arr['namec'].' '.$arr['surnamec'];   
                                    }else{
                                        echo'<a href="myModal_receive_consult" data-toggle="modal"
                                        data-id="'.$arr['cons_id'].'" class="btn btn-primary btn-grad">';
                                        echo '['.$arr['mdoc'].'] '.$arr['prec'].' '.$arr['namec'].' '.$arr['surnamec'];   
                                    }
                                }
                                echo '</a>';
                                ?>
                            </td>

                            <!-- ความเร่งด่วน -->
                            <td>
                                <?php 
                                if($arr['fcolor']=='R'){
                                    echo'<a href="#" data-toggle="modal"
                                    data-id="" class="btn btn-danger btn-grad">';
                                    // echo '<i class="fa-solid fa-family-pants"></i>';
                                }else{
                                    if($arr['fcolor']=='Y'){
                                        echo'<a href="#" data-toggle="modal"
                                        data-id="" class="btn btn-warning btn-grad">';
                                    // echo '<i class="fa-solid fa-family-pants"></i>';
                                }else{
                                        if($arr['fcolor']=='G'){
                                            echo'<a href="#" data-toggle="modal"
                                            data-id="" class="btn btn-success btn-grad">';   
                                    // echo '<i class="fa-solid fa-family-pants"></i>';
                                }else{
                                            echo'<a href="#" data-toggle="modal"
                                            data-id="" class="btn btn-default btn-grad">';   
                                    // echo '<i class="fa-solid fa-family-pants"></i>';
                                }
                                    }
                                }
                                echo '    '.$arr['e_fast']; 
                                echo '</a>';
                                ?>
                            </td>

                            <!-- สถานะการรับทราบ -->
                            <td align="center">
                                <?php
                                IF($arr['status']=='N') 
                                {
                                    echo'<a href="#myModal_receive_consult" data-toggle="modal"
                                        data-id="'.$arr['cons_id'].'" class="btn btn-warning btn-grad">';
                                }
                                IF($arr['status']=='N') 
                                {
                                    echo'<i class="	fa fa-calendar fa-2x" style="width=10px;"></i>  CONS Waiting';
                                    echo'</a>';
                                }

                                IF($arr['status']=='C') 
                                {
                                    echo'<a href="#myModal_receive_comment" data-toggle="modal"
                                    data-id="'.$arr['cons_id'].'" class="btn btn-success btn-grad">';
                                }
                                IF($arr['status']=='C') 
                                {
                                    echo'<i class="	fa fa-calendar-o fa-2x"  style="width=10px;"></i> CONS Completed ';
                                    echo'</a>';
                                }
                                IF($arr['status']=='S') 
                                {
                                    echo'<a href="#myModal_receive_comment" data-toggle="modal"
                                    data-id="'.$arr['cons_id'].'" class="btn btn-skyblue ">';
                                }
                                IF($arr['status']=='S') 
                                {
                                    echo'<i class="	fa fa-calendar-check-o fa-2x"  style="width=10px;"></i>  CONS Assigned';
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
            <!-- </div> -->
            <script type="text/javascript" src="assets/js/jquery.js"> </script>
            <script type="text/javascript" src="assets/js/jquery.min.js"> </script>
            <script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
            <script type="text/javascript" src="assets/lib/moment/min/moment.min.js"> </script>
            <!--TABLE  -->
            <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
            <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
            <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
            <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js"></script>
            <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>

            <script type="text/javascript">
            $(document).ready(function() {
                $('#vfdataTable').dataTable({
                    "processing": true,
                    "pageLength": 10,
                    "ordering": true,
                    "oLanguage": {
                        "oPaginate": {
                            "sFirst": "หน้าแรก",
                            "sLast": "หน้าสุดท้าย",
                            "sNext": "ถัดไป",
                            "sPrevious": "ก่อนหน้า"
                        },
                        "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                        "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                        "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                        "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                        "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                        "sSearch": "ค้นหา :"
                    }
                });
            });
            </script>

            <script type="text/javascript">
            $(document).ready(function() {
                $('#myModal_receive_consult').on('show.bs.modal', function(e) {
                    var hy_cons = $(e.relatedTarget).data('id');
                    $.ajax({
                        type: 'post',
                        url: 'sys_hycall_center_consult_monitor.php', //Here you will fetch records
                        data: {
                            'hy_cons': hy_cons
                        }, //Pass $id
                        success: function(data) {
                            $('.fetched-data_rc').html(data);
                            //แสดงรายการข้อมูจาก database
                        }
                    });
                });
            });
            </script>

            <div class="modal fade" id="myModal_receive_consult">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times; </button>
                            <h5 class="modal-title">
                                <i class="fa fa-user">
                                </i> : มอบหมายงาน Consult
                            </h5>
                        </div>
                        <div class="modal-body text-default">
                            <div class="fetched-data_rc">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม</button>
                        </div>
                    </div>
                </div>
            </div>
</body>

<?php
function notify_message($message,$token){
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array( 
            'http'=>array(
               'method'=>'POST',
               'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                         ."Authorization: Bearer ".$token."\r\n"
                         ."Content-Length: ".strlen($queryData)."\r\n",
               'content' => $queryData
            ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API,FALSE,$context);
    $res = json_decode($result);
}
?>

</html>