<?php
require_once('main_script.php');
?>
<script type="text/javascript">
  $('#hyass').change(function() {
    var id_hass = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_hass,function:'hyass'},
      success: function(data){
          $('#fast_sick').html(data);
      }
    });
  });

  $('#fast_sick').change(function() {
    var id_fast = $(this).val();

      $.ajax({
      type: "POST",
      url: "ajax_db.php",
      data: {id:id_fast,function:'fast_sick'},
      success: function(data){
          $('#districts').html(data);
      }
    });
  });
