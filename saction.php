<?php 
require_once("db/connection.php");
$dept = mysql_real_escape_string($_POST['dept']);
if($dept !='')
{
  $vpl="SELECT * FROM e_smdepart WHERE e_mdept='$dept' ";
  $result=mysqli_query($conn,$vpl);
  while($row=mysqli_fetch_array($result))
  { 
    ?>
    <option value="<?php echo $row["s_edepart"];?>">
      <?php echo $row["s_edepart"].' - '.$row["s_ename"];?>
    </option>     
  <?php  
  }  
}
?>