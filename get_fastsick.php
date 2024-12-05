?php
include('db/connect.php');
$sql = "SELECT * FROM fast_sick WHERE hyass={$_GET['patients_id']}";
$query = mysqli_query($conn, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {
    array_push($json, $result);
}
echo json_encode($json);