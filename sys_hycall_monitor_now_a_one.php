<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-nRefer</title>
    <!-- bootstrap-table -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap-table.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../assets/css/bootstrap-multiselect.min.css" />
    <link rel="stylesheet" href="../../assets/css/jquery.datetimepicker.css" />
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="../../assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="../../assets/css/jquery.gritter.min.css" />
    <link rel="stylesheet" href="../../assets/css/colorbox.min.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="../../assets/css/ace.min.css" />
    <link rel="stylesheet" href="../../assets/css/select2.min.css" />

    <!-----  กำหนดขนาดของ font ทั้งหน้าเว็บ ----->
    <link rel="stylesheet" href="../../assets/css/fullcalendar.min.css">
    <link rel="stylesheet" href="../../assets/css/style1.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap-select.css" />
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree&amp;display=swap" rel="stylesheet">
</head>
<?php include('main_script.php'); ?>
<style type="text/css">
body {
    font-family: 'Bai Jamjuree', sans-serif;
    font-weight: 600;
}

#calendar {
    max-width: 700px;
    margin: 0 auto;
    font-size: 16px;
}

tr.custom--success td {
    background-color: #ccffcc !important;
    /*custom color here*/
}

tr.custom--success-regis td {
    background-color: #3399ff !important;
    /*custom color here*/
}

.table-hover tbody tr:hover>td {
    cursor: pointer;
}

.word-wrap {
    word-break: break-all;

}

.bg-navbar {
    color: #FFFFFF;
    background-color: #585f66;
}

.menu-icon {
    background-color: #000000;
}

#toTop {
    position: fixed;
    bottom: 10px;
    right: 10px;
    cursor: pointer;
    display: none;
}

.a {
    font-size: 16px;

}

.h1-responsive {
    font-size: 250%
}

.h2-responsive {
    font-size: 145%;
    /*font-family:  monospace;*/
}

.h3-responsive {
    font-size: 135%
}

.h4-responsive {
    font-size: 115%
}

.h5-responsive {
    font-size: 100%
}

@media (min-width: 576px) {
    .h1-responsive {
        font-size: 170%
    }

    .h2-responsive {
        font-size: 140%
    }

    .h3-responsive {
        font-size: 125%
    }

    .h4-responsive {
        font-size: 100%
    }

    .h5-responsive {
        font-size: 90%
    }

    img {
        max-width: 20%;
    }
}

@media (min-width: 768px) {
    .h1-responsive {
        font-size: 200%
    }

    .h2-responsive {
        font-size: 170%
    }

    .h3-responsive {
        font-size: 140%
    }

    .h4-responsive {
        font-size: 125%
    }

    .h5-responsive {
        font-size: 100%
    }

    img {
        max-width: 50%;
    }
}

@media (min-width: 992px) {
    .h1-responsive {
        font-size: 200%
    }

    .h2-responsive {
        font-size: 170%
    }

    .h3-responsive {
        font-size: 140%
    }

    .h4-responsive {
        font-size: 125%
    }

    .h5-responsive {
        font-size: 100%
    }

    img {
        max-width: 50%;
    }
}

@media (min-width: 1200px) {
    .h1-responsive {
        font-size: 250%
    }

    .h2-responsive {
        font-size: 200%
    }

    .h3-responsive {
        font-size: 170%
    }

    .h4-responsive {
        font-size: 140%
    }

    .h5-responsive {
        font-size: 125%
    }

    img {
        max-width: 100%;
    }
}

.word-wrap {
    word-break: break-all;

}

.bg-navbar {
    color: #FFFFFF;
    background-color: #585f66;
}

.menu-icon {
    background-color: #000000;
}

#toTop {
    position: fixed;
    bottom: 10px;
    right: 10px;
    cursor: pointer;
    display: none;
}
</style>
<?php include('./db/connection.php'); ?>

<body>
    <?php include('main_top_panel_head.php'); ?>
    <div class="container-fluid">
        <table id="" class="table table-sm table-bordered table-hover" data-toolbar="#tool-search" data-toggle="table"
            data-search="true" data-show-refresh="true" data-pagination="true" data-page-list="[10,50,100]"
            data-page-size="10" data-auto-refresh="false" data-row-style="cellStyle" data-url="monitor_now_a.php">
            <thead>
                <tr>
                    <th data-field="no" data-sortable="true" class="text-center">
                        <font style="color: black;"> NO</font>
                    </th>
                    <th data-field="rf_no_refer" data-sortable="true" class="text-center">
                        <font style="color: black;"> NO Refer </font>
                    </th>
                    <th data-field="rf_date" data-sortable="true" class="text-center">
                        <font style="color: black;"> Refer Date </font>
                    </th>
                    <th data-field="rf_time" data-sortable="true" class="text-center">
                        <font style="color: black;"> Time </font>
                    </th>
                    <th data-field="rfchar" data-sortable="true" class="text-center">
                        <font style="color: black;"> Refer<br>type </font>
                    </th>
                    <th data-field="rffast" data-sortable="true" class="text-center">
                        <font style="color: black;"> Piority</font>
                    </th>
                    <th data-field="rf_placename" data-sortable="true" class="text-center">
                        <font style="color: black;"> Service <br> Unit</font>
                    </th>
                    <th data-field="rf_hn" data-sortable="true" class="text-center">
                        <font style="color: black;"> HN </font>
                    </th>
                    <th data-field="rf_patients" data-sortable="true" class="text-center">
                        <font style="color: black;"> Name surname </font>
                    </th>
                    <th data-field="rf_sex" data-sortable="true" class="text-center">
                        <font style="color: black;"> Sex</font>
                    </th>
                    <th data-field="rf_age" data-sortable="true" class="text-center">
                        <font style="color: black;"> Age</font>
                    </th>
                    <th data-field="pttypename" data-sortable="true" class="text-center">
                        <font style="color: black;"> Mididcal <br>Right</font>
                    </th>
                    <th data-field="hossendto_name" data-sortable="true" class="text-center">
                        <font style="color: black;">Destination</font>
                    </th>
                    <th data-field="docsend_prename" data-sortable="true" class="text-center">
                        <font style="color: black;"> Doctor</font>
                    </th>
                    <th data-field="m_depname" data-sortable="true" class="text-center">
                        <font style="color: black;"> Department</font>
                    </th>
                    <th data-field="mark" data-sortable="true" class="text-center">
                        <font style="color: black;"> Status</font>
                    </th>
                    <th data-field="edit" data-sortable="true" class="text-center">
                        <font style="color: black;"> Edit</font>
                    </th>
                    <th data-field="del" data-sortable="true" class="text-center">
                        <font style="color: black;">Delete</font>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</body>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<!--- alert ----->
<script src="../../assets/js/bootbox.js"></script>

<!-- nitiy -->
<script src="../../assets/js/notify.js"></script>

<script src="../../assets/js/bootstrap-timepicker.min.js"></script>
<script src="../../assets/js/moment.min.js"></script>
<script src="../../assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../../assets/js/jquery.knob.min.js"></script>
<script src="../../assets/js/autosize.min.js"></script>
<script src="../../assets/js/jquery.inputlimiter.min.js"></script>
<script src="../../assets/js/jquery.maskedinput.min.js"></script>
<script src="../../assets/js/bootstrap-tag.min.js"></script>
<script src="../../assets/bootstrap-table/src/bootstrap-table.js"></script>
<script src="../../assets/js/clipboard.min.js"></script>

<!-- ace scripts -->
<script src="../../assets/js/ace-elements.min.js"></script>
<script src="../../assets/js/ace.min.js"></script>

<script src="../../assets/js/select2.js"></script>


<!--Autocomplate -->
<script type="text/javascript" src="../../assets/js/autocomplete.js"></script>
<script src="../../assets/js/bootstrap-select.js"></script>

<!--Auto refresh -->
<script type="text/javascript" src="../../assets/js/bootstrap-table.min.js"></script>
<script type="text/javascript" src="../../assets/js/bootstrap-table-auto-refresh.min.js"></script>


<script type="text/javascript" src="../../assets/js/highcharts.js"></script>
<script type="text/javascript" src="../../assets/js/series-label.js"></script>
<script type="text/javascript" src="../../assets/js/exporting.js"></script>
<script type="text/javascript" src="../../assets/js/export-data.js"></script>
<script type="text/javascript" src="../../assets/js/accessibility.js"></script>

</html>