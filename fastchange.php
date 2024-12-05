<?php 
// header("Content-type: text/json");
require_once("db/connection.php");
$dept = mysql_real_escape_string($_POST['dept']);
if($dept !='')
{
  $vpl="SELECT * FROM e_fast WHERE id ='$fast' ";
  $result=mysqli_query($conn,$vpl);
  while($row=mysqli_fetch_array($result))
  { 
    ?>
    <option value="<?php echo $row["id"];?>">
      <?php echo $row["id"].' - '.$row["e_fast"];?>
    </option>     
  <?php  
  }  
}
?>