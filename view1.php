<div id="tool-table1">
    <select   class="form-control" id="s-ward">
        <option value="all">ทุกหอผู้ป่วย</option>
            <?php
                include '../../configs/connect_web_cc.php';
                $sql="
                    select DISTINCT d.ward,d.ward_code
                    from drop_in_swab d 
                    where  d.del_flag != 'Y'   
                    GROUP BY d.ward
                    order by d.ward desc   
                ";
                mysql_query("SET NAMES UTF8");
                $query = mysql_query($sql);
                $data = array();
                $i=1;
                while($rs = mysql_fetch_array($query)) {
                    $option = '<option value="'.$rs['ward_code'].'">'.$rs['ward'].'</option>';
                    echo ($option);
                }
            ?>
    </select>
</div>
<p>
<table class="table table-striped" id="table1"   
        data-auto-refresh="true"
        data-show-refresh="ture"
        data-toolbar="#tool-table1"   
        data-toggle="table"
        data-show-print="false" 
        data-sort-order="asc"
        data-search="true"
        data-show-pagination-switch="true"
        data-pagination="true"
        data-page-list="[10, 25, 50, 100, ALL]"
        data-page-size="10"
        data-show-footer="false"
        data-side-pagination="client"
        data-show-export="false"
        data-export-types="['excel', 'pdf']"
        data-export-options='{
          "fileName": "tableExport",
          "worksheetName": "tableExport",
          "htmlContent" : "true",
          "jspdf": {
            "autotable": {
              "startY": 20,
              "bodyStyles": {"valign": "top"},
              "styles": {"overflow": "linebreak", "rowHeight": 20, "fontSize": 10, "font": "Tahoma"},
              "headerStyles": {"fillColor": [41, 128, 185]},
              "tableWidth": "wrap"
            }
          }
        }'
        data-click-to-select="true"
        data-url="data-all.php?ward=all">

    <thead>
    <tr>
        <th data-field="date_created" data-sortable="true" >Date Created</th>
        <th data-field="cid" data-sortable="true" >ID Card</th>
        <th data-field="passport" data-sortable="true" >Passport</th>
        <th data-field="hn" data-sortable="true" >HN</th>
        <th data-field="flname" data-sortable="true" >Name</th>
        <th data-field="age" data-sortable="true" data-align="left" >Age.</th>
        <th data-field="mobile" data-sortable="true" data-align="left" >Mobile</th>
        <th data-field="other" data-sortable="true" >Detail</th>
        <th data-field="lab_result" data-sortable="true" >Result</th>
        <th data-field="user_created" data-sortable="true" >User Created</th>
        <th data-field="appr" class="text-center">Appr.</th>
        <th data-field="print" class="text-center">Stiker</th>
        <th data-field="del" class="text-center">Delete</th>

    </tr>
    </thead>
</table>