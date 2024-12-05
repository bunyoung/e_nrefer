<?php
  require("db/connection.php");
  $result = mysqli_query("select hdate,total from v_reference");
  $data="";
  $array= array();
  class User{
    public $hdate;
    public $total;
  }
  while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
    $user=new User();
    $user->hdate = $row['hdate'];
    $user->total = $row['total'];
    $array[]=$user;
  }
  $data=json_encode($array);
  // echo "{".'"user"'.":".$data."}";
  echo $data;
?>