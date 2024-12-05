<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi Select2 Ajax Autocomplete Search Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP MySQLi Select2 Ajax Autocomplete Search Tutorial</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>

<body>
    <div class="row mt-5">
        <div class="form-contol  col-md-3 offset-3 mt-5">
            <div class="card">
                <!-- <div class="card-header bg-primary text-center text-white">
                    <h6 class="m-0">PHP MySQLi Select2 Ajax Autocomplete Search Tutorial</h6>
                </div> -->
                <!-- <div class="card-body" style="height: 100px;"> -->
                <div>
                    <select class="countryList form-control" name="countryList"></select>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $('.countryList').select2({
        placeholder: 'ค้นหาโรงพยาบาล',
        ajax: {
            url: "autocompletePro.php",
            dataType: 'json',
            delay: 250,
            data: function(data) {
                return {
                    searchTerm: data.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    </script>

</body>

</html>