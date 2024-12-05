<?php
  if (isset($_POST['function']) && $_POST['function'] == 'hyass') {
  	$id = $_POST['id'];
  	$sql = "SELECT * FROM fast_sick_a WHERE hyass='$id'";
  	$query = mysqli_query($conn, $sql);
  	?>
<option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
<?php
         while($row1=mysqli_fetch_array($query))
                        {
                        ?>
<option value="<?php echo $row1['fasts_id'];?>">
    <?php echo '['.$row1['fasts_id'].']'.' '.$row1['fasts_name'];?>
</option>
<?php
}
}
?>