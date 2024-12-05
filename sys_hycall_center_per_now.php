<!doctype html>
<html>
<!-- <meta http-equiv="refresh" content="18000"> -->

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
        background-color: #34675C;
        color: white;
    }

    .btn-gold {
        background-color: #34675C;
        color: white;
    }

    .btn-skyblue {
        background-color: #4D648D;
        color: white;
    }

    .btn-blue {
        background-color: #0000FF;
        color: white;
    }

    .btn-orericu {
        background-color: #660066;
        color: white;
    }

    .btn-black {
        background-color: #0E0D0E;
        color: white;
    }

    .btn-noorericu {
        background-color: #f3fafa;
        color: while;
    }

    .btn-nablue {
        background-color: #1a8cff;
        color: #f3fafa;
    }

    .btn-SkyBlue1 {
        background-color: #91cfc9;
        color: black;
    }

    .btn-Mega {
        background-color: ##FF0033;
        /* color: #fff; */
    }

    .blink_me {
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    </style>
    <!-- ทำส่วนในตาราง -->
    <style>
    .r_color {
        position: relative;
        background: #008080;
    }
    </style>

</head>
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult; 
?>

<body>
    <?php
    $i='0';
    ?>
    <table id="vfdataTable" class="compact stripe table-striped table-bordered table-sm table-condensed"
        data-sort-name="Quality" style="width:100%;">
        <thead>
            <tr>
                <th align='center'><strong>ลำดับ</strong></th>
                <th align='center'><strong>เลขที่อ้างอิง</strong></th>
                <th><strong>HN</strong></th>
                <th><strong>AN</strong></th>
                <th><strong>เตียง</strong></th>
                <th><strong>ชื่อ-สกุล ผู้ป่วย </strong></th>
                <th><strong>ต้นทาง </strong></th>
                <th><strong>ปลายทาง</strong></th>
                <th><strong>วิธีเคลื่อนย้าย</strong></th>
                <th><strong>อุปกรณ์เพิ่ม</strong></th=>
                <th><strong>เพื่อ</strong></th=>
                <th><strong>ผู้ป่วยเฉพาะ</strong></th=>
                <th><strong>จนท.ดำเนินการ</strong></th>
                <th><strong>ระยะเวลารอเคลื่อนย้าย</strong></th>
                <th><strong>ร้องขอ</strong></th>
                <th><strong>ทราบ</strong></th>
                <th><strong>รับ ผป</strong></th>
                <th align='center'><strong>ยืนยัน</strong></th>
                <th align='center'><strong>ยกเลิก</strong></td>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once("db/connection.php");
                require_once("db/date_format.php");
                $sql ="SELECT *
                        FROM v_monitor WHERE x1 not in ('F','X','C') 
						-- AND
                          --  hdate=DATE_FORMAT(DATE_ADD(CURRENT_DATE, INTERVAL 543 YEAR),'%d/%m/%Y') 
                           ORDER BY x1 DESC,hyorder DESC"; 
                $result_sql = mysqli_query( $conn,$sql);
                $i=1;
                while($arr=mysqli_fetch_array($result_sql)) {
                    $htm=$arr['hyitem'];
                    $fasts=$arr['fasts_name'];                
                    $late = $arr['latetime'];
                $i++;
            ?>

            <tr class="r_color">
                <td class="c_color">
                    <center>
                        <?php    
                            $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else if(strlen($n)=='3'){echo '0';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}
                        ?>
                    </center>
                </td>

                <td>
                    <?php
                        IF($arr['typeplace']=="1") {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-orericu btn-grad DISABLED">';
                        } else
                            IF($arr['typeplace']=="2") {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-danger btn-grad DISABLED">';
                        } else
                        if($arr['typeplace']=='3') {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-Mega btn-grad DISABLED">';
                        } else
                        IF($arr['typeplace']=="0") {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-noorericu btn-grad DISABLED">';
                        }else
                        IF($arr['typeplace']=="4") {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-nablue btn-grad DISABLED">';
                        }                        
                        echo '<i></i>'.$arr['hyitem'];
                        echo'</a>'; 
                    ?>
                </td>
                <td>
                    <center>
                        <?php
                            IF(($arr['x1']=="R") OR ($arr['x1']=='E')) {
                                echo'<a class="btn btn-success btn-grad" 
                                        href="sys_hycall_center_report_002.php?id='.$arr['hyitem'].'
                                        class="btn btn-success btn-grad" data-id="'.$arr['hyitem'].'" target="_blank">';
                                echo '<i class="fa fa-print fa-2x" aria-hidden="true" 
                                        style="font-size:15px;"></i>'.' '.$arr['hn'];
                            }else{
                                echo ' '.$arr['hn'];
                            }
                            echo'</a>';        
                            ?>
                    </center>
                </td>
                <td><?php echo $arr['an']; ?></td>
                <td><?php echo $arr['bedno']; ?></td>
                <td>
                    <?php
                    // กรณีที่น้อยกว่า
                    if($arr['x1']=='W')
                    {
                        if(($late >= $arr['ftime']) && ($late <= $arr['wtime'])) 
                        {
                            echo '<a href="#" data-toggle="tooltip" 
                                title="ระยะเวลาตอนนี้  '.$late.' นาที เกินจากที่ได้กำหนด '.$fasts.' เตรียมรับคนไข้"
                            data-id="'.$arr['hyitem'].'" class="btn btn-orange btn-grad">';
                        }else {
                            if($late >= $arr['wtime'])
                            {
                                echo '<a href="#" data-toggle="tooltip" 
                                title="ระยะเวลาตอนนี้  '.$late.' นาที เกินจากที่ได้กำหนด '.$fasts.' ถึงเวลารับคนไข้แล้ว"
                                data-id="'.$arr['hyitem'].'" class="btn btn-danger btn-grad">';
                            }
                        }
                        echo  $arr['patients']; 
                    }else{
                        echo $arr['patients']; 
                    }
                    ?>
                </td>
                <td><?php echo $arr['fplace'] ; ?></td>
                <td><?php echo $arr['tplace']; ?></td>
                <td><?php echo $arr['hassnamea']?></td>
                <td><?php echo $arr['hassname']?></td>
                <td><?php echo $arr['assname']?></td>
                <td>
                    <?php if($arr['ems']=='EMS') {
                        echo '<a class="btn btn-danger btn-grad">'.$arr['ems'];
                        echo '</a>';
                    }else{
                        echo $arr['sicka'].' '.$arr['sickb'].' '
                            .$arr['sickc'].' '.$arr['sickd'].' '
                            .$arr['sicke'].' '.$arr['sickf'].' '
                            .$arr['sickg'].' '.$arr['sickh'].' '
                            .$arr['ems'].' '.$arr['covidgp'].' '
                            .$arr['sicki'].' '.$arr['sickj'].' '
                            .$arr['sickk'].' '.$arr['sickl']; 
                    }
                    ?>
                </td>
                <td>
                    <table>
                        <!-- คนที่ 1 -->
                        <TR>
                            <Td>
                                <?php
                                    IF($arr['pers']=="")
                                    {
                                        if(($late >= $arr['ftime']) && ($late <= $arr['wtime'])) 
                                        {
                                            echo'<a href="#" data-toggle="tooltip" 
                                                    title="ระยะเวลาตอนนี้  '.$late.' นาที เกินจากที่ได้กำหนด '.$fasts.' เตรียมรับคนไข้"
                                                    data-id="'.$arr['hyitem'].'"
                                                    class="btn btn-orange btn-grad DISABLED">'; 
                                            echo '<i class="fa fa-bell-slash" style="color:white;weight:bold;font: size 2px;"></i></span>' ; 
                                        }else{
                                            if($late >= $arr['wtime'])
                                            {
                                                echo '<a href="#" data-toggle="tooltip" 
                                                    title="ระยะเวลาตอนนี้  '.$late.' นาที เกินจากที่ได้กำหนด '.$fasts.' ถึงเวลารับคนไข้แล้ว"
                                                    data-id="'.$arr['hyitem'].'" 
                                                    class="btn btn-danger btn-grad">';
                                                echo '<span class="blink_me"> <i class="fa fa-bell-slash" style="color:white;weight:bold;font: size 2px;"></i></span>' ; 
                                            }
                                            // else{
                                            //     echo'<a href="#" data-toggle="tooltip" 
                                            //         title="ระยะเวลาตอนนี้ '.$late.' นาที จากที่ได้กำหนด '.$fasts.' ยังอยู่ในช่วงระยะเวลาร้องขอ"
                                            //         data-id=" '.$arr['hyitem'].' "
                                            //         class="btn btn-green btn-grad DISABLED">';   
                                            //     echo '<i class="fa fa-bell-slash" style="color:white;weight:bold;font: size 2px;"></i>';
                                            // }
                                        }               
                                    }ELSE{
                                        echo'<a href="#myModal_change_person" data-toggle="modal"
                                        data-id="'.$arr['hyitem'].'"
                                        class="btn btn-success btn-grad">';
                                    }
                                    
                                    if($arr['pers']<>""){
                                        echo '<i></i>  '.$arr['name'];
                                        echo'</a>';
                                    };
                                    ?>
                            </Td>
                        </TR>

                        <!-- คนที่ 2 -->
                        <TR>
                            <TD>
                                <?php
                                IF($arr['pers2']=="" ){
                                    if(($late >= $arr['ftime']) && ($late <= $arr['wtime'])) 
                                    {
                                        echo'<a href="#" data-toggle="tooltip" 
                                        title="ระยะเวลาตอนนี้  '.$late.' นาที เกินจากที่ได้กำหนด '.$fasts.' เตรียมรับคนไข้"
                                        data-id="'.$arr['hyitem'].'"
                                        class="btn btn-orange btn-grad DISABLED">'; 
                                        echo '<i class="fa fa-bell-slash" style="color:white;weight:bold;font: size 2px;"></i></span>' ; 
                                    }
                                    else
                                    {
                                        if($late >= $arr['wtime'])
                                        {
                                            echo '<a href="#"data-toggle="tooltip" 
                                            title="ระยะเวลาตอนนี้  '.$late.' นาที เกินจากที่ได้กำหนด '.$fasts.' ถึงเวลารับคนไข้แล้ว"
                                            data-id="'.$arr['hyitem'].'" 
                                            class="btn btn-danger btn-grad">';
                                            echo '<span class="blink_me"> <i class="fa fa-bell-slash" style="color:white;weight:bold;font: size 2px;"></i></span>' ; 
                                        }
                                        // else{
                                        //     echo'<a href="#" data-toggle="tooltip" 
                                        //     title="ระยะเวลาตอนนี้ '.$late.' นาที จากที่ได้กำหนด '.$fasts.' ยังอยู่ในช่วงระยะเวลาร้องขอ"
                                        //     data-id="'.$arr['hyitem'].'"
                                        //     class="btn btn-green btn-grad DISABLED">';   
                                        //     echo '<i class="fa fa-bell-slash" style="color:white;weight:bold;font: size 2px;"></i>';
                                        // }
                                    }               
                                }ELSE{
                                    echo'<a href="#myModal_change_personemp" data-toggle="modal"
                                    data-id="'.$arr['hyitem'].'"
                                    class="btn btn-warning btn-grad">';
                                }
                                if($arr['pers2']<>"" || $arr['empname']<>'(2)'){
                                    echo '<i></i>  '.$arr['empname'];
                                    echo'</a>';
                                };
                                ?>
                            </TD>
                        </TR>
                    </table>
                </td>

                <td rowpan="2">
                    <?php
                        IF($arr['fasts_color']=="R") {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-red btn-grad DISABLED">';
                        }
                        else
                            // กรณีที่มอบหมายงานไปแล้ว
                        IF($arr['fasts_color']=="O"){
                            echo'<a href="#" data-toggle="modal"
                                data-id="'.$arr['hyitem'].'"
                                class="btn btn-orange btn-grad DISABLED">';
                        }
                        else
                        // จบภาระกิจ
                        if($arr['fasts_color']=='Y'){
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                class="btn btn-yellow btn-grad DISABLED">';
                        }else
                        // กรณีที่มีการร้องขอ
                        IF($arr['fasts_color']=='G'){
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                class="btn btn-green btn-grad DISABLED">';
                        }else{
                            IF($arr['fasts_color']== 'B') {
                                echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                class="btn btn-blue btn-grad DISABLED">';
                            }else{
                                IF($arr['fasts_color']== 'GO') {
                                    echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                    class="btn btn-orericu btn-grad DISABLED">';
                                }else{
                                    IF($arr['fasts_color']== 'D') {
                                        echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                        class="btn btn-black btn-grad DISABLED">';
                                    // }else{                              
                                        // IF($arr['fasts_color']<> 'R'){
                                        //     if($arr['fasts_color']<>'Y'){
                                        //         if($arr['fasts_color']<>'G'){
                                        //             if($arr['fasts_color']<>'B'){
                                        //                 if($arr['fasts_color']<>'GO'){
                                        //                     if($arr['fasts_color']<>'D'){                
                                        //                         $fasts='ไม่ประสงค์ขอความเร่งด่วน';                              
                                        //                         echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                        //                         class="btn btn-skyblue btn-grad DISABLED">';
                                        //                     }
                                        //                  }
                                        //             }
                                        //         }
                                        //     }
                                        // }        
                                    }
                                }    
                            }
                        }                                                
                        echo '<i></i> '.$fasts;
                        echo'</a>';
                    ?>
                </td>
                <td><?php echo $arr['htime']; ?></td>
                <td><?php echo $arr['x1_pertime'] ?></td>
                <td><?php echo $arr['perto'] ?></td>
                <td align="center">
                    <?php
                    /*
                    X1=’W’ = ระหว่างดำเนินการ  modal: myModal_receive_wait
                                                program : sys_hycall_center_wait.php
                    X1=’R’ = เปลรับเรื่อง
                    X1=’E’ = จนท 0 เปล ดำเนินการ
                    X1=’F’ = จบงานให้ Update สถานะเจ้าหน้าที่เป็น พร้อม
                    */

                    IF($arr['x1']=="W") {
                        echo'<a href="#myModal_receive_wait" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                class="btn btn-info btn-grad">';
                    }
                    else
                    // กรณีที่มอบหมายงานไปแล้ว
                    IF($arr['x1']=="R"){
                        echo'<a href="#myModal_receive_finish" data-toggle="modal"
                            data-id="'.$arr['hyitem'].'"
                            class="btn btn-warning btn-grad">';
                    }
                    else
                    // จบภาระกิจ
                    if($arr['x1']=='E')
                    {
                        echo'<a href="#myModal_receive_end" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                class="btn btn-danger btn-grad">';
                    }
                    // กรณีที่มีการร้องขอ
                    IF($arr['x1']=='W')
                    {
                        echo '<i class="fa fa-plus-square"></i>  จ่ายงาน';
                    }
                    else

                    // กรณีที่มอบหมายงานไปแล้ว
                    if($arr['x1']=='R')
                    {
                        echo '<i class="fa fa-plus-square"></i>  รับงาน';
                    }

                    // กรณีที่จบงาน
                    if($arr['x1']=='E')
                    {
                        echo '<i class="fa fa-plus-square"></i>  ปิดงาน ';
                        echo'</a>';
                    }
                    ?>
                </td>
                <td align="center">
                    <!-- รายการที่จะทำการยกเลิก -->
                    <?php
                    IF(($arr['x1']=='W' OR $arr['x1']=='R' OR $arr['x1']=='E')) 
                    {
                        echo'<a href="#myModal_receive_cancel" data-toggle="modal"
                                data-id="'.$arr['hyitem'].'" class="btn btn-danger btn-grad">';
                                echo '<i class="fa fa-trash-o" style="font-size:15px;"></i>';
                                echo'</a>';       
                    }
                    // IF(($arr['x1']=='W' OR $arr['x1']=='R' OR $arr['x1']=='E')) {
                    //     echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                    //     echo'</a>';
                    // }
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
<script src="../../assets/js/jquery-2.1.4.min.js"></script>
<script src="../../assets/js/moment.min.js"></script>

<script src="../../assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="../../assets/js/jquery-ui.custom.min.js"></script>
<script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../../assets/js/jquery.easypiechart.min.js"></script>
<script src="../../assets/js/jquery.sparkline.index.min.js"></script>
<script src="../../assets/js/jquery.flot.min.js"></script>
<script src="../../assets/js/jquery.flot.pie.min.js"></script>
<script src="../../assets/js/jquery.flot.resize.min.js"></script>

<!-- ace scripts -->
<script src="../../assets/js/ace-elements.min.js"></script>
<script src="../../assets/js/ace.min.js"></script>

<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/bootstrap-table/src/bootstrap-table.js"></script>
<script src="../../assets/bootstrap-table/src/bootstrap-table-export.js"></script>
<script src="../../assets/bootstrap-table/src/tableExport.js"></script>

<script type="text/javascript">
var h = '';
$(document).ready(function() {
    //chk_hour();
    setInterval(getnow, 1000);
});

function chk_hour() {
    datetime = new Date();
    var x = datetime.getHours();
    if (h != x) {
        //console.log('aaa');
        upload_bed_color();
        h = x;
    }
    setInterval(chk_hour, 1000 * 5);
}

function upload_bed_color() {
    $.ajax({
        url: 'upload_bed_color.php',
        //error: OnError,
        success: function(data) {
            //console.log(data);
            $('#log_table').bootstrapTable('refresh', {
                silent: true
            });
        },
        cache: false
    });
} <
script type = "text/javascript" >
    var h = '';
$(document).ready(function() {
    //chk_hour();
    setInterval(getnow, 1000);
});

function chk_hour() {
    datetime = new Date();
    var x = datetime.getHours();
    if (h != x) {
        //console.log('aaa');
        // upload_bed_color();
        h = x;
    }
    setInterval(chk_hour, 1000 * 5);
}

// function upload_bed_color() {
//     $.ajax({
//         url: 'upload_bed_color.php',
//         //error: OnError,
//         success: function(data) {
//             //console.log(data);
//             $('#log_table').bootstrapTable('refresh', {
//                 silent: true
//             });
//         },
//         cache: false
//     });
// }

function getnow() {
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var hh = d.getHours();
    var mm = d.getMinutes();
    var ss = d.getSeconds();

    var datenow = +(day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + d.getFullYear();
    var timenow = +(hh < 10 ? '0' : '') + hh + ':' + (mm < 10 ? '0' : '') + mm + ':' + (ss < 10 ? '0' : '') + ss;

    var now = datenow + ' ' + timenow;
    $("#timer").html("เวลา :" + timenow);

    if (h != hh) {
        h = hh;
    }
}
</script>
<script>
$(document).ready(function() {
    setInterval('refreshPage()', 90000);
});

function refreshPage() {
    location.reload();
}
</script>

</html>