<html class="no-js">

<head>
    <?php
        require_once("db/connect_pmk.php");
        // include('main_script.php');
        $hn=$_POST['lhn'];
    ?>
</head>

<body>
    <?php 
    $sql="SELECT 
    DATE_SERVE,TIME_SERVE,LAB_NAME,LAB_RESULT,STANDARD_RESULT
    FROM
    (SELECT *
      FROM H4U_LAB 
      WHERE 
        LAB_RESULT < '2.5' OR LAB_RESULT > '6.5' AND
        DATE_SERVE<=TRUNC(SYSDATE-2) 
    )x
    WHERE  
      SUBSTR(UPPER(LAB_NAME),1,4) IN('POTA') AND X.HN='$hn'";
    ?>
<div class="panel">

    <table style="background-color:#ffffff;color:#2a2a2a;font-size:23px;"> 
        <thead>
            <tr>
                <th>
                    <center>วันที่</center>
                </th>
                <th>
                    <center>เวลา</center>
                </th>
                <th>
                    <center>Labname</center>
                </th>
                <th>
                    <center>Lab result</center>
                </th>
                <th>
                    <center>Lab Standard</center>
                </th>
            </tr>

        </thead>
        <tbody>
            <?php
            $stld = oci_parse($objConnect, $sql);
                    oci_execute ($stld,OCI_DEFAULT);
                    while($rss = oci_fetch_array($stld,OCI_ASSOC))
                    {
                        $lds=$rss['DATE_SERVE'];
                        $lna=$rss['LAB_NAME'];
                        $lrs=$rss['LAB_RESULT'];
                        $srs=$rss['STANDARD_RESULT'];
                        $lts=$rss['TIME_SERVE'];
                    }
                    ?>

            <tr>
                <td>
                    <center><?php echo $lds; ?></center>
                </td>
                <td>
                    <center><?php echo $lts; ?></center>
                </td>
                <td>
                    <center><?php echo $lna; ?></center>
                </td>
                <td>
                    <center><?php echo $lrs; ?></center>
                </td>
                <td>
                    <center><?php echo $srs; ?></center>
                </td>
            </tr>
        </tbody>
    </table>
                </div>
</body>

</html>
<?php 
 oci_close($objConnect);
?>