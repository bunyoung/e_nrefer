<?php
	include_once('./vendor/autoload.php');
	// ob_start();
    // $mpdf = new mPDF('th', 'A4', '8', 'K2D');
    $mpdf = new mPDF('th', '', '', '');

?>
<?php
	include('./db/connection.php');
    // include('main_script.php');
?>
<?php    
    if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
    $qra="http://61.19.25.194/e_nrefer/print_refer_out03.php?id=".$id;
    $qrb="http://61.19.25.194/e_nrefer/sys_hycall_send_receive_mbile.php?id=".$id;
?>
<style>
.container {
    font-family: "Thsarabun";
    /* font-size: 30pt; */
}

p {
    text-align: justify;
}

h1 {
    text-align: center;
}
</style>
<?php
    $h8='แบบสำหรับส่งต่อผู้ป่วยไปรับการตรวจหรือรักษาต่อ (Referral Information Form)';
    $strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);
    $content='';
    while($rs = mysqli_fetch_assoc($result))
    {
        if($rs['rf_expire_date'] <>''){
            $eyy = substr($rs['rf_expire_date'],0,5)+543;
            $emm =substr($rs['rf_expire_date'],5,2);
            $edd =substr($rs['rf_expire_date'],8,2);
            $end_rec_sys = ($edd.'/'.$emm.'/'.$eyy);
        }else{
            $end_rec_sys = '-';
        }
        $wat='Waiting e-Approved';
        if($rs['rf_ptype_expire']=='7') 
        {
         $wat ='Unapproved';
        }else{
         if($rs['rf_ptype_expire']=='6') 
         {
             $wat ='Single e-Approved';
         }
        }
        $hs1 ='<b>'.$rs['hosname'].' ('.$rs['rf_hospital'].')</b>';
        $icd_a='';    
        $icd_b='';    
        $icd_c='';    

        $icd_a='('.$rs['rf_icd10a'].') - '.$rs['descicda'];
        $icd_b='('.$rs['rf_icd10b'].') - '.$rs['descicdb'];
        $icd_c='('.$rs['rf_icd10c'].') - '.$rs['descicdc'];
        if (!empty($icd_a)  || ($icd_a) <>'()' ){
            $icd_a='('.$rs['rf_icd10a'].') - '.$rs['descicda'];
        }else{
        if(!empty($icd_b)  || ($icd_b) <>'()'){
            $icd_b='('.$rs['rf_icd10b'].') - '.$rs['descicdb'];
        }else{
        if(!empty($icd_c) || ($icd_c) <>'()'){
            $icd_c='('.$rs['rf_icd10c'].') - '.$rs['descicdc'];
        }
    }
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
                <table>
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
                        <td width="40%">
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
                            </table>
                        </td>

                        <td width="40%">
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
                            ท่านสามารถติดต่อศูนย์บริหารจัดการส่งต่อผู้ป่วย โรงพยาบาลหาดใหญ่ (HY-RMC) ผ่านทาง LINE Official (สแกนคิวอาร์โค้ด)
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:22px;">
                                โทรศัพท์สายตรง : 074-273-100 ต่อ 2108,5433    Email : refer.hy@hatyaihospital.go.th                        
                        </td>
                    </tr>
                </table>
                </center>
            </td>
        </tr>
        ';
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
                            <barcode code='.$qrb.' type="QR" size="0.9" error="M" class="barcode" disableborder = "1"/>
                        </td>
                        <td width="50%"><barcode code='.$hno.' type="C39" /></td>
                    </tr>
                    <tr>
                        <td style="font-size:17px;padding:70px 0px 0px 5px;">
                                <b>ถึงปลายทาง SCAN รับ</b> 
                        </td>
                        <td style="font-size:24px;padding:-100px 0px 0px 0px;"><center>'.$hno.'</center></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="font-size:28px;padding:15px 0px 0px 0px;text-align:center;font-weight:Bold;">แบบสำหรับส่งต่อผู้ป่วยไปรับการตรวจหรือรักษาต่อ (Referral Information Form)</td>
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
    $mpdf->Output();
?>