<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
.btn-red {
    background-color: #ff0000;
    color: white;
}

.btn-orange {
    background-color: #ff8c00;
    color: white;
}

.btn-yellow {
    background-color: #FFFF00;
    color: black;
}

.btn-green {
    background-color: #00331a;
    color: white;
}

.btn-skyblue {
    background-color: #87eeeb;
    color: white;
}
</style>
<!-- ทำ Refresh หากไม่มีการเลื่อน Mouse -->
<script>
var time = new Date().getTime();
$(document.body).bind("mousemove keypress", function(e) {
    time = new Date().getTime();
});

function refresh() {
    if (new Date().getTime() - time >= 180000)
        window.location.reload(true);
    else
        setTimeout(refresh, 30000);
}

setTimeout(refresh, 10000);
</script>

<body>

    <div class="col-md-5">
        <div class="panel-heading" style="background:#1976d2;
            color:#bbdefb;font-size: 1.2em;font-weight: bold;">
            <span class=" glyphicon glyphicon-send"></span>
            รายการขอที่รอ Consult
        </div>
        <table class="table-responsive" id="consult_view_all_befor" data-toolbar="#tool-doctor" data-toggle="table"
            data-search="true" data-show-refresh="true" data-pagination="true" data-page-list="[10,50,100]"
            data-page-size="10" data-auto-refresh="true" data-url="js_view_befor.php">
            <thead>
                <tr>
                    <th data-field="cons_id" class="text-center">
                        <font style="color:#ffffff;"> CNS NO </font>
                    </th>
                    <th data-field="an" class="text-left">
                        <font style="color: #ffffff;"> AN </font>
                    </th>
                    <th data-field="pname" class="text-left">
                        <font style="color: #ffffff;"> ชื่อ สกุล </font>
                    </th>
                    <th data-field="sex" class="text-left">
                        <font style="color: #ffffff;"> เพศ </font>
                    </th>
                    <th data-field="age" class="text-left">
                        <font style="color: #ffffff;"> อายุ </font>
                    </th>
                    <th data-field="places" class="text-left">
                        <font style="color: #ffffff;"> Ward </font>
                    </th>
                    <th data-field="beds" class="text-left">
                        <font style="color: #ffffff;"> เตียง </font>
                    </th>
                    <th data-field="date_admit" class="text-left">
                        <font style="color: #ffffff;"> วันที่ Admit </font>
                    </th>
                    <th data-field="pt_types" class="text-left">
                        <font style="color: #ffffff;"> สิทธิ </font>
                    </th>
                    <th data-field="hdep" class="text-left">
                        <font style="color: #ffffff;"> กลุ่มงานหลัก</font>
                    </th>
                    <th data-field="sdep" class="text-left">
                        <font style="color: #ffffff;"> หน่วยงาน </font>
                    </th>
                    <th data-field="a1" class="text-left">
                        <font style="color: #ffffff;"> ประวัติการตรวจร่างกาย </font>
                    </th>
                    <th data-field="a2" class="text-left">
                        <font style="color: #ffffff;"> ห้องปฏิบัติการณ์ </font>
                    </th>
                    <th data-field="a3" class="text-left">
                        <font style="color: #ffffff;"> การรักษา </font>
                    </th>
                    <th data-field="hdoc" class="text-left">
                        <font style="color: #ffffff;"> แพทย์ผู้รักษา</font>
                    </th>
                    <th data-field="fdoc" class="text-left">
                        <font style="color: #ffffff;"> ชื่ออาจารย์แพทย์</font>
                    </th>
                    <th data-field="mdoc" class="text-left">
                        <font style="color: #ffffff;"> แพทย์ยืนยัน </font>
                    </th>
                    <th data-field="exp" class="text-left">
                        <font style="color: #ffffff;"> จุดประสงค์การปรึกษา </font>
                    </th>
                    <th data-field="icda" class="text-left">
                        <font style="color: #ffffff;"> การวินิจฉัย 1 </font>
                    </th>
                    <th data-field="icdb" class="text-left">
                        <font style="color: #ffffff;"> การวินิจฉัย 2 </font>
                    </th>
                    <th data-field="icdc" class="text-left">
                        <font style="color: #ffffff;"> การวินิจฉัย 3 </font>
                    </th>
                    <th data-field="ftext" class="text-left">
                        <font style="color: #ffffff;"> เพิ่มเติม </font>
                    </th>

                    <th data-field="status" class="text-left">
                        <font style="color: #ffffff;"> สถานะ </font>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>

<script type="text/javascript">
$(document).ready(function() {
    var ddate = $('#ddate').val();
    var fan = $('#fan').val();
    var sex = $('#sex').val();
    var age = $('#age').val();
    var places = $('#places').val();
    var n_places = $('#n_places').val();
    var date_admit = $('#date_admit').val();
    var hn = $('#hn').val();
    var n_flname = $('#n_flname').val();
    var pt_type = $('#pt_type').val();
    var n_pt_type = $('#n_pt_type').val();
    var beds = $('#beds').val();
    var hdep = $('#hdep').val();
    var sdep = $('#sdep').val();
    var h_arti_doctor = $('#h_arti_doctor').val();
    var mdoc = $('#mdoc').val();
    var a1 = $('#a1').val();
    var a2 = $('#a1').val();
    var a3 = $('#a1').val();
    var h_arti_doca = $('#h_arti_doca').val();
    var hdoc = $('#hdoc').val();
    var h_arti_docb = $('#h_arti_docb').val();
    var fdoc = $('#fdoc').val();
    var exp = $('#exp').val();
    var show_arti_topic = $('#show_arti_topic').val();
    var h_arti_id = $('#h_arti_id').val();
    var show_arti_topic01 = $('#show_arti_topic01').val();
    var h_arti_id01 = $('#h_arti_id01').val();
    var show_arti_topic02 = $('#show_arti_topic02').val();
    var h_arti_id02 = $('#h_arti_id02').val();
    var ftext = $('#ftext').val();
});

$('#consult_view_all_befor').on('click-row.bs.table', function(e, row, $element, data) {
    // console.log(row);
    $('#modal_consult_view_update').modal('show');

    var cons_id = row.cons_id;
    var an = row.an;
    var hn = row.hn;
    var pname = row.pname;
    var sex = row.sex;
    var age = row.age;
    var places = row.places;
    var beds = row.beds;
    var date_admit = row.date_admit;
    var pt_types = row.pt_types;
    var hdep = row.hdep;
    var sdep = row.sdep;
    var a1 = row.a1;
    var a2 = row.a2;
    var a3 = row.a3;
    var hdoc = row.hdoc;
    var exp = row.exp;
    var fdoc = row.fdoc;
    var icda = row.icda;
    var icdb = row.icdb;
    var icdc = row.icdc;
    var ftext = row.ftext;
    var mdoc = row.mdoc;
    var status = row.status;

    $('#mo-cons_id').val(cons_id);
    $('#mo-an').val(an);
    $('#mo-hn').val(hn);
    $('#mo-flname').val(pname);
    $('#mo-sex').val(sex);
    $('#mo-age').val(age);
    $('#mo-places').val(places);
    $('#mo-beds').val(beds);
    $('#mo-pt_types').val(pt_types);
    $('#mo-hdep').val(hdep);
    $('#mo-sdep').val(sdep);
    $('#mo-date_admit').val(date_admit);
    $('#mo-a1').val(a1);
    $('#mo-a2').val(a2);
    $('#mo-a3').val(a3);
    $('#mo-hdoc').val(hdoc);
    $('#mo-exp').val(exp);
    $('#mo-fdoc').val(fdoc);
    $('#mo-icda').val(icda);
    $('#mo-icdb').val(icdb);
    $('#mo-icdc').val(icdc);
    $('#mo-ftext').val(ftext);
    $('#mo-mdoc').val(mdoc);
    $('#mo-status').val(status);

});
</script>