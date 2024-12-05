<?php 
include('core_db/connection.php');
session_start();
$session_id = $_SESSION['id'];
// echo $session_id; exit();
if (!isset($_SESSION['id']) || ($_SESSION['id'] == '')){ ?>
	<script>
		// window.location = '../dashboard.php';
	</script>
	<?php
}

$session_id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE user_id = $session_id ";
$query =mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($query)){
	$name = $row['username'];
}
?>