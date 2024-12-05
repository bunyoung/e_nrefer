<?php
include ('core_db/connection.php');

$username = $_POST['teacherId'];
$password = $_POST['TeacherPass'];
// $password = md5($_POST['TeacherPass']);

$sql = "SELECT * FROM users WHERE username ='$username' AND password ='$password' ";
$query = mysqli_query($conn,$sql);
// $query->execute(array($username,$password));
// $row = $query->fetch();
$count = mysqli_num_rows($query);
	if ($count > 0)
	{
		session_start();
		$_SESSION['id'] = $row['user_id'];
		$_SESSION['hos'] = $row['hoscode'];
		$userid = $_SESSION['id'];
		$hos = $_SESSION['hos'];
		echo 1;
	}else{
		echo 0;
	}

// $new_password = md5($_POST['new_password']);
// $new_cpassword = md5($_POST['new_cpassword']);

// if ($new_password == $password) {
	
// 	$sql = "UPDATE faculty SET password = ? WHERE id = $userid"
// 	$query->execute(array($status,$id));
// }
// else{
// 	Console.log("ssadasds")
// }
?>