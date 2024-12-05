<!doctype html>
<!-- couter visit -->
<?php
include('./db/connect_pmk.php')
?>
<html class="no-js">

<head>
    <?php
include ("main_script.php")
?>
</head>

<body class="boxed">
    <div class="boxed-wrapper">
        <div class="bg-blue dker" id="wrap">

            <table id="dataTable_" class="table table-bordered table-condensed ">
                <thead>
                    <tr class="gradeA">
                        <th>
                            <center>ลำดับ
                            </center>
                        </th>
                        <th>
                            <center>เลข บปช
                            </center>
                        </th>
                        <th>
                            <center>เลขวิทยุ
                            </center>
                        </th>
                        <th>
                            <center>ชื่อ-สกุล
                            </center>
                        </th>
                        <th>
                            <center>สถานะ
                            </center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$i=1;
while($rs_deb=mysqli_fetch_array($result_sql)) {
?>
                    <tr>
                        <td>
                            <center>
                                <?php    $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                            </center>
                        </td>
                        <td>
                            <?php  echo substr($rs_deb['id'],0,4);echo '******';echo substr($rs_deb['id'],10,3); ?>
                        </td>
                        <td>
                            <?php  echo $rs_deb['idcard']; ?>
                        </td>
                        <!-- <td>
                                                <?php    echo $rs_deb['name']; ?>
                                            </td> -->
                        <td>
                            <center>
                                <?php IF($rs_deb['delete_flag']==0){echo'<a href="#myModal_edit_user" data-toggle="modal" data-id="'.$rs_deb['idcard'].'" class="btn btn-success btn-xs btn-grad">';}ELSE{echo'<a href="#myModal_edit_user" data-toggle="modal" data-id="'.$rs_deb['idcard'].'" class="btn btn-danger btn-xs btn-grad">';}
IF($rs_deb['delete_flag']==0){echo '<i class="fa fa-thumbs-o-up"></i> : Edit';}ELSE{echo '<i class="fa fa-times"></i> : Edit';}
echo'</a>'; ?>
                            </center>
                        </td>
                    </tr>
                    <?php
}
?>
                </tbody>
            </table>
            </p>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery.js">
    </script>
    <script type="text/javascript" src="assets/js/jquery.min.js">
    </script>
    <script type="text/javascript" src="assets/js/jquery.flot.min.js">
    </script>
    <script type="text/javascript" src="assets/js/jquery.flot.selection.min.js">
    </script>
    <script type="text/javascript" src="assets/js/jquery.flot.resize.min.js">
    </script>
    <script type="text/javascript" src="assets/js/jquery-ui.min.js">
    </script>
    <script type="text/javascript" src="assets/lib/moment/min/moment.min.js">
    </script>
    <script type="text/javascript" src="assets/lib/fullcalendar/dist/fullcalendar.min.js">
    </script>
    <!--TABLE  -->
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap.js">
    </script>
    <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js">
    </script>
    <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js">
    </script>
    <!--Bootstrap -->
    <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <!-- MetisMenu -->
    <script type="text/javascript" src="assets/js/metisMenu.min.js">
    </script>
    <!-- Screenfull -->
    <script type="text/javascript" src="assets/js/screenfull.min.js">
    </script>
    <!-- Metis core scripts -->
    <script type="text/javascript" src="assets/js/core.min.js">
    </script>
    <!-- Metis demo scripts -->
    <script type="text/javascript" src="assets/js/app.js">
    </script>
    <script src="assets/js/style-switcher.min.js">
    </script>
    <script>
    $(document).ready(function() {
        $('#dataTable_').dataTable();
    });
    </script>
</body>

<!---MODAL EDIT USER -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_edit_user').on('show.bs.modal', function(e) {
        var idcard = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_admin_user_edit.php', //Here you will fetch records 
            data: {
                'idcard': idcard
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_edit_user" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : แก้ไขข้อมูลจ้าหน้เจ้าหน้าที่ศูนย์เปล และที่ีสิทธิผู้ใช้งานระบบโปรแกรม E-Hycenter
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด
                </button>
            </div>
        </div>
    </div>
</div>
<!---END MODAL EDIT USER -->

</html>