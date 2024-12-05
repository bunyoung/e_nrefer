<!DOCTYPE html>
<html>

<head>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta charset=utf-8 />
    <title>jQuery Notify</title>
</head>

<body>
    <center>
        <script>
        $(document).ready(function() {
            $('#p').click(function() {
                notify();
            });
        });

        function notify() {
            if (!Notification) {
                alert('Notifications are supported in modern versions of Chrome, Firefox, Opera 
                    and Firefox.
                    '); 
                    return;
                }

                if (Notification.permission !== "granted") {
                    Notification.requestPermission();
                }

                var notification = new Nfication("ยินดีต้อนรับค่ะ", { //หัวข้อ
                    icon: "https://www.mindphp.com/forums/images/avatars/gallery/gallery/tn10.gif", //รูป
                    body: ".............................ทำสอบสร้างการแจ้งเตือนด้วย Popup.............................", //คำอธิบาย
                });

                notification.onclick = function() {
                    window.open("#");
                };
                setTimeout(function() {
                    notification.cancel();
                }, '1000'); //ตั้งเวลาปิด
            }
        </script>
        <h1 id="p">กดปุ่มเพื่อแสดง POPUP</h1>
        <button onClick='notify()'>แสดง Popup</button>
    </center>
</body>

</html>