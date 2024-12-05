<meta http-equiv="refresh" content="200;URL=sys_hycall_tbdetail.php">
<script src="assets/js/bootstrap.min.js"></script>
<link href="css/style.css" rel="stylesheet">
<style>
@import url('https://fonts.googleapis.com/css2?family=Fahkwang:wght@300;400;600&family=Montserrat:ital,wght@0,100;0,200;0,300;1,200&display=swap');

.scGridLabelFont3 {
    font-family: 'Fahkwang', sans-serif;
    font-size: 28px;
    color: #dfdfff;
    padding: 2px 4px;
}
</style>
<?php
   require_once("db/connection.php");
   require_once("db/connect_pmk.php");
?>
<tbody>

</tbody>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url: 'call_data_pmk_place.php',
            type: 'get',
            dataType: 'json',
            success: function(response){
                var len= response.length;
                for(var i=0;i<len;i++){
                    var bedno  = response[i].bedno;
                    var hn  = response[i].hn;
                    var an  = response[i].an;

                    var tr_str = "<tr>"+
                        "<td>"+ bedno +"</td>"+ 
                        "<td>"+ hn +"</td>"+ 
                        "<td>"+ an +"</td>";
                    $('#userTable tbody').append(tr_str);    
                }
            }
        });
    });
</script>