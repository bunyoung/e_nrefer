<?php
	session_start();
	include("db/connection.php");
	// $referdate=explode("-",$_GET['referout_date']);
	// $referdate=$referdate[0].'-'.$referdate[1].'-'.($referdate[2]-543);
	//if(!isset($_GET['clinic']) || $_GET['clinic']==''){
		$sql="SELECT * FROM v_rf_detail";
	/*}elseif($_GET['clinic']<>''){
		$sql="SELECT DISTINCT hn,cid,concat(concat(concat(pname,fname),' '),lname),referout_no,vn,ClinicGroup_name
			from referout_reply 
			LEFT JOIN clinicgroup ON referout_reply.clinicgroup=clinicgroup.ClinicGroup_id
			where date_format(referout_date,'%d-%m-%Y')='".trim($referdate)."' and clinicgroup='".$_GET['clinic']."' AND hcode='".$_SESSION['hospcode']."' AND Send_spclty_id<>'2' ORDER BY fname";
	}*/

	$data=array();
	$query=mysqli_query($conn,$sql);
	while($rs=mysqli_fetch_array($query)){
		$a['rf_hn']=$rs[0];
		$a['rf_hn']=$rs[0];
		$a['rf_hn']=$rs[0];
		$a['rf_hn']=$rs[0];
		$a['rf_hn']=$rs[0];
		$a['rf_hn']=$rs[0];
		$a['rf_hn']=$rs[0];
		$a['rf_hn']=$rs[0];
		$a['rf_hn']=$rs[0];
		array_push($data,$a);
	}
	echo  json_encode($data);
	mysqli_close();
	
?>