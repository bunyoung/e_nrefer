<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.28.0/tableExport.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.4/dist/bootstrap-table-locale-all.min.js"></script>
</head>

<body>
    <table id="table" data-toolbar="#toolbar" data-search="true" data-show-refresh="true" data-show-toggle="true"
        data-show-fullscreen="true" data-show-columns="true" data-show-columns-toggle-all="true" data-detail-view="true"
        data-show-export="true" data-click-to-select="true" data-detail-formatter="detailFormatter"
        data-minimum-count-columns="2" data-show-pagination-switch="true" data-pagination="true" data-id-field="id"
        data-page-list="[10, 25, 50, 100, all]" data-show-footer="true" data-side-pagination="server" data-url=""
        data-response-handler="responseHandler">
        <thead style=" background-color: buttonface;">
            <tr>
                <th data-field="hn" data-sortable="true" class="text-center  text-black">
                    <font style="color: black;">ลำดับที่</font>
                </th>
            </tr>
        </thead>
    </table>
</body>

</html>