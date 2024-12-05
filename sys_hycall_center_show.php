<?php
require_once("db/connection.php");
require_once("db/date_format.php");
?>
 <?php     
	$requestData= $_REQUEST;
	$columns = array( 
		0 => 'hn',
		1 => 'patients',
		2 => 'depart', 
		3 => 'hass',
		4 => 'hassn',
		5 => 'htime', 
		6 => 'rfto',
		7 => 'rfquick',
		8 => 'pers',
		9 => 'perdate',
	   10 => 'x1_pertime'
	);
$sql = "SELECT 
*
FROM hycent";
$query=mysqli_query($conn, $sql) or die("sys_hycall_center_view.php: get autoid");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  
$sql = "SELECT 
* ";
$sql .= "FROM hycent WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND (hn  LIKE '%".$requestData['search']['value']."%'    
	OR patients LIKE trim('%".$requestData['search']['value']."%')
	OR depart  LIKE '%".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) ;
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql);

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$nestedData[] = $row["hn"];
	$nestedData[] = $row["patients"];
	$nestedData[] = $row["depart"];
	$nestedData[] = $row["hass"];
	$nestedData[] = $row["hassn"];
	$nestedData[] = $row["htime"];
	$nestedData[] = $row["rfto"];
	$nestedData[] = $row["rfquick"];
	$nestedData[] = $row["pers"];
	$nestedData[] = $row["perdate"];
	$nestedData[] = $row["x1_pertime"];
	$data[] = $nestedData;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data   
			);
echo json_encode($json_data);  
?>
