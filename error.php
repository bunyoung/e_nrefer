<!DOCTYPE html>
<?php
$page=basename($_SERVER['PHP_SELF']);
	if (file_exists('_couter/'.$page.'.txt')) 
	{
		$fil = fopen('_couter/'.$page.'.txt', "r");
		$dat = fread($fil, filesize('_couter/'.$page.'.txt')); 
		#echo $dat+1;
		fclose($fil);
		$fil = fopen('_couter/'.$page.'.txt', "w");
		fwrite($fil, $dat+1);
	}

	else
	{
		$fil = fopen('_couter/'.$page.'.txt', "w");
		fwrite($fil, 1);
		#echo '1';
		fclose($fil);
	}
#read number	

$myFile = "_couter/".$page.".txt";
$lines = file($myFile);//file in to an array
$count= $lines[0]; //line 2
?>
<head>
<?php     
	include ("main_script.php")
?>  
<link rel="stylesheet" href="old_assets/css/style.default.css" type="text/css" />
<script type="text/javascript" src="old_assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="old_assets/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript">
function coolRedirect(url, msg)
{
   var TARG_ID = "COOL_REDIRECT";
   var DEF_MSG = "<div class='text-center'><a  class='label label-danger' href='#login' data-toggle='tab' >ระบบกำลังพากลับไปหน้า LOGIN ใหม่อีกครั้ง</a></div>"; // ตั้งรูปแบบของตัวอักษรตอนบอกว่ากำลัง REDIRECT หน้าอยู่

   if( ! msg )
   {
      msg = DEF_MSG;
   }

   if( ! url )
   {
      throw new Error('You didn\'t include the "url" parameter');
   }


   var e = document.getElementById(TARG_ID);

   if( ! e )
   {
      throw new Error('"COOL_REDIRECT" element id not found');
   }

   var cTicks = parseInt(e.innerHTML);

   var timer = setInterval(function()
   {
      if( cTicks )
      {
         e.innerHTML = --cTicks;
      }
      else
      {
         clearInterval(timer);
         document.body.innerHTML = msg;
         location = url;	  
      }

   }, 500);
}
</script>
</head>

<body  class="bgimage bg-noisy_grid" alt="noisy_grid"  onload="coolRedirect('dashboard.php')">

<div class="loginwrapper">
  <div class="loginwrap zindex100 animate2 bounceInDown">
    <h1 class="logintitle"><span class="iconfa-warning-sign"></span> <strong><font color="#ff1117">ERROR</font></strong> <span class="subtitle"><font color="#ff1117">ไม่สามารถเข้าใช้งานระบบได้</font></span></h1>
    <div class="loginwrapperinner"> 
      <!-- <form id="loginform" action="" method="post"> -->
      <p class="animate4 bounceIn"></p>
      <p class="animate5 bounceIn"><font size="4" color="#ffffff">
        <center>
          บัญชีผู้ใช้ / รหัสผ่าน ไม่ถูกต้อง
        </center>
        </font></p>
      <p class="animate5 bounceIn"></p>
      <p class="animate5 bounceIn"><font size="4" color="#ffffff">
        <center>
          กรุณาตรวจสอบอีกครั้ง
        </center>
        </font></p>
      <p class="animate5 bounceIn"></p>
      <p></p>
      <p></p>
      <p class="animate5 bounceIn">
      <center>
        <div class="counter" id="COOL_REDIRECT">5</div>
      </center>
      </p>
      
      <!-- <p class="animate7 fadeIn"><a href=""><span class="icon-question-sign icon-white"></span> Forgot Password?</a></p> --> 
      <!-- </form> --> 
    </div>
    <!--loginwrapperinner--> 
  </div>
  <div class="loginshadow animate3 fadeInUp"></div>
</div>

<!--loginwrapper--> 

<script type="text/javascript">
jQuery.noConflict();

jQuery(document).ready(function(){
	
	var anievent = (jQuery.browser.webkit)? 'webkitAnimationEnd' : 'animationend';
	jQuery('.loginwrap').bind(anievent,function(){
		jQuery(this).removeClass('animate2 bounceInDown');
	});
	
	jQuery('#username,#password').focus(function(){
		if(jQuery(this).hasClass('error')) jQuery(this).removeClass('error');
	});
	
	jQuery('#loginform button').click(function(){
		if(!jQuery.browser.msie) {
			if(jQuery('#username').val() == '' || jQuery('#password').val() == '') {
				if(jQuery('#username').val() == '') jQuery('#username').addClass('error'); else jQuery('#username').removeClass('error');
				if(jQuery('#password').val() == '') jQuery('#password').addClass('error'); else jQuery('#password').removeClass('error');
				jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent,function(){
					jQuery(this).removeClass('animate0 wobble');
				});
			} else {
				jQuery('.loginwrapper').addClass('animate0 fadeOutUp').bind(anievent,function(){
					jQuery('#loginform').submit();
				});
			}
			return false;
		}
	});
});
</script>
</body>

</html>