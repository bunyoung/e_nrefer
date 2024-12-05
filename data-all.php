<?php session_start();
	date_default_timezone_set('Asia/Bangkok');
//include '../../function/conv_date.php';
include 'db/connection.php';


if($_REQUEST['ward']=='all'){
    $sql = "
        select DISTINCT d.idx,d.cid,d.date_in,d.passport,d.user_mo,
        d.date_drop,d.hn,d.pname,d.fname,d.lname,d.user_created,d.lab_result,
        d.mobile,d.other,d.site_id,d.date_created,d.age,d.age_month,m.running,d.last_opd

        from drop_in_swab d 
        left join drop_in_main m on (m.cid=d.cid and date_format(d.date_drop,'%Y-%m-%d')=date_format(m.date_drop,'%Y-%m-%d'))
        where  d.del_flag != 'Y'  
        order by d.date_created desc   
        ";
}else{
    $sql = "
        select DISTINCT d.idx,d.cid,d.date_in,d.passport,d.user_mo,
        d.date_drop,d.hn,d.pname,d.fname,d.lname,d.user_created,d.lab_result,
        d.mobile,d.other,d.site_id,d.date_created,d.age,d.age_month,m.running,d.last_opd

        from drop_in_swab d 
        left join drop_in_main m on (m.cid=d.cid and date_format(d.date_drop,'%Y-%m-%d')=date_format(m.date_drop,'%Y-%m-%d'))
        where  d.del_flag != 'Y'  and d.ward_code='".$_REQUEST['ward']."'
        order by d.date_created desc   
        ";
}

    
		  

        $query = mysql_query($sql);
        $data = array();
$i=1;
        while($rs = mysql_fetch_array($query)) {
                //echo $rs[0]."<br>";
                $a['idx']               = $rs['idx'];
                $a['date_created']      = date("d-m-Y H:i", strtotime($rs['date_created']));
                $a['cid']               = $rs['cid'];
                $a['flname']            = $rs['pname'].''.$rs['fname'].' '.$rs['lname']; 
                $a['pname']             = $rs['pname'];
                $a['fname']             = $rs['fname'];
                $a['lname']             = $rs['lname'];
                $a['age']               = $rs['age']; 
                $a['mobile']            = $rs['mobile']; 
                $a['other']             = $rs['other']; 
                $a['site']              = $rs['site_name'];
                $a['date_lab']          = date("d-m-Y", strtotime($rs['date_in']));
                $a['date_drop']         = date("d-m-Y", strtotime($rs['date_drop']));
                $a['passport']          = $rs['passport'];
                $a['last_opd']          = $rs['last_opd'];
                $a['hn']                = $rs['hn'];
                $a['lab_result']        = $rs['lab_result'];
                $a['del']               = '<i class="fa fa-close fa-2x text-danger" aria-hidden="true"></i>';
                $a['print']             = '<i class="fa fa-print fa-2x text-success" aria-hidden="true"></i>';
                $a['user_created']      = $rs['user_created'];
                $a['user_mo']           = $rs['user_mo'];
                if($rs['last_opd']=='1920'){
                  //$a['appr']               = '<i class="fa fa-check fa-2x text-success" aria-hidden="true"></i>';  
                  $a['appr']               = 'Y'; 
                }else{
                    $a['appr']             = '';
                }


            array_push($data,$a);
        }
        print json_encode($data);


mysql_close();    


function date_to_thai($ddate){ //2016-18-11 to 18-11-2559 
	$d = substr($ddate,8,2); 
	$m = substr($ddate,5,2);
	$y = substr($ddate,0,4)+543; 
	if($ddate=='0000-00-00' or $ddate==''){
		echo '-';
	}else{
		return $d.'-'.$m.'-'.$y;
	}
}
?>

