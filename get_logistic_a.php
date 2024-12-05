<?php
header("Content-type: text/json");
include 'db/connection.php';

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;

// $sql="SELECT * FROM v_asmonitor_a";
$sql="SELECT
a.dgroup AS dgroup, 
a.hyitem AS hyitem, 
a.assetcode AS assetcode, 
sa.assname, 
sa.asscolor, 
a.hdate AS hdate, 
a.fromplace AS fromplace, 
a.toplace AS toplace, 
a.htime AS htime, 
a.pers AS pers, 
a.perstatus AS perstatus, 
a.perdate AS perdate, 
a.x1_pertime AS x1_pertime, 
a.perto AS perto, 
a.perfinish AS perfinish, 
a.x1 AS x1, 
a.x2 AS x2, 
a.x3 AS x3, 
e.`name` AS `name`, 
e.username AS username, 
ADDTIME(
    `a`.`x1_pertime`,
    - (
    CAST( `a`.`htime` AS time ))) AS metime, 
ADDTIME(
    `a`.`perfinish`,
    - (
    CAST( `a`.`htime` AS time ))) AS usetimeAll, 
e.linenotify, 
a.peramt, 
sys_unit.unit, 
a.assetdet, 
pmk_places.pmkfullplace AS nfrompmkplace, 
a.hn, 
a.pcr, 
a.lprc, 
a.ffp, 
a.crp, 
a.plasma, 
a.pca, 
a.pcb, 
a.cryo, 
a.other, 
pmk_his.pname, 
pmk_his.idcard, 
pmk_his.age, 
p1.fullplace AS nfromplace, 
p2.fullplace AS ntplace, 
p3.fullplace AS fplace, 
pmk_places.pmkfullplace, 
a.pmkplace, 
sys_clean_argent.clean_argent, 
a.idpcr, 
a.idlprc, 
a.idffp, 
a.idcrp, 
a.idplasma, 
a.idpca, 
a.idpcb, 
a.idcryo, 
a.ldrc, 
a.idldrc, 
a.firstplace, 
a.typeb, 
a.typea, 
a.perrend
FROM
(
    (
        (
            asssent AS a
            LEFT JOIN
            employee AS e
            ON 
                (
                    (
                        e.idcard = a.pers
                    )
                )
        )
    )
)
LEFT JOIN
sys_asset AS sa
ON 
    sa.assetid = a.assetcode
LEFT JOIN
sys_unit
ON 
    a.unit = sys_unit.id
LEFT JOIN
pmk_places
ON 
    a.pmkplace = pmk_places.pmkcode
LEFT JOIN
pmk_his
ON 
    a.hn = pmk_his.hn
LEFT JOIN
places AS p1
ON 
    a.fromplace = p1.placecode
LEFT JOIN
places AS p2
ON 
    a.toplace = p2.placecode
LEFT JOIN
places AS p3
ON 
    a.firstplace = p3.placecode
LEFT JOIN
sys_clean_argent
ON 
    a.drug_argent = sys_clean_argent.id
WHERE
dgroup = 'A'
ORDER BY
hyitem DESC ";
$query=mysqli_query($conn,$sql);

$data = array(); 
while($rs=mysqli_fetch_array($query)) {
    $a['dgroup']     = $rs['dgroup'].'-'.$rs['hyitem'];
    $a['assname']    = $rs['assname'];
    $a['hn']         = $rs['hn'];
    $a['fname']      = $rs['pname'];
    $a['firstplace'] = $rs['fplace'];
    $a['pmkplace']   = $rs['pmkfullplace'];
    $a['fplace']     = $rs['nfromplace'];
    $a['tplace']     = $rs['ntplace'];
    $a['hdate']      = $rs['hdate'];
    $a['htime']      = $rs['htime'];
    $a['x1_pertime'] = $rs['x1_pertime'];
    $a['perto']      = $rs['perto'];
    $a['perfinish']  = $rs['perfinish'];
    $a['name']       = $rs['name'];
    $a['usetimeAll'] = $rs['usetimeAll'];
    $a['endjoba']    = $rs['typea'];
    $a['endjobb']    = $rs['typeb'];
    $a['endfinish']  = $rs['perrend'];
    if($rs['x1'] =='F'){
        $a['status'] = 'จบงาน';
    }else{
        if($rs['x1']=='C'){
            $a['status']    = 'ยกเลิก';
        }else{
            if($rs['x1']=='W'){
                $a['status']    = 'รอดำเนินการ';
            }
        }
    }
     
    array_push($data,$a);
}

print json_encode($data); 
?>