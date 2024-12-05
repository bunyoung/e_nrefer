<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css" />
    <style type="text/css">
    html,body {   
        padding: 0;   
        margin: 0;   
        width: 100%;   
        height: 100%;             
    }   
    #overlay {   
        position: absolute;  
        top: 0px;   
        left: 0px;  
        background: #ccc;   
        width: 100%;   
        height: 100%;   
        opacity: .85;   
        filter: alpha(opacity=75);   
        /* -moz-opacity: .75;   */
        z-index: 999;  
        background: #fff url(http://i.imgur.com/KUJoe.gif) 50% 50% no-repeat;
    }   
    .main-contain{
        position: absolute;  
        top: 0px;   
        left: 0px;  
        width: 100%;   
        height: 100%;   
        overflow: hidden;
    }
    </style>
</head>
<body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
<script type="text/javascript">
$(function(){
    $("#overlay").fadeOut();
    $(".main-contain").removeClass("main-contain");
});
</script>    
     
</body>
</html>