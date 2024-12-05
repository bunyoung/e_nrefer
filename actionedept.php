<?php 
// header("Content-type: text/json");
require_once("db/connection.php");
$dept = mysql_real_escape_string($_POST['sdept']);
if($dept !='')
{
  $vpl="SELECT * FROM e_smdepart WHERE e_mdept='$dept' ";
  $result=mysqli_query($conn,$vpl);
  while($rsw=mysqli_fetch_array($result))
  { 
    ?>
    <option value="<?php echo $rsw["s_edepart"];?>">
      <?php echo $rsw["s_edepart"].' - '.$rsw["s_ename"];?>
    </option>     
  <?php  
  }  
}
// mysqli_close($conn);
?>