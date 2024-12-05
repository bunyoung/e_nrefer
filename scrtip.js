function fill(Value) {
    $('#hn').val(Value);
    $('#display').hide();
 }
 $(document).ready(function() {
    $("#hn").keyup(function() {
        var name = $('#hn').val();
        if (name == "") {
            $("#display").html("");
        }
        else {
 
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: {
                    hn: name
                },
                success: function(html) {
                    $("#display").html(html).show();
                }
            });
        }
    });
 });