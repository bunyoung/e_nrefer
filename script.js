$(function(){
    var ridObject = $('#rid');
    var rsidObject = $('#rsid');
    var rsdiObject = $('#rsdi');

    // on change rid
    ridObject.on('change', function(){
        var ridid = $(this).val();
        rsidObject.html('<option value="" selected readonly>(เลือกรายการ)</option>');
        rsdiObject.html('<option value="" selected readonly>(เลือกรายการ)</option>');

        $.get('rf_indication_detail.php?m_depid=' + ridid, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                rsidObject.append(
                    $('<option></option>').val(item.id).html(item.indication)
                );
            });
        });
    });

    // on change rsid
    rsidObject.on('change', function(){
        var rsid = $(this).val();

        rsdiObject.html('<option value="" selected readonly>(เลือกรายการ)</option>');
        
        $.get('rf_indication_sub_detail.php?s_mdepid=' + rsid, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                rsdiObject.append(
                    $('<option></option>').val(item.id).html(item.name)
                );
            });
        });
    });
});