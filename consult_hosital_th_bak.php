<?php
session_start();
error_reporting(0);// With this no error reporting will be there
require 'db/connection.php';
$hospth=$_GET['term'];
$kt=explode(" ",$hospth);
while(list($key,$val)=each($kt))
{
    if($val<>" " and strlen($val) > 0)
    {
        $q .= " hostype not in ('1','10','16','2','3','4','8','9')  AND 
                                                  hosname LIKE '%$val%' OR ";
    }
}
$q=substr($q,0,(strlen($q)-3)); //
$q1="SELECT 
          * 
          FROM rf_hospital 
          WHERE hostype not in ('1','10','16','2','3','4','8','9') AND   $q";
            $row=$dbo->prepare($q1);
            $row->execute();
            $result=$row->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result); // Output JSON formatted data
  ?>