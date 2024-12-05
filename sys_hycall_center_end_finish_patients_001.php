<?php
require_once('db/date_format.php');
require_once('db/connect_pmk.php');
require_once("db/connection.php");
require_once('function/conv_date.php');
include('main_script.php');
?>
<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>

<!-- ใช้เรียกเวลาจาก server -->
<script language="JavaScript1.2">
function server_date(now_time) {
    current_time1 = new Date(now_time);
    current_time2 = current_time1.getTime() + 1000;
    current_time = new Date(current_time2);
    server_time.innerHTML = current_time.getDate() + "/" + (current_time.getMonth() + 1) + "/" + current_time
        .getYear() + " " + current_time.getHours() + ":" + current_time.getMinutes() + ":" + current_time
        .getSeconds();
    setTimeout("server_date(current_time.getTime())", 1000);
}
setTimeout("server_date('<?=$current_server_time?>')", 1000);
</script>

<?php
$current_server_time = date("H:i:s");
?>

<?php
#SQL
$hyitem=$_POST['hyid'];
$sql = "SELECT * FROM v_monitor WHERE hyitem='$hyitem'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

// รายการปรับปรุง
$hn=$rsd['hn'];                  // hn คนไข้
$na=$rsd['patients'];            // ชื่อ สกุล
$htime=$rsd['htime'];            // เวลาเริ่ม
$fpplace=$rsd['toplace'];          // หน่วยร้องขอ
$tpplace=$rsd['fromplace'];          // หน่วยร้องขอ

$fnplace=$rsd['fplace'];          // หน่วยร้องขอ
$tnplace=$rsd['tplace'];          // หน่วยร้องขอ
$hdate = $d_default;
$fast_sick = $rsd['fast_sick'];
$fast_name = $rsd['fasts_name'];
$hassa=$rsd['hassa'];
$hassnamea=$rsd['hassnamea'];
$hassb=$rsd['hassb'];
$hassnameb=$rsd['hassnameb'];
$sick_a = $rsd['sicka'];
$sick_b = $rsd['sickb'];
$hyass = $rsd['hyass'];
$hyname = $rsd['assname'];
?>

<form class="form-horizontal" action="sys_hycall_db_return.php" method="POST" target="">
  <div class="panel-group">
    <div class="panel panel-info">
      <div class="panel-heading"><strong><i class="fa fa-calendar fa-lg" aria-hidden="true"></i> ประจำวันที่
        <?php echo $d_default; ?>:
          <?php echo $current_server_time?></div>
            <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
            </strong>
            <p>
            <div class="form-group">
            <label for="shn" class="control-label col-lg-2"> มารับผู้ป่วยที่ : </label>
             <div class="col-lg-4">
               <div class="btn btn-success btn-grad">
                 <i class="fa fa-address-card-o" aria-hidden="true"></i>
                 <?php echo $tnplace;?>
               </div>
             </div>
            </div>

            <div class="form-group">
              <label for="shn" class="control-label col-lg-2"> HN : </label>
               <div class="col-lg-2">
                 <input type="text" class="form-control" name="hn" id="hn" autocomplete="off"
                    value="<?php echo $hn; ?>"required readonly>
               </div>
               <label for="shn" class="control-label col-lg-2">ชื่อ-สกุล:</label>
               <div class="col-lg-5">
                 <input type="text" class="form-control" id="nname" autocomplete="off"
                   value="<?php echo $na; ?>" disabled>
                </div>
               </div>
               <!-- สิ้นสุดการตรวจสอบคนไข้ -->
               <?php
               $SQLhyass = mysqli_query($conn,"SELECT hyass,assname
                                          FROM hyass
                                          Where asstatus <> '1'
                                          ORDER BY hyindex") OR die(mysqli_error());
               $SQLfast = mysqli_query($conn,"SELECT *
                                          FROM fast_sick_a
                                          Where fasts_status <> '1'
                                          ORDER BY fasts_name") OR die(mysqli_error());
               $SQLid = mysqli_query($conn,"SELECT hassid,hassname
                                 FROM hass Where hasstatus<>'1'
                                 ORDER BY hassname") OR die(mysqli_error());
               $SQLpl = mysqli_query($conn,"SELECT placecode,fullplace
                                        FROM places ORDER BY fullplace") OR die(mysqli_error());
               $SQLpla = mysqli_query($conn,"SELECT placecode,fullplace
                                         FROM places ORDER BY fullplace") OR die(mysqli_error());
               $SQLida = mysqli_query($conn,"SELECT hassid,hassname
                                         FROM hass Where hasstatus<>'1'
                                         ORDER BY hassname") OR die(mysqli_error());
               ?>
               <hr>
               <div class="form-group">
                 <label for="sidhass" class="col-lg-2 col-form-label" align="right">ผู้ป่วย :</label>
                  <div class="col-lg-4">
                    <input class="form-check-input" type="checkbox" name="sa" value="CRE"
                     <?php if($sick_a=='CRE'){echo 'checked';}?>>
                     <label class="form-check-label" for="flexCheckDefault">CRE </label>

                    <input class="form-check-input" type="checkbox" name="sb" value="PUI/COVID-19"
                       <?php if($sick_b=='PUI/COVID-19'){echo 'checked';}?>>
                       <label class="form-check-label" for="flexCheckDefault">PUI/COVID-19 </label>
                  </div>
               </div>

               <div class="form-group">
                 <label for="idhyass" class="col-lg-2 col-form-label" align="right">ประเภท ผู้ป่วย : </label>
                 <div class="col-lg-5">
                   <select  class="form-control"name="hyass" id="sel_hyass">
                     <option value=""><?php echo $hyname; ?></option>
                     <?php
                        while($row1=mysqli_fetch_array($SQLhyass))
                        {
                        ?>
                        <option value="<?php echo $row1['hyass'];?>">
                            <?php echo $row1['hyass'].' '.$row1['assname'];?>
                        </option>
                        <?php
                        }
                     ?>
                   </select>
                 </div>
                </div>

                <!-- ด่วน วิกฤติ -->
                <div class="clear"></div>
                <div class="form-group">
                  <label for="betype" class="col-lg-2 col-form-label" align="right">
                  <a class="text text-danger"><strong>ด่วน</strong></a> วิกฤติ :</label>
                  <div class="col-lg-5">
                   <select class="form-control" name="fast" id="sel_fast">
                     <option value=""><?php echo $fast_sick.' '.$fast_name; ?></option>
                   </select>
                  </div>
                </div>

                <!-- อุปกรณ์ -->
                <div class="form-group">
                  <label for="aidhass" class="col-lg-2 col-form-label"
                    align="right">อุปกรณ์ :</label>
                  <div class="col-lg-5">
                    <select class="form-control" name="hassa">
                    <option value=""><?php echo $hassnamea; ?></option>
                    <?php
                     while($row2=mysqli_fetch_array($SQLid))
                     {
                     ?>
                     <option value="<?php echo $row2['hassid'];?>">
                        <?php echo $row2['hassid'].' '.$row2['hassname'];?>
                     </option>
                     <?php
                     }
                     ?>
                     </select>
                  </div>
                </div>

                <!-- อุปกรณ์เพิ่มเติม -->
                <div class="form-group">
                  <label for="bidhass" class="col-lg-2 col-form-label"
                    align="right">อุปกรณ์เพิ่มเติม :</label>
                  <div class="col-lg-5">
                    <select class="form-control" name="hassb">
                    <option value=""><?php echo $hassnameb; ?></option>
                    <?php
                     while($row2=mysqli_fetch_array($SQLida))
                     {
                     ?>
                     <option value="<?php echo $row2['hassid'];?>">
                        <?php echo $row2['hassid'].' '.$row2['hassname'];?>
                     </option>
                     <?php
                     }
                     ?>
                     </select>
                  </div>
                </div>

                <!-- ไปรับที่ -->
                <div class="form-group">
                  <label for="idsend" class="col-lg-2 col-form-label" align="right">สถานที่่ส่ง : </label>
                   <div class="col-lg-5">
                     <select class="form-control input-sm select2" name="tpplace">
                       <option value=""><?php echo $fnplace; ?></option>
                       <?php
                       while($row1=mysqli_fetch_array($SQLpla))
                       {
                       ?>
                       <option value="<?php echo $row1['placecode'];?>">
                         <?php echo $row1['fullplace'];?>
                       </option>
                       <?php
                       }
                       ?>
                     </select>
                   </div>
                </div>
                <div class="form-group">
                   <input type="hidden" name="hn" value="<?php echo $hn; ?>" />
                   <input type="hidden" name="nname" value="<?php echo $na; ?>"/>
                   <input type="hidden" name="fplace" value="<?php echo $tpplace; ?>"/>
                   <input type="hidden" name="hyass" value="<?php echo $hyass; ?>"/>
                   <input type="hidden" name="hassa" value="<?php echo $hassa; ?>"/>
                   <input type="hidden" name="hassb" value="<?php echo $hassb; ?>"/>
                   <input type="hidden" name="tplace" value="<?php echo $fpplace; ?>"/>

                   <label for="idsend" class="col-lg-2 col-form-label" align="right"></label>
                   <input type="hidden" name="ADD" value="ADD">
                   <div class="col-lg-2">
                        <button type="submit" class="btn btn-danger btn-grad"><i class="fa fa-bell"></i>
                            ส่งกลับ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
     $("#sel_hyass").change(function(){
        var fssid = $(this).val();
           $.ajax({
           url: 'get_return_data.php',
          type: 'post',
          data: {fs:fssid},
      dataType: 'json',
       success:function(response){
           var len = response.length;
              $("#sel_fast").empty();
                 for( var i = 0; i<len; i++){
                    var fasts_id = response[i]['fasts_id'];
                    var fasts_name = response[i]['fasts_name'];
                    $("#sel_fast").append("<option value='"+fasts_id+"'>"+fasts_name+"</option>");
                 }
              }
           });
       });
  });
</script>

<script src="assets/plugins/select2/select2.full.min.js"></script>
    <script>
    $(function() {
        $(".select2").select2();
    });
</script>
