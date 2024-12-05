<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> e-Refer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>
<?php   
	include("./db/connection.php"); 	
	// require_once('main_script.php');
	$user = @$_POST['uname'];
	$pass = @$_POST['psw'];
	$sql = "SELECT *
		FROM doc_dbfs
		WHERE doc_code ='$user' AND checkword ='$pass' and doc_status='0' ";	// Download data
	$resultd = mysqli_query($conn,$sql); 
    $rsd=mysqli_fetch_array($resultd);  
	if (!empty($rsd['doc_code'])) {
		$status = "Success";
		$idcard = $rsd['doc_code'];
		$name = $rsd['prename'].''.$rsd['name'].'  '.$rsd['surname'];

		if(!isset($_SESSION)) {  
            session_start();  
        }
        $_SESSION['sess_log_time']=$thistime;
		$_SESSION['username']  = $rsd['doc_code'];
		$name = $rsd['prename'].''.$rsd['name'].'  '.$rsd['surname'];
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=main_top_static.php\">";
	}else {
		echo '
        <script>
            setTimeout(function() {
                swal({
                    title: "การเข้าสู่ระบบ",
                    text: "ไม่สามารถเข้าสู่ระบบ Dashboard ได้  !!",
                    type: "error"
                }, function() {
                    window.location = "logout.php";
                })
            },500);
        </script> ';
	}
	mysqli_close($conn);
?>