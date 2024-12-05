<?php
if(!isset($_SESSION)) {  session_start();  
}
if($_SESSION['ih']  <> null){
    $hih = $_SESSION['ih'];
}else{
    $hih='รอเข้าสู่ระบบการทำงาน';
}
?>
<script>
var elem = document.documentElement;
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}

function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
}
</script>
<div class="row">
    <div class="container-fluid" >
        <div style="font-family:sarabun;font-size:18px;background-color:#004D40;color:#FAFAFA; margin:4px 0px; 
              box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
              padding: 3px;">
            <label for="" style="margin: 2px;">&nbsp;
                <a href="javascript:void(0);" onClick="window.open('sys_hycall_monitor_now_full.php', '',
                            'fullscreen=yes, scrollbars=auto');">
                                <i class="fa fa-th-large" aria-hidden="true"></i>
                </a>
                ส่วนระบบงาน :: <?php echo $hih; ?> ::
            </label>
        </div>
    </div>
  </div>
