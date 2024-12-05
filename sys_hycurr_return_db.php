<?php
require_once("db/connection.php");
require_once('main_script.php');
?>
<script src="assets/Alert/js/jquery.js" type="text/javascript"></script>
<script src="assets/Alert/js/jquery.ui.draggable.js" type="text/javascript"></script>
<script src="assets/Alert/js/jquery.alerts.js" type="text/javascript"></script>
<link href="assets/Alert/css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<?php
if(@$_POST['ADD'])
{
// คีย์ Master 
$ddate = $_POST['ddate'];
$hn = $_POST['hn'];
$idplacefrom = $_POST['idplacefrom'];
$hn=$_POST['hn'];
$na=$_POST['nname'];
$idfast=$_POST['idfast'];
$v1=$_POST['s1'];
$vd1 = $_POST['s2'];
$bidhass = $_POST['bidhass'];
$sidhass = $_POST['sidhass'];
$idsend=$_POST['idsend'];

$query = "INSERT INTO hycent 
 (hdate, hn, patients, depart, hass, hassn, rfto, rfquick, x2, hyquick_a, hyquick_b)
   VALUES ('$ddate','$hn','$na','$pl','$bidhass',
    '$sidhass',
    '$idplaceother',
    '$idfast',
    '$place_type','$v1','$vd1')";
$result = mysqli_query($conn,$query);
// or die ("Error in query: $query " . mysqli_error());

  if($result==true)
  {
   $error ="ไม่พบคนไข้ที่ค้นหา ในการใช้บริการ ในวันนี้ !!" ;
   echo '<meta http-equiv="refresh";url=sys_hycall_center_now.php" />';
  }
  else{
    // 
  }  
}
else{
  echo '<script type="text/javascript">
  swal("", "xxxxxxxxxxxxxxxxxxx" , "success"); 
</script>'; 
echo '<meta http-equiv="refresh" content="1;url=sys_hycall_center_now.php" />';
  }
// }

echo '<script type="text/javascript">
  swal("", "xxxxxxxxxxxxxxxxxxx" , "success"); 
</script>'; 
echo '<meta http-equiv="refresh" content="1;url=sys_hycall_center_now.php" />';