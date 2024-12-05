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
<div class="row">
<div class="fluid">
<form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target="" name="formq" id="formq">
   <div class="col-lg-4">
     <div class="panel-group">
       <div class="panel panel-info">
         <div class="panel-heading"><strong><i class="fa fa-search-plus fa-lg" aria-hidden="true"></i> ค้นหา ผู้ป่วย</strong>          </div>
           <p>
             <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
              <div class="form-group">
                <label for="shn" class="control-label col-lg-1"></label>
                 <div class="col-lg-8">
                     <input type="text" id="shn" name="shn" placeholder="HN หรือ เลขบัตรประขาขน" class="form-control round-input"
                         value="<?php echo $hn; ?>">
                 </div>
                 <div class="col-lg-2">
                    <input type="submit" class="btn btn-success btn-grad" id="Search" value="ค้นหา"
                            onclick="JavaScript:fncSubmit('pmk')" />
                 </div>
              </div>


              <?php
              if ($_REQUEST['type'] == 'pmk') {
                $strSQL = "SELECT ID_CARD,HN,PRENAME,NAME,SURNAME,(PRENAME||NAME||' '||SURNAME) as n
                            FROM v_patients
                         WHERE HN='".$_REQUEST['shn']."' OR ID_CARD='".$_REQUEST['shn']."'  ";
                $objParse = oci_parse($objConnect, $strSQL);
                oci_execute($objParse);
                $Num_Rows = oci_fetch_all($objParse, $Result);
                if(($Num_Rows)<1){
                    echo '<script type="text/javascript">
                     swal("", "ไม่พบรายการข้อมูลใช้บริการ ในขณะนี้ !!" , "error");
                   </script>';
                  }else {
                  oci_execute($objParse,OCI_DEFAULT);
                  while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                    {
                        $prename=$objResult['PRENAME'];
                        $name=$objResult['NAME'];
                        $surname=$objResult['SURNAME'];
                        $hn=$objResult['HN'];
                        $na=$objResult['N'];
                    }
                }
                ?>
                <div class="container">
                 <div class="form-group">
                   <div class="form-group">
                     <div class="col-lg-2">
                        <label for="pc" class="control-label col-lg-1"></label>
                         <img src="ViewImage.php?hn=<?= $hn ?>" alt="SEARCH"
                                style="width:80px;height:90px;">
                   </div>
                 </div>
                </div>
              </div>
              <?php
              }
              ?>
           </div>
       </div>
   </div>

    <div class="col-lg-8">
           <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading"><strong><i class="fa fa-calendar fa-lg" aria-hidden="true"></i> ประจำวันที่
                            <?php echo $d_default; ?>:
                            <?php echo $current_server_time?></div>
                <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                </strong>
                <p>
                <div class="form-group">
                 <label for="shn" class="control-label col-lg-3"> HN : </label>
                   <div class="col-lg-2">
                       <input type="text" class="form-control" name="hn" id="hn" autocomplete="off"
                         value="<?php echo $hn; ?>" disabled >
                   </div>
                   <!-- <label for="shn" class="control-label col-lg-3">ชื่อ-สกุล
                      :</label> -->
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
                    <label for="sidhass" class="col-lg-3 col-form-label" align="right">ผู้ป่วย :</label>
                    <div class="col-lg-4">
                        <input class="form-check-input" type="checkbox" name="sa" value="CRE" />
                        <label class="form-check-label" for="flexCheckDefault">
                            CRE
                        </label>
                        <input class="form-check-input" type="checkbox" name="sb" value="PUI/COVID-19" />
                        <label class="form-check-label" for="flexCheckDefault">
                            PUI/COVID-19
                        </label>
                    </div>
                </div>

                <div class="form-group">
                 <label for="idhyass" class="col-lg-3 col-form-label"
                   align="right">ประเภท ผู้ป่วย : </label>
                 <div class="col-lg-5">
                   <select  class="form-control"
                             name="hyass" id="sel_hyass">
                     <option value="" selected disabled >(เลือกรายการที่ต้องการ)</option>
                     <?php
                        while($row1=mysqli_fetch_array($SQLhyass))
                        {
                        ?>
                        <option value="<?php echo $row1['hyass'];?>">
                            <?php echo '['.$row1['hyass'].']'.' '.$row1['assname'];?>
                        </option>
                        <?php
                        }
                     ?>
                   </select>
                 </div>
                </div>

                <!-- เพิ่มมาใหม่่ -->
                <!-- ด่วน วิกฤติ -->
                <div class="clear"></div>
                <div class="form-group">
                  <label for="betype" class="col-lg-3 col-form-label" align="right">
                  <a class="text text-danger"><strong>สถานะ</strong></a> ผู้ป่วย :</label>
                  <div class="col-lg-5">
                   <select class="form-control" name="fast" id="sel_fast">
                        <option value="0">(เลือกรายการที่ต้องการ)</option>
                   </select>
                  </div>
                </div>

                <!-- อุปกรณ์ -->
                <div class="form-group">
                  <label for="aidhass" class="col-lg-3 col-form-label"
                    align="right">อุปกรณ์ :</label>
                  <div class="col-lg-5">
                    <select class="form-control" name="aidhass">
                    <option value=""selected disabled>(เลือกรายการที่ต้องการ)</option>
                    <?php
                     while($row2=mysqli_fetch_array($SQLid))
                     {
                     ?>
                     <option value="<?php echo $row2['hassid'];?>">
                        <?php echo '['.$row2['hassid'].']'.' '.$row2['hassname'];?>
                     </option>
                     <?php
                     }
                     ?>
                     </select>
                  </div>
                </div>

                <!-- อุปกรณ์เพิ่มเติม -->
                <div class="form-group">
                  <label for="bidhass" class="col-lg-3 col-form-label"
                    align="right">อุปกรณ์เพิ่มเติม :</label>
                  <div class="col-lg-5">
                    <select class="form-control" name="bidhass">
                    <option value=""selected disabled>(เลือกรายการที่ต้องการ)</option>
                    <?php
                     while($row2=mysqli_fetch_array($SQLida))
                     {
                     ?>
                     <option value="<?php echo $row2['hassid'];?>">
                        <?php echo '['.$row2['hassid'].']'.' '.$row2['hassname'];?>
                     </option>
                     <?php
                     }
                     ?>
                     </select>
                  </div>
                </div>

                <!-- ไปรับที่ -->
                <div class="form-group">
                    <label for="idsend" class="col-lg-3 col-form-label" align="right">หน่วยร้องขอเปล : </label>
                    <div class="col-lg-5">
                      <select class="form-control select2" name="fromplace">
                      <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                      <?php
                       while($row1=mysqli_fetch_array($SQLpl))
                       {
                       ?>
                       <option value="<?php echo $row1['placecode'];?>">
                          <?php echo '['.$row1['placecode'].']'.'  '.$row1['fullplace'];?>
                       </option>
                       <?php
                       }
                       ?>
                       </select>
                    </div>
                </div>

                <!-- ไปรับที่ -->
                <div class="form-group">
                   <label for="idsend" class="col-lg-3 col-form-label" align="right">สถานที่่ส่ง (ปลายทาง) : </label>
                   <div class="col-lg-5">
                     <select class="form-control input-sm select2" name="toplace">
                       <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                       <?php
                       while($row1=mysqli_fetch_array($SQLpla))
                       {
                       ?>
                       <option value="<?php echo $row1['placecode'];?>">
                         <?php echo '['.$row1['placecode'].']'.'  '.$row1['fullplace'];?>
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

                   <label for="idsend" class="col-lg-2 col-form-label" align="right"></label>
                   <input type="hidden" name="ADD" value="ADD">
                   <div class="col-lg-2">
                        <button type="submit" class="btn btn-danger btn-grad"><i class="fa fa-bell"></i>
                            เรียกศูนย์เปล</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
</div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#sel_hyass").change(function(){
                var fssid = $(this).val();
                $.ajax({
                    url: 'get_data.php',
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
