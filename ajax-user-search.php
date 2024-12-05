<?php
require_once('db/connection.php');
 
function get_city($conn , $term){ 
 $query = "SELECT * FROM user_pmk WHERE  NAME LIKE '%".$term."%' ORDER BY NAME ASC";
 $result = mysqli_query($conn, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getCity = get_city($conn, $_GET['term']);
 $cityList = array();
 foreach($getCity as $city){
 $cityList[] = $city['NAME'];
 }
 echo json_encode($cityList);
}
?>