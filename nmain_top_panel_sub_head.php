<style>
div.img-logo img {
    margin-top: 10px;
    /* margin-bottom: 0px; */
    /* margin-left: 20px; */
    width: 170px;
    height: 160px;
    float: left;
}
   </style>
   <!-- วันที่ปัจจุบัน -->
   <?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>

   <?php
$dward = $_GET['place'];
$pl='';
$sqw="SELECT * FROM places WHERE placecode='$dward' ";
$query=mysqli_query($conn,$sqw);
$rw=mysqli_fetch_array($query);
$pl=$rw['fullplace'];   
?>
   <nav class="navbar navbar-inverse navbar-fixed-top">
       <div class="container-fluid">
          <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                   data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                   <span class="sr-only">Toggle navigation</span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#"></a>
           </div>

           <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav">
                   <li><a href="#">โรงพยาบาลหาดใหญ่ อ.หาดใหญ่ จ.สงขลา 90110 โทร. 074-273100<span class="sr-only">(current)</span></a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                   <li><a href="#"></a></li>
               </ul>
           </div><!-- /.navbar-collapse -->
       </div><!-- /.container-fluid -->
   </nav>