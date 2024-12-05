<?php 
require_once('../PHPMailer/PHPMailerAutoload.php');
include('./db/connection.php');
require_once('./vendor/autoload.php');
?>
<?php
include('./db/connection.php');
if(!isset($_SESSION))
{  
    session_start(); 
 }
 $flname='';

 $hcode=$_SESSION['hcode'];
$sql="SELECT * FROM v_rf_detail_mail 
            WHERE send_mail = '0' AND rf_mtel<>'' Order by rf_id DESC";
$result=mysqli_query($conn,$sql);
if($rro=mysqli_num_rows($result) > 0)
{
    foreach ($result as $rss)
    {
        $fl='';
        $email  =$rss['rf_mtel'];
        $n  = $rss['rf_id'];
        $rs = $rss['send_line'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        { 
            $icda= '['.$rss['rf_icd10a'].'] '.$rss['descicda'];
            $icdb='['.$rss['rf_icd10b'].'] '.$rss['descicdb'];
            $icdc='['.$rss['rf_icd10c'].'] '.$rss['descicdc'];
            $uname=$rss['rf_patients'];
            $fl .= "<p>โรงพยาบาลหาดใหญ่ขอส่งข้อมูลการรักษาและใบส่งต่อการรักษา</p>";
            $fl .= "<p>ประเภทส่งต่อ : ".$rss['rfevent']."</p>";
            $fl .= "<p>ชื่อ : ".$rss['rf_patients']."</p>";
            $fl .= "<p>HN : ".$rss['rf_hn']."</p>";
            $fl .= "<p>AN : ".$rss['rf_an']."</p>";
            $fl .= "<p>เลขที่บัตรประชาชน : ".$rss['rf_idcard']."</p>";
            $fl .= "<p>วันที่รับบริการ : ".$rss['rf_date']."</p>";
            $fl .= "<p>หน่วยบริการ : " .'('.$rss['rf_placecode'].')'.' '.$rss['rf_placename']."</p>";
            $fl .= "<p>สิทธิ์การรักษาครั้งนี้ : ".$rss['pttypename']."</p>";
            $fl .= "<p>ประวัติแพ้ยา : ".$rss['rf_allergy']."</p>";
            $fl .= "<p>ประวัติผู้ป่วย : ".$rss['rf_his_patient']."</p>";
            $fl .= "<p>ตรวจร่างกาย : ".$rss['rf_his_body']."</p>";
            $fl .= "<p>ผลตรวจทางห้องปฎิบัติการ/รังสี/อื่น ๆ : ".$rss['rf_his_lab']."</p>";
            $fl .= "<p>วินิจฉัยเบื้องต้นการรักษาครังนี้ : ".$rss['rf_icd_free_text']."</p>";
            $fl .= "<p>รหัส ICD-10 : ".$icda."</p>";
            $fl .= "<p>                    : ".$icdb."</p>";
            $fl .= "<p>                    : ".$icdc."</p>";
            $fl .= "<p>การรักษาปัจจุบัน : ".$rss['rf_his_takecare_now']."</p>";
            $fl .= "<p>แผนการรักษาแจ้งปลายทาง : ".$rss['rf_exp_takecare_hosp_end']."</p>";
            $fl .= "<p>แพทย์/จนท.ศูนย์ ผู้ส่ง : ".$rss['docsend_prename'].$rss['docsend_name'].'  '.$rss['docsend_surname']."</p>";
            $fl .= "<p>แพทย์/จนท.ศูนย์ ผู้อนุมัติ : ".$rss['docme_prename'].$rss['docme_name'].'  '.$rss['docme_surname']."</p>";
             $fl .= "<p>รหัสผ่านสำหรับเปิดไฟล์ PDF คือ เลขบัตรประชาชนของผู้ป่วย</p>";
            $fl .= "<p>กรุณากดลิงค์ด้านล่าง (ระหว่างปรับปรุง)"."</p>";
            $fl .= "<p>http://61.19.25.194/e_nrefer/my_form_mail?rfn=".$rss['rf_no_refer']."</p>";
            $fl .= "<p>โปรดตรวจสอบความถูกต้อง  หากมีข้อสงสัย/แนะนำเพิ่มเติมหรือคำติชม"."</p>";
            $fl .= "<p>กรุณาติดต่อที่เบอร์โทรศัพท์ : 074-273-100 ต่อ 2108,5433 "."</p>";
            $fl .= "<p>ขอขอบพระคุณมา ณ โอกาสนี้"."</p>";
            $fl .= "<p>เราพร้อมเป็นส่วนหนึ่งในการดูแล ติดต่อ ประสานงาน เมื่อท่านเข้ารับบริการรักษา ที่ โรงพยาบาลหาดใหญ่"."</p>";
            $fl .= "<p>กรุณาประเมินความพึงพอใจและแนะนำการบริการผ่านทาง : LINE OFFICIAL  https://lin.ee/aJacZMu"."</p>";
            $fl .= "<p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลอัตโนมัติ กรุณาอย่าตอบกลับอีเมลนี้"."</p>";
            $sql=mysqli_query($conn,"update rf_detail SET send_mail = '1' WHERE rf_id= '$n' ");
                          sendmail($email,$uname,$fl);
        }  
    }
}   

// สำหรับทดสอบ
// sendmail($email,$flname,$newp);
// sendmail($_POST['email'],$_POST['flname'],$_POST['newpass']);

function sendmail($email,$uname,$fl)
{
      // $body .= "<p>เรียน ".$uname."</p>";
    $body .= "<p>".$fl."</p>";
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->CharSet = "utf-8"; 
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->Username = 'referonlinehy@gmail.com';   //email
    $mail->Password = 'yhlwyeywlcqozcma';   //16 character obtained from app password created
    $mail->Port = 465;                    //SMTP port
    $mail->SMTPSecure = "ssl";

    //sender information
    $mail->setFrom('referonlinehy@gmail.com', 'ศูนย์บริหารจัดการส่งต่อผู้ป่วย โรงพยาบาลหาดใหญ่');

    //receiver address and name
    $mail->addAddress($email, $uname);

    $mail->isHTML(true);

    $mail->Subject = 'ส่งใบส่งต่อการรักษาของคุณ '.$uname;
    $mail->Body = $body;
    $mail->WordWrap = 50;

    // Send mail   
     if (!$mail->send()) {
        echo 'Message was not sent.';
        echo 'ยังไม่สามารถส่งเมลล์ได้ในขณะนี้ ' . $mail->ErrorInfo;
        exit;
     } 
    //  else 
    //  {
    //      echo '1';
    // }
    $mail->smtpClose();
}
?>
