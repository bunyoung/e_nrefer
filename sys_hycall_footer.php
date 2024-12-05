<style>
.footer {
    font-family: sarabun;
    /* font-weight: bolder; */
    /* font-style: unset; */
    display: block;
    /* padding: 40px 10px 10px 10px; */
    /* text-transform: capitalize; */
    line-height: 2.5;
    word-spacing: 3px;
}
</style>

<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 if($did<>''){
    $_SESSION['ih'] = 'หัวหน้าแผนกยืนยัน';
 }else{
    $_SESSION['ih'] = 'แสดงคนไข้ Refer';
 }
 $hcode=$_SESSION['hcode'];
?>

<?php include('./db/connection.php');?>
<?php
$sql="SELECT * FROM rf_users WHERE hcode='$hcode' ";
$sda=mysqli_query($conn,$sql);
$rs=mysqli_fetch_array($sda);
$hosname=$rs['hospital'];
$hostel=$rs['telephone'];
$hosadd=$rs['address'];
$hweb=$rs['headweb'];
?>
<div class="row-fluid" 
   style="line-height: 2.5;   font-style: unset;color:#ECEFF1;
    text-transform: capitalize;font-size: 18px;padding: 4px 2px 10px 2px;
    background-color:#006064;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(5, 0, 0, 0.23) 0px 6px 6px;">
   <div class="footer">
        <center>การประสานงานส่งต่อผู้ป่วย <?php echo $hweb.'  '.$hosadd;?> โทรศัพท์ <?php echo $hostel;?></center>
    </div>
</div>