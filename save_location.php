<?php
session_start(); // สำหรับ ใช้งาน session ที่เก็บ ไอดี และ ชื่อ ของสมาชิก
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);       
mysql_connect("localhost","root","") or die("Cannot connect the Server");  
mysql_select_db("test") or die("Cannot select database");  
mysql_query("set character set utf8");  
 
 
// ในที่นี้ กำหนด ตัวแปร session ของสมาชิก ชื่อ 
// $_SESSION['ses_user_id']  เก็บ ไอดี ผู้ใช้
// $_SESSION['ses_user_name']  เก็บ ชื่อ ผู้ใช้
// $_SESSION['ses_user_icon']  เก็บ รูป ผู้ใช้
 
 
// ตรวจสอบว่ามีการส่งคำค้นมาหรือไม่
if(isset($_SESSION['ses_user_id']) && $_SESSION['ses_user_id']!=""
&& isset($_POST['myPosition_lat']) && $_POST['myPosition_lat']!=""
&& isset($_POST['myPosition_lon']) && $_POST['myPosition_lon']!=""
){
    // ตรวจสอบว่า มีข้อมูล สมาชิก ไอดี นี้อยู่ก่อนหรือไม่ ถ้ามี 
    if(@mysql_num_rows(@mysql_query(" 
        SELECT user_id FROM user_position WHERE user_id='".$_SESSION['ses_user_id']."'
    "))>0){
        // ให้อัพเดทข้อมูล
        @mysql_query("
            UPDATE user_position SET 
               user_name='".addslashes($_SESSION['ses_user_name'])."',
               user_latitude='".trim($_POST['myPosition_lat'])."',
               user_longitude='".trim($_POST['myPosition_lon'])."',
               user_datetime='".date('Y-m-d H:i:s')."',
               user_icons='".addslashes($_SESSION['ses_user_icon'])."'
            WHERE user_id='".$_SESSION['ses_user_id']."'       
        ");
    }else{
        // ถ้าไม่มีให้เพิ่มข้อมูลใหม่
        @mysql_query("
            INSERT INTO user_position (
               user_id,
               user_name,
               user_latitude,
               user_longitude,
               user_datetime,
               user_icons
            ) VALUES (
               '".trim($_SESSION['ses_user_id'])."',
               '".addslashes($_SESSION['ses_user_name'])."',
               '".trim($_POST['myPosition_lat'])."',
               '".trim($_POST['myPosition_lon'])."',
               '".date('Y-m-d H:i:s')."',
               '".addslashes($_SESSION['ses_user_icon'])."'
            )       
        ");     
    }
     
}
?>