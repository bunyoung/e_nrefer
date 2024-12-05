<?php
include('db/connection.php');
include('db/conv_date.php');

$sql="SELECT * FROM e_cons_detail order by an";
$query=mysqli_query($conn,$sql);

$data = array(); 
while($rs=mysqli_fetch_array($query)) {
    $a['cons_id'] = $rs['cons_id'];
    $a['hn']	  = $rs['hn'];
    $a['n_flname']= $rs['pname'];
    array_push($data,$a);
}
    
print json_encode($data); 
?>