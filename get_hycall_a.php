<?php
// Set the JSON header
header("Content-type: text/json");
include 'db/connection.php';

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;

// $sql="SELECT * FROM v_monitor";
$sql="SELECT
hycent.hyitem AS hyitem, 
hycent.hdate AS hdate, 
hycent.hn AS hn, 
hycent.patients AS patients, 
hycent.sicka AS sicka, 
hycent.sickb AS sickb, 
hycent.hyass AS hyass, 
hycent.fast_sick AS fast_sick, 
hycent.hassa AS hassa, 
hycent.hassb AS hassb, 
hycent.fromplace AS fromplace, 
hycent.toplace AS toplace, 
hycent.pers AS pers, 
hycent.perstatus AS perstatus, 
hycent.perdate AS perdate, 
hycent.x1_pertime AS x1_pertime, 
hycent.perremark AS perremark, 
hycent.x1 AS x1, 
hycent.x2 AS x2, 
hycent.x3 AS x3, 
hycent.old AS old, 
hycent.idcard AS idcard, 
hyass.assname AS assname, 
hyass.usereturn AS usereturn, 
fast_sick_a.fasts_name AS fasts_name, 
fast_sick_a.fasts_color AS fasts_color, 
fp.fullplace AS fplace, 
ft.fullplace AS tplace, 
fp.placetype AS typeplace, 
employee.`name` AS `name`, 
employee.linenotify AS linenotify, 
hs.hassname AS hassnamea, 
hb.hassname AS hassnameb, 
fp.opdipd AS opdipd, 
hs.hasstatus AS hasstatusa, 
hb.hasstatus AS hasstatusb, 
hycent.htime AS htime, 
hycent.perto AS perto, 
hycent.perfinish AS perfinish, 
ADDTIME(`hycent`.`perto`, - (CAST(`hycent`.`htime` AS time))) AS usetime, 
ADDTIME(`hycent`.`x1_pertime`, - (CAST(`hycent`.`htime` AS time))) AS metime, 
ADDTIME(`hycent`.`perfinish`, - (CAST(`hycent`.`htime` AS time))) AS usetimeAll, 
SUBSTR(hycent.hdate,1,2) AS p4_day, 
SUBSTR(hycent.hdate,4,2) AS p4_month, 
SUBSTR(hycent.hdate,7,4) AS p4_year, 
hycent.sickc, 
hycent.sickd
FROM
(
    (
        (
            (
                (
                    (
                        (
                            hycent
                            LEFT JOIN
                            hyass
                            ON 
                                (
                                    (
                                        hycent.hyass = hyass.hyass
                                    )
                                )
                        )
                        LEFT JOIN
                        fast_sick_a
                        ON 
                            (
                                (
                                    hycent.fast_sick = fast_sick_a.fasts_id
                                )
                            )
                    )
                    LEFT JOIN
                    places AS fp
                    ON 
                        (
                            (
                                hycent.fromplace = fp.placecode
                            )
                        )
                )
                LEFT JOIN
                places AS ft
                ON 
                    (
                        (
                            hycent.toplace = ft.placecode
                        )
                    )
            )
            LEFT JOIN
            employee
            ON 
                (
                    (
                        hycent.pers = employee.idcard
                    )
                )
        )
        LEFT JOIN
        hass AS hs
        ON 
            (
                (
                    hycent.hassa = hs.hassid
                )
            )
    )
    LEFT JOIN
    hass AS hb
    ON 
        (
            (
                hycent.hassb = hb.hassid
            )
        )
)
WHERE
(
    (
        hycent.x1 <> 'C'
    ) OR
    (
        hycent.x1 <> 'W'
    )
) ";
$query=mysqli_query($conn,$sql);

$data = array(); 
while($rs=mysqli_fetch_array($query)) {
    $a['dgroup']     = $rs['dgroup'].'-'.$rs['hyitem'];
    $a['assname']    = $rs['assname'];
    $a['firstplace'] = $rs['fplace'];
    $a['fplace']     = $rs['nfplace'];
    $a['tplace']     = $rs['ntplace'];
    $a['hdate']      = $rs['hdate'];
    $a['htime']      = $rs['htime'];
    $a['x1_pertime'] = $rs['x1_pertime'];
    $a['perto']      = $rs['perto'];
    $a['perfinish']  = $rs['perfinish'];
    // $a['name']       = $rs['name'];
    $a['usetimeAll']    = $rs['usetimeAll'];
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