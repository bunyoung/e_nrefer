<!DOCTYPE html>
<html>
<title>DataTable Page Resize (Server Side) | CoderExample</title>

<head>
    <link rel="stylesheet" type="text/css" href="../../datable/css/jquery.dataTables.css">

    <script type="text/javascript" language="javascript" src="../../datable/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="../../datable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="../../datable/js/dataTables.pageResize.min.js"></script>

    <script type="text/javascript" language="javascript">
    $(document).ready(function() {
        var dataTable = $('#employee-grid').DataTable({
            pageResize: true, // enable page resize
            processing: true,
            serverSide: true,
            ajax: "employee-grid-data.php", // json datasource
        });

        // Resize the demo table container with mouse drag
        var wrapper = $('#resize_wrapper');
        $('#resize_handle').on('mousedown', function(e) {
            var mouseStartY = e.pageY;
            var resizeStartHeight = wrapper.height();

            $(document)
                .on('mousemove.demo', function(e) {
                    var height = resizeStartHeight + (e.pageY - mouseStartY);
                    if (height < 200) {
                        height = 200;
                    }

                    wrapper.height(height);
                })
                .on('mouseup.demo', function(e) {
                    $(document).off('mousemove.demo mouseup.demo');
                });

            return false;
        });
    });
    </script>
    <style type="text/css">
    div.header {
        margin: 0 auto;
        max-width: 980px;
    }

    body {
        background: #f7f7f7;
        color: #333;
    }

    div.container {
        margin: 0 auto;
        width: 100%;
    }

    #resize_wrapper {
        position: relative;
        height: 520px;
        padding: 0.5em 0.5em 1.5em 0.5em;
        border: 1px solid #aaa;
        border-radius: 0.5em;
        background-color: #f9f9f9;
    }

    #resize_handle {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1.5em;
        border-bottom-right-radius: 0.5em;
        border-bottom-left-radius: 0.5em;
        text-align: center;
        font-size: 0.8em;
        line-height: 1.5em;
        background-color: #f4645f;
        color: #FFF;
        cursor: pointer;
    }

    table.dataTable th,
    table.dataTable td {
        white-space: nowrap;
    }

    div.dataTables_length {
        display: none;
    }
    </style>
</head>

<body>
    <p>
    <div class="container-fluid">
        <div id="resize_wrapper">
            <table id="employee-grid" class="display dataTable" cellspacing="0" style="width:100%;" width="100%" >
                <thead>
                    <tr>
                        <td>วันที่</td>
                        <td>HN</td>
                        <td>ชื่อสกุล</td>
                        <td>รับจาก</td>
                        <td>ไปส่งที่</td>
                        <td>อุปกรณ์ที่มี</td>
                        <td>เพิ่ม</td>
                        <td>เปล</td>
                        <td>เริ่มงาน </td>
                        <td>รับงาน</td>
                        <td>ปิดงาน</td>
                        <td>รับจาก</td>
                        <td>รวมระยะเวลา </td>
                    </tr>
                </thead>
            </table>
            <div id="resize_handle">ลด ขยาย</div>
        </div>
        <!--#resize_wrapper-->
    </div>
    <!--.container-->
</body>

</html>