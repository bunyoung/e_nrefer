<?php
require_once("phpqrcode/qrlib.php");
$gcode=$_GET['code'];
QRcode::png($gcode);