<?php
header('Content-Type: application/json');
require_once("db/connection.php");
$sqlQuery = "SELECT name,total
                    FROM v_mychart group by hdate";

$result = mysqli_query($conn,$sqlQuery);
$get_data = $mysqli->query("SELECT name,total FROM v_mychart group by hdate");
while($data = $get_data->fetch_assoc()){
    $result[] = $data;
}
echo $json = json_encode( $result, JSON_NUMERIC_CHECK);
?>
