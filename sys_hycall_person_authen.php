<?php

require_once("db/connection.php");
$user = mysql_real_escape_string(@$_POST['username']);
$pass = mysql_real_escape_string(@$_POST['password']);
$sql = "SELECT 
    *
FROM employee
    WHERE username='$user' AND passw='$pass' "; // Download data

$resultd = mysqli_query($conn, $sql);
$rsd = mysqli_fetch_array($resultd, MYSQL_ASSOC);
if (!empty($rsd['username'])) {
    $loginname = $rsd['username'];
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['showname'] = $rsd['name'];
    $_SESSION['showv'] = $rsd['idcard'];

    $_SESSION['name'] = $rsd['username'];
    $_SESSION['autoid'] = $rsd['passw'];
    $_SESSION['idcard'] = $rsd['idcard'];
    $sautoid = $_SESSION['name'];
    $idcard = $_SESSION['idcard'];

    echo "<meta http-equiv=\"refresh\" content=\"0;URL=sys_hycall_center_person.php\">";
    } else {
    $status = "Fail";
    $message = "Login Fail<br>Please try Again";
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=./error.php?message=$message\">";
}
mysqli_close($conn);
?>