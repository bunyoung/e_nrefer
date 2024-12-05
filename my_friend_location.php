<?php
// ในที่นี้ กำหนด ตัวแปร session ของสมาชิก ชื่อ 
// $_SESSION['ses_user_id']  เก็บ ไอดี ผู้ใช้
// $_SESSION['ses_user_name']  เก็บ ชื่อ ผู้ใช้
// $_SESSION['ses_user_icon']  เก็บ รูป ผู้ใช้
 
// ตัวอย่างค่าสำหรับทดสอบ
$_SESSION['ses_user_id']=1;
$_SESSION['ses_user_name']="Ninenik Narkdee";
$_SESSION['ses_user_icon']="http://www.ninenik.com/demo/photo_avatar.php";
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Google Map API 3 - Friend 01</title>
    <style type="text/css">
    html {
        height: 100%
    }

    body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: tahoma, "Microsoft Sans Serif", sans-serif, Verdana;
        font-size: 12px;
    }

    /* css กำหนดความกว้าง ความสูงของแผนที่ */
    #map_canvas {
        width: 650px;
        height: 500px;
        margin: auto;
        margin-top: 50px;
    }
    </style>


</head>

<body>
    <div id="map_canvas"></div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
    var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
    var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
    function initialize() { // ฟังก์ชันแสดงแผนที่
        GGM = new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
        // กำหนดจุดเริ่มต้นของแผนที่
        var my_Latlng = new GGM.LatLng(13.761728449950002, 100.6527900695800);
        // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
        var my_DivObj = $("#map_canvas")[0];
        // กำหนด Option ของแผนที่
        var myOptions = {
            zoom: 12, // กำหนดขนาดการ zoom
            center: my_Latlng, // กำหนดจุดกึ่งกลาง
            mapTypeId: GGM.MapTypeId.ROADMAP, // กำหนดรูปแบบแผนที่
            mapTypeControlOptions: { // การจัดรูปแบบส่วนควบคุมประเภทแผนที่
                position: GGM.ControlPosition.TOP, // จัดตำแหน่ง
                style: GGM.MapTypeControlStyle.DROPDOWN_MENU // จัดรูปแบบ style 
            }
        };
        map = new GGM.Map(my_DivObj, myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map

        // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี  
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var myPosition_lat = position.coords.latitude; // เก็บค่าตำแหน่ง latitude  ปัจจุบัน
                var myPosition_lon = position.coords.longitude; // เก็บค่าตำแหน่ง  longitude ปัจจุบัน
                // สรัาง LatLng ตำแหน่ง สำหรับ google map
                var pos = new GGM.LatLng(position.coords.latitude, position.coords.longitude);
                $.post("save_location.php", { // ส่งค่าตำแหน่งปัจจุบัน บันทึกลงฐานข้อมูล
                    myPosition_lat: myPosition_lat, // ส่งค่า latitude
                    myPosition_lon: myPosition_lon // ส่งค่า longitude
                }, function() {
                    map.panTo(pos); // เลื่อนแผนที่ไปตำแหน่งปัจจุบัน
                    map.setCenter(
                    pos); // กำหนดจุดกลางของแผนที่เป็น ตำแหน่งปัจจุบัน                                   
                });
            }, function() {
                // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน  
            });
        } else {
            // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง  
        }


    }
    $(function() {
        // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
        // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
        // v=3.2&sensor=false&language=th&callback=initialize
        //  v เวอร์ชัน่ 3.2
        //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
        //  language ภาษา th ,en เป็นต้น
        //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
        $("<script/>", {
            "type": "text/javascript",
            src: "//maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
        }).appendTo("body");
    });
    </script>
</body>

</html>