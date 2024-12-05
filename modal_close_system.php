<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>e_Nrefer</title>

    <!-- script modal popup  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- css -->
    <style type="text/css">
    .modal.fade:not(.in) .modal-dialog {
        -webkit-transform: translate3d(-100%, 0, 0);
        transform: translate3d(-100%, 0, 0);
    }
    </style>
    <script type="text/javascript">
    var show = function() {
        $('#myModal').modal('show');
    };

    $(window).load(function() {
        var timer = window.setTimeout(show, 0);
    });
    </script>
</head>

<body>

    <!-- title -->
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 align="center"> e_nrefer </h2>
            </div>
        </div>
    </div> -->

    <!-- modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-md" 
                    style="font-family:K2D;Font-size:18px; width:50%;height:auto;background-color:#A52A2A;">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#A52A2A;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body" style="background-color:#A52A2A;color:#F0FFFF">
                    <p>
                      <strong>** แจ้งเพื่อทราบ..เกี่ยวกับระบบโปรแกรมส่งต่อ **</strong>
                    </p>
                                เนื่องจาก ในอนาคต จะมีการนำโปรแกรมส่งต่อที่ทางเขตสุขภาพที่ 12 
                          พัฒนาขึ้นและจะนำมาใช้ในโรงพยาบาลหาดใหญ่ในอนาคต (ตั้งแต่ 1 พ.ย. 2566) 
                          เพื่อไม่เกิดความสับสนในอนาคต ระบบ โปรแกรมนี้จะหยุด (Terminate) การพัฒนาตั้งแต่วันนี้เป็นต้นไป 
                          ซึ่งจะทำให้เกิดความล้าช้าและขัดข้องได้ ดังนั้น ในกรณีที่ไม่สามารถลงโปรแกรมนี้ได้ 
                          กรุณากลับไปลงระบบ paper ตามเดิม และประสานศูนย์ส่งต่อต่อไป......
                          ขอบคุณสำหรับความร่วมมือจากทุกท่าน 24 ต.ค. 2566
                    <br>
                </div>
            </div>
        </div>
    </div>
</body>

</html>