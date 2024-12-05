        <div class="row" style="background-color: #1A237E; margin-left: 10px;color:#82B1FF">
            <div class="col-sm-5" style="margin-top:10px;">
                ผู้ใช้ระบบงาน (Origin)
                <?php echo '['.$_SESSION['hcode'].']  '.$_SESSION["hosname"];?>
                :: <i class="fa fa-calendar" aria-hidden="true" style="color:#EA80FC"></i>
                ประจำวันที่ : <?php echo $d_default; ?>
                <i class="fa fa-database" aria-hidden="true"></i>
                <?php echo ':: '.$hsd;?>
            </div>
            <div class="col-sm-6">
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                style="color:#ffff;font-family:sarabun;">
                                <?php 
                                        if($hsp=='' || $hsd=='' || $hsu=='' || $hsip==''){
                                            echo '<i class="fa fa-hospital-o" aria-hidden="true" style="color:#C2185B;"></i>';
                                        }else{
                                            echo '<i class="fa fa-hospital-o" aria-hidden="true" style="color:#64DD17;"></i>';
                                        }
                                        ?>
                                ทะเบียนสถานพยาบาล
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="font-family:sarabun;font-size:16px;background-color:#E1BEE7; 
                                                margin-top:6px;margin:auto;">
                                <li>
                                    <a href="#hisModalPassword" data-toggle="modal"></i>
                                        <i class="fa fa-minus-square" aria-hidden="true"></i> 1. เปลี่ยนรหัสผ่าน
                                    </a>
                                </li>
                                <li>
                                    <a href="#hisModalCenter" data-toggle="modal"></i>
                                        <i class="fa fa-minus-square" aria-hidden="true"></i> 2. ส่วนการเชื่อมต่อ HIs
                                    </a>
                                </li>
                                <li>
                                    <a href="#hisModaluse" data-toggle="modal"></i>
                                        <i class="fa fa-minus-square" aria-hidden="true"></i> 3. ข้อมูลการใช้งาน
                                    </a>
                                </li>
                                <li>
                                    <a href="#exampleModalCenter" data-toggle="modal"> </i>
                                        <i class="fa fa-minus-square" aria-hidden="true"></i> 4. ทะเบียนสถานพยาบาล
                                    </a>
                                </li>

                                <!-- <li><a href="sys_hycall_hospital_idea.php"></i>
                                    <i class="fa fa-minus-square" aria-hidden="true"></i> 5. ข้อเสนอแนะการพัฒนา</a>
                            </li> -->
                            </ul>
                        </li>

                        <!-- ตั้งค่าระบบ -->
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog" style="color:#64DD17;"></i>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" style="font-family:sarabun;background-color:#E1BEE7; 
                                                margin-top:6px;margin:auto;">
                                <li>
                                    <a href="#hisModalCenter" data-toggle="modal">
                                        <i class="fa fa-minus-square" aria-hidden="true"></i> 1. เพิ่มชื่อแพทย์ผู้ส่งต่อ
                                    </a>
                                </li>
                                <li>
                                    <a href="#hisModaluse" data-toggle="modal">
                                        <i class="fa fa-minus-square" aria-hidden="true"></i> 2. เพิ่มแพทย์เจ้าของไช้
                                    </a>
                                </li>
                                <li> <a href="#exampleModalCenter" data-toggle="modal">
                                        <i class="fa fa-minus-square" aria-hidden="true"></i> 3. เพิ่มกลุ่มงานที่ส่งต่อ
                                    </a>
                                </li>
                                <!-- <li><a href="sys_hycall_hospital_idea.php">
                                    4. ข้อเสนอแนะการพัฒนา</a></li> -->
                            </ul>
                        </li>

                        <li>
                            <a class="text text-metis-4 btn-grad" href="sys_refer_logout.php"
                                style="color:#64DD17;font-size:18px;">
                                <i class="fa fa-unlock fa-lg"> </i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>