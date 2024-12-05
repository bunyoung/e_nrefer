<!doctype html>
<?php
include('./db/connection.php');
$icdhn = $_POST['icdhn'];
echo $icdhn; 'ssssssssssssssssss';
?>

<body>
<?php
    echo $icdhn.'  '.'ssssssssssssssssss';
?>
</body>
<?php
    mysqli_close($conn);
?>
</html>