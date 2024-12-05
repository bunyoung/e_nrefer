<?php 
require 'db/connection.php';

if(!isset($_GET['searchTerm'])){ 
    $json = [];
}else{
    $search = $_GET['searchTerm'];
    $sql="SELECT * FROM rf_hospital WHERE hosname  LIKE '%".$search."%'  LIMIT 10"; 
    // $result = $mysqli->query($sql);
    $json = [];
    // while($row = $result->fetch_assoc()){
    //     $json[] = ['id'=>$row['hoscode5'], 'text'=>$row['hosname']];
    // }
    // 
    $result = mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result)){
        $json[] = ['id'=>$row['hoscode5'], 'text'=>$row['hosname']];
}
}
echo json_encode($json);
?>