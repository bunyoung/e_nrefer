<?php
include('./db/connection.php');
if(isset($_POST["id"]))
{
    $output = '';
    $query = "SELECT * FROM rf_toolstip WHERE tool_hn='".$_POST["id"]."'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        $output = '
        <p style="width;100%;padding:10px;font-family:K2D;font-size:18px;">
              <label>ไม่มีรายการ Warning</label>
        </p>';
        echo $output;
        die();
    }
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result))
        {
        $output = '
        <table style="width;100%;padding:10px;font-family:K2D;font-size:18px;color:#28282d;background-color:##74857f;">
            <tr>
                <td>รหัสที่ : '.$row['tool_id'].'</td>
            </tr>
            <tr>
                <td>วันที่ : '.$row['tool_date'].'</td>
            </tr>
            <tr>
                <td>Notice :'.$row['tool_msg'].'</td>
            </tr>
        </table>
        ';
        }
    }else{
        $output = '
        <p><label>ไม่มีรายการ Warning</label></p>';
    }
    echo $output;
}
?>
<!-- //   <p><img src="images/'.$row['image'].'" class="img-responsive img-thumbnail" /></p> -->

<!-- <p style="font-family:K2D;font-size:18px;" ><label>รหัสที่ : '.$row['tool_id'].'</label></p>
        <p style="font-family:K2D;font-size:18px;" ><label>วันที่ : '.$row['tool_date'].'</p>
        <p style="font-family:K2D;font-size:18px;" ><label>Notice :'.$row['tool_msg'].'</p> -->
