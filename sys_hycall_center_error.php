<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include('main_script.php');
?>

<head>
    <title>รพ หาดใหญ่</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/lib/font-awesome-4.6.3/css/font-awesome.css">
</head>

<body>

    <?php
    if(@$_GET['do']=='ok'){
        echo '<script type="text/javascript">
           swal("", "บันทึกข้อมูลที่จำเป็นในการเรียบร้อยแล้ว ในขณะนี้ !!", "success");
        </script>';
    }
    ?>

    <?php
    if(@$_GET['do']=='vali'){
        echo '<script type="text/javascript">
         swal("", "ข้อมูลที่จำเป็นในการไม่สมบูรณ์ ในวันนี้ !!" , "error");
       </script>';
    }
    ?>

    <?php
    if(@$_GET['do']=='nok'){
        echo '<script type="text/javascript">
           swal("", "ไม่สามารถบันทึกรายการได้ !!ตรวจสอบการขอเปล !!", "error");
        </script>';
    }
?>
    <?php
    if(@$_GET['do']=='dok'){
        echo '<script type="text/javascript">
           swal("", "ลบรายการให้เรียบร้อยแล้ว !!", "success");
        </script>';
    }
?>
    <?php
    if(@$_GET['do']=='nof'){
        echo '<script type="text/javascript">
           swal("", "ไม่สามารถเข้าสู่ระบบการทำงานได้ !!", "success");
        </script>';
    }
?>
<?php
    echo '<meta http-equiv="refresh" content="2;url=dashboard.php" />';
?>
</body>

</html>