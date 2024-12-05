<?php 
require_once('../PHPMailer/PHPMailerAutoload.php');
include('./db/connection.php');
require_once('./vendor/autoload.php');
?>
<?php
if(!isset($_SESSION))
{  
    session_start(); 
 }
?>
<style>
.container {
    font-family: "Thsarabun";
}

p {
    text-align: justify;
}

h1 {
    text-align: center;
}
</style>

<?php
$mdoc='';
$msgd='';
$h8='แบบสำหรับส่งต่อผู้ป่วยไปรับการตรวจหรือรักษาต่อ (Referral Information Form)';
$flname='';
 $hcode=$_SESSION['hcode'];
$sql="SELECT * FROM v_rf_detail_mail 
            WHERE send_mail = '0' AND rf_mtel<>'' Order by rf_id DESC";
$result=mysqli_query($conn,$sql);
if($rro=mysqli_num_rows($result) > 0)
{
    // สร้าง File PDF
    $id=$rro['rf_id'];
    $epdf= str_replace("/","-",$rro['rf_id'].'-'.$rro['rf_hn']);

    $strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);
    $content='';
    while($rs = mysqli_fetch_assoc($result))
    {
        if($rs['rf_expire_date'] <>'')
        {
            $eyy = substr($rs['rf_expire_date'],0,5)+543;
            $emm =substr($rs['rf_expire_date'],5,2);
            $edd =substr($rs['rf_expire_date'],8,2);
            if($rs['rf_ptype_expire']=='11'){
                $h8= 'แบบสำหรับตอบกลับข้อมูลทางคลินิกผู้ป่วยส่งต่อ (Reply Clinical Infomation Form)';
            }else{    
            if($rs['rf_ptype_expire'] =='6'){
                $end_rec_sys = 'อนุมัติครั้งเดียวเท่านั้น (Single e-Approved)';
                $mdoc='เรียนแพทย์ที่ตรวจรักษา - จากนโยบายที่มุ่งเน้นเรื่องความปลอดภัยของผู้ป่วยเป็นหลัก รพ. หาดใหญ่จะส่งต่อผู้ป่วยไปยังท่านในกรณีที่เกินศักยภาพการรักษาของรพ. หาดใหญ่ ดังนั้นขอให้ท่านสรุปประวัติการรักษาทั้งหมด รวมถึงผลทางรังสีและห้อง LAB ที่จำเป็นมายัง รพ.หาดใหญ่ เพื่อให้ผู้ป่วยเข้ารักษาต่อเนื่องที่รพ.หาดใหญ่ต่อไป  - ขอแสดงความนับถือ  - ศูนย์บริหารจัดการส่งผู้ป่วย รพ.หาดใหญ่ (CVT-10682-13779-09-0003045) (อมุมัติครั้งเดียว (Single e-Approved))';
            }else{
                if($rs['rf_ptype_expire']=='7')
                {
                    $end_rec_sys = 'ไม่อนุมัติส่ง (Unapproved)';
                }else{
                    if($rs['rf_ptype_expire']=='8')
                    {
                        $end_rec_sys = 'ส่งกลับ​รพ.​ต้นสังกัดเดิม';
                    }else{
                        $end_rec_sys = ($edd.'/'.$emm.'/'.$eyy);
                    }
                }
            }
        }
    }
        else
        {
            $end_rec_sys = '-';
        }
        $wat='e-Approved';
        if($rs['rf_ptype_expire']=='8')
        {
        $wat ='Return to Original Heath Unit';
        }else{    
        if($rs['rf_ptype_expire']=='7') 
        {
         $wat ='Unapproved';
        }else{
        if($rs['rf_ptype_expire']=='11'){
            $wat ='Reply Clinical Data';
        }else{   
        if($rs['rf_ptype_expire']=='6') 
        {
            $wat ='Single e-Approved';
            $msgd= '<hr>
            <b>เรียนแพทย์ที่ตรวจรักษา '.$rs['hossendto_name'].'- </b>'.$rs['rf_patients'].'<br>
                                 ความปลอดภัยของผู้ป่วยเป็นนโยบายหลักของ'.' '.$rs['hosname'].' '.'ผู้ป่วยจะส่งต่อไปยังท่านในกรณีที่เกินศักยภาพการรักษาของ รพ.<br>
                                 ดังนั้น <b> ขอให้ท่านสรุปประวัติการรักษาที่สำคัญ มายัง'.'  '.$rs['hosname'].' '.'  เพื่อให้ผู้ป่วยเข้ารักษาต่อเนื่องที่ต่อไป</b><br>
                                 <br>
            ขอแสดงความนับถือ  <br>
            ศูนย์บริหารจัดการส่งผู้ป่วย'.' '.$rs['hosname'].'<br>
';
        }
       }
    }
}
        $hs1 ='<b>'.$rs['hosname'].' ('.$rs['rf_hospital'].')</b>';
        if(strlen(trim($rs['descicda']))<>0){
            $icd_a='-'.'['.$rf_icd10a.']'.$rs['descicda'];
        }else{
            $icd_a='';
        }
        if(strlen(trim($rs['descicdb']))<>0){
            $icd_b='-'.'['.$rs['rf_icd10b'].']'.$rs['descicdb'];
        }else{
            $icd_b='';           
        }
        if(strlen(trim($rs['descicdc']))<>0){
            $icd_c='-'.'['.$rs['rf_icd10c'].']'.$rs['descicdc'];
        }else{
            $icd_c=''; 
        }
        $hno = $rs['norf'];
        $an=$rs['rf_an'];
        $hd18 = $rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'].'  (ว. '.$rs['docsend_code'].')';
        $hd18a = $rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'];
        
        if(empty($an)){
            $an='----------';
        }
        $sryy = substr($rs['rf_serv'],6,4)+'543';
        $syy =  substr($rs['rf_serv'],0,2).'/'.substr($rs['rf_serv'],3,2).'/'.$sryy; 

        $content .= '
        <tr>
            <td>
                <table style="width:100%;padding: 1px;">
                    <tr>
                        <td width="45%" style="font-size:22px;"><b>ต้นทาง :</b> '.$rs['hosname'].' ('.$rs['rf_hospital'].')'.'</td>
                        <td width="45%" style="font-size:22px;text-align:right;"><b>ปลายทาง : </b> '.$rs['hossendto_name'].' ('.$rs['rf_hos_send_to'].')'.'</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td style="font-size:22px;"><b>วันที่ขอส่งต่อ : </b>'.$rs['rf_date'].'</td>
                    </tr>
                    <tr>
                        <td style="font-size:22px;"><b>ประเภทส่งต่อ : </b>'.$rs['rfevent'].'</td>
                    </tr>
                    <tr>
                        <td style="font-size:22px;"><b>ความเร่งด่วน : </b>'.$rs['rffast'].'</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>ชื่อ-สกุล ผู้ป่วย : </b>'.$rs['rf_patients'].'<b>  เพศ : </b>'.$rs['rf_sex'].'<b> อายุ : </b>'.$rs['rf_age'].'<b> ปี เลขที่บัตรประชาชน : </b>'.$rs['rf_idcard'].'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>HN : </b>'.$rs['rf_hn'].' <b>AN : </b>'.$an.'<b>   OPD/WARD : </b>'.'('.$rs['rf_placecode'].') '.$rs['rf_placename'].' </td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>วันนอน รพ./รับบริการ : </b> '.$syy.'<b>       สิทธิ์การรักษาครั้งนี้ : </b> '.$rs['pttypename'].'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>ที่อยู่ปัจจุบัน (ติดต่อได้) : </b>'.$rs['rf_saddress'].'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>โทรศัพท์ : </b> '.$rs['rf_stel'].'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>Email Address : </b> '.$rs['rf_mtel'].'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>BT </b>'.$rs['bb'].'<b> <sup>.</sup>C</b> <b>BP </b>'.$rs['bpa'].'<b>/</b>'.$rs['bpb'].' <b>mmHg, PR </b>'.$rs['pr'].'/min<b>,RR </b>'.$rs['rr'].'<b>/min,  O2 Sat </b> '.$rs['o2'].'%, <b>Pain Score  </b> '.$rs['pain'].' <b>BW </b>'.$rs['weight_value'].' <b>kg. BH </b>'.$rs['head_value'].   '<b>  cm.  HC  </b>'.$rs['heigth_value'].  ' <b>cm.</b> </td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>ประวัติการแพ้ยา</b></td>
        </tr>
        <tr>
            <td style="font-size:22px;"> &nbsp;&nbsp;&nbsp;&nbsp;'.trim($rs['rf_allergy']).'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>ประวัติผู้ป่วยปัจจุบัน </b> </td>
        </tr>
        <tr>
            <td style="font-size:22px;">&nbsp;&nbsp;&nbsp;&nbsp;'.trim($rs['rf_his_patient']).'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>ตรวจร่างกาย </b></td>
        </tr>
        <tr>
            <td style="font-size:22px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$rs['rf_his_body'].'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>การตรวจทางห้องปฏิบัติการ/รังสี/อื่น ๆ </b></td>
        </tr>
        <tr>
            <td style="font-size:22px;">'.$rs['rf_his_lab'].'</td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td style="font-size:22px;"><b>การวินิจฉัยระบุเอง </b></td>
        </tr>
        <tr>
            <td style="font-size:22px;">'.$rs['rf_icd_free_text'].'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>การวินิจฉัย (ICD10) </b></td>
        </tr>
        <tr>
            <td style="font-size:22px;">'.$icd_a.'</td>
        </tr>
        <tr>
            <td style="font-size:22px;">'.$icd_b.'</td>
        </tr>
        <tr>
            <td style="font-size:22px;">'.$icd_c.'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>การรักษาปัจจุบัน </b></td>
        </tr>
        <tr>
            <td style="font-size:22px;">'.$rs['rf_his_takecare_now'].'</td>
        </tr>
        
        <tr>
            <td style="font-size:22px;"><b>แผนการรักษาแจ้งปลายทาง  </b></td>
        </tr>
        <tr>
            <td style="font-size:22px;">'.$rs['rf_exp_takecare_hosp_end'].'</td>
        </tr>
        
        <tr>
            <td style="font-size:22px;"><b>ชื่อแพทย์ผู้ส่ง : </b>'.$rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'].'<b>  (ว. </b>'.$rs['docsend_code'].')'.'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>ชื่อแพทย์เจ้าของไข้ : </b>'.$rs['docme_prename'].$rs['docme_name'].'  '.$rs['docme_surname'].' <b> (ว. </b>'.$rs['docme_code'].')' .'</td>
        </tr>
        <tr>
            <td style="font-size:22px;"><b>กลุ่มงานส่งต่อ : </b>'.$rs['m_depname'].' ('.$rs['m_code'].')'.'</td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <table width="100%" style="font-size:22px;border:1px solid; padding:0px 0px 0px 0px">
                                <tr>
                                    <td style="font-size:22px;"><b>ใช้สิทธิ์ : </b>'.$rs['pttype_name'].'</td>
                                </tr>
                                <tr>
                                    <td style="font-size:22px;"><b>เรียกเก็บเงินไปที่ : </b>  '.$rs['pay_hosp_name'].'</td>
                                </tr>
                                <tr>
                                    <td style="font-size:22px;"><b>วันหมดอายุ : </b>'.$end_rec_sys.' </td>
                                </tr>
                                <tr>
                                    <td style="font-size:22px;"><b>รับรองสิทธิ์ (เพิ่มเติม) : </b>'.$rs['rf_no_thairefer'].'</b> </td>
                                </tr>
                                <tr>
                                    <td style="font-size:22px;"><b>เหตุผล Refer : </b>'.$rs['rf_name'].'</b></td>
                                </tr>
                                <tr>
                                    <td style="font-size:22px;"><b>หมายเหตุ : </b>'.$rs['rf_remchar'].'</b></td>
                                </tr>
                            </table>
                        </td>

                        <td width="30%">
                            <table width="100%">
                                <tr>
                                    <td style="font-size:22px;padding:80px 0px 0px 0px;"><center><b>ลงชื่อ </b>'.$hd18a. ' (E-signature) </center></td>
                                </tr>
                                <tr>
                                    <td style="font-size:22px;"><center>'.$hd18.'</center></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <div style="width:100%; top:0px;text-align:center;">
                        <img src="./img/lineall.JPG" style="width: 115px;" />
                    </div>
                </center>
            </td>
        </tr>
        <tr>
            <td style="padding:0px 0px 0px 0px;font-size:22px;">
                <center>
                    <table width="100%">
                        <tr>
                            <td style="font-size:22px;">
                                ท่านสามารถติดต่อศูนย์บริหารจัดการส่งต่อผู้ป่วย'.'  '.$rs['hosname'].' '.'ผ่านทาง LINE Official (สแกนคิวอาร์โค้ด)
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:22px;">
                                  โทรศัพท์สายตรง : 074-273-100 ต่อ 2108,5433  Email : refer.hy@hatyaihospital.go.th                        
                            </td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>
        <tr><td></td> </tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
            <td  width="50%">
                    <table width="100%">
                        <tr>
                                <td width="50%" align="right">
                                    (NB e-Refer Service Operating System:NBER SOS)
                                </td>
                        </tr>
                    </table>
            </td>  
        </tr>
        <tr>
         <td style="font-size:23px";>
            '.$msgd.'
        </td>
    </tr>';
    }   
    mysqli_close($conn);

    $head = '
    <body>
    <div style="A_CSS_ATTRIBUTE:all;position: absolute;bottom: 20px; right: 30px;left: 30px; top: 25px; ">
    <table class="container" width="100%" style="border-collapse: collapse;padding:-20px 0px 0px 0px;">
    <thead>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td width="50%" style="padding:0px 0px 0px 15px;">
                            <barcode code='.$qrb.' type="QR" size="1.4" error="M" class="barcode" disableborder = "1"/>
                        </td>
                        <td width="50%">
                            <barcode code='.$hno.' type="C39" />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:17px;padding:30px 0px 0px 7px;">
                                <b>ถึงปลายทาง SCAN รับ</b> 
                        </td>
                        <td style="font-size:24px;padding:-100px 0px 0px 0px;"><center>'.$hno.'</center></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="font-size:28px;padding:15px 0px 0px 0px;text-align:center;font-weight:Bold;">
            '.$h8.'
            </td>
        </tr>
        <tr>
            <td style="font-size:35px;padding:0px 0px 0px 10px;text-align:center;">'.$hs1.'</td>
        </tr>   
    </thead>
	<tbody>';

    $end = "</tbody></table></div></body>";
    $mpdf->WriteHTML($head);
    $mpdf->WriteHTML($content);
    $mpdf->WriteHTML($end);
    $mpdf->SetWatermarkText($wat);
    $mpdf->showWatermarkText = true;
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->Output('./email/'.$epdf.'.pdf');
    ob_end_flush();

// จบการสร้าง File PDF

foreach ($result as $rss)
{
$fl='';
$email ='tbbunyoung@gmail.com';
$n = $rss['rf_id'];
$rs = $rss['send_line'];
if (filter_var($email, FILTER_VALIDATE_EMAIL))
{
$icda= '['.$rss['rf_icd10a'].']'.$rss['descicda'];
$icdb='['.$rss['rf_icd10b'].']'.$rss['descicdb'];
$icdc='['.$rss['rf_icd10c'].']'.$rss['descicdc'];
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
$fl .= "<p>วินิจฉัยเบื้องต้นการรักษาครั้งนี้ : ".$rss['rf_icd_free_text']."</p>";
$fl .= "<p>รหัส ICD-10 : ".$icda."</p>";
$fl .= "<p> : ".$icdb."</p>";
$fl .= "<p> : ".$icdc."</p>";
$fl .= "<p>การรักษาปัจจุบัน : ".$rss['rf_his_takecare_now']."</p>";
$fl .= "<p>แผนการรักษาแจ้งปลายทาง : ".$rss['rf_exp_takecare_hosp_end']."</p>";
$fl .= "<p>แพทย์/จนท.ศูนย์ ผู้ส่ง : ".$rss['docsend_prename'].$rss['docsend_name'].' '.$rss['docsend_surname']."</p>";
$fl .= "<p>แพทย์/จนท.ศูนย์ ผู้อนุมัติ : ".$rss['docme_prename'].$rss['docme_name'].' '.$rss['docme_surname']."</p>";
$fl .= "<p>รหัสผ่านสำหรับเปิดไฟล์ PDF คือ เลขบัตรประชาชนของผู้ป่วย</p>";
$fl .= "<p>กรุณากดลิงค์ด้านล่าง (ระหว่างปรับปรุง)"."</p>";
$fl .= "<p>http://61.19.25.194/e_nrefer/my_form_mail?rfn=".$rss['rf_no_refer']."</p>";
$fl .= "<p>โปรดตรวจสอบความถูกต้อง หากมีข้อสงสัย/แนะนำเพิ่มเติมหรือคำติชม"."</p>";
$fl .= "<p>กรุณาติดต่อที่เบอร์โทรศัพท์ : 074-273-100 ต่อ 2108,5433 "."</p>";
$fl .= "<p>ขอขอบพระคุณมา ณ โอกาสนี้"."</p>";
$fl .= "<p>เราพร้อมเป็นส่วนหนึ่งในการดูแล ติดต่อ ประสานงาน เมื่อท่านเข้ารับบริการรักษา ที่ โรงพยาบาลหาดใหญ่"."</p>";
$fl .= "<p>กรุณาประเมินความพึงพอใจและแนะนำการบริการผ่านทาง : LINE OFFICIAL https://lin.ee/aJacZMu"."</p>";
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
$mail->Host = 'smtp.gmail.com'; //gmail SMTP server
$mail->Username = 'referonlinehy@gmail.com'; //email
$mail->Password = 'yhlwyeywlcqozcma'; //16 character obtained from app password created
$mail->Port = 465; //SMTP port
$mail->SMTPSecure = "ssl";

//sender information
$mail->setFrom('referonlinehy@gmail.com', 'ศูนย์บริหารจัดการส่งต่อผู้ป่วย โรงพยาบาลหาดใหญ่');

//receiver address and name
$mail->addAddress($email, $uname);

$mail->isHTML(true);

$mail->Subject = 'ส่งใบส่งต่อการรักษาของคุณ '.$uname;
$mail->Body = $body;
$mail->WordWrap = 50;
$mail->addAttachment('./email/'.$epdf);
// Send mail
if (!$mail->send()) {
echo 'Message was not sent.';
echo 'ยังไม่สามารถส่งเมลล์ได้ในขณะนี้ ' . $mail->ErrorInfo;
exit;
}
$mail->smtpClose();
}
?>