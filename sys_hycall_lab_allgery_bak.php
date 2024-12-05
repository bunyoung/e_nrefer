<!DOCTYPE HTML>

<?php
require_once("db/connect_pmk.php");
// include('main_script.php');
$hn=$_POST['lhn'];
?>
<html class="no-js">

<head>

<body class="boxed">
    <div class="boxed-wrapper">
        <div class="content3">
            <div class="outer">
                <div class="inner bg-light lter">
                    <div class="col-lg-12">
                        <div class="box">
                            <header>
                                <div class="icons">
                                    <i class="fa fa-user"></i>
                                </div>
                                <h5>รายการLAB</h5>
                            </header>
                            <p>
                             <div class="panel-body" style:"overflow:scroll;">
                                 <table id="dataTable_" class="table table-bordered"></table>
                             </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>




<div id="content3">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="col-lg-12">

                <table id="dataTable_" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>
                                <center>วันที่</center>
                            </th>
                            <th>
                                <center>รายการLAB</center>
                            </th>
                            <th>
                                <center>ค่าปรกติ</center>
                            </th>
                            <th>
                                <center>ผลลัพท์</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $sql='';
                    $sql = "SELECT * FROM h4u_lab WHERE DATE_SERVE >= TRUNC(SYSDATE) AND HN='$hn' 
                            ORDER BY SEQ DESC ";
                    $stld = oci_parse($objConnect, $sql);
                    oci_execute ($stld,OCI_DEFAULT);
                    while($rss = oci_fetch_array($stld,OCI_ASSOC))
                    {
                        $lds=$rss['DATE_SERVE'];
                        $lna=$rss['LAB_NAME'];
                        $lrs=$rss['LAB_RESULT'];
                        $srs=$rss['STANDARD_RESULT'];
                        $lts=$rss['TIME_SERVE'];
                    ?>
                        <tr>
                            <!-- ส่วนงานเตียง -->
                            <td>
                                <center>
                                    <?php echo $lds; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php echo $lna; ?>
                                </center>
                            </td>

                            <td>
                                <center>
                                    <?php echo $lrs; ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php echo $srs; ?>
                                </center>
                            </td>
                        </tr>
                        <?php   
                    }
                    ?>
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
</div>

</head>

</html>
<?php 
 oci_close($objConnect);
?>