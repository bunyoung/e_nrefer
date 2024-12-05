<html>

<head>
    <title>Server &amp; Local Time</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
    <style type="text/css">
    <!--
    .style1 {
        font-family: "Microsoft Sans Serif", Tahoma
    }
    -->
    </style>
</head>

<body>
    <table width="353" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
        <tr bgcolor="#FFFFFF">
            <td width="105" bgcolor="#FFFFFF"><span class="style1">Server Time </span></td>
            <td width="237" bgcolor="#FFFFFF">
                <span class="style1">
                    <!---------------- Server Time ---------------------->
                    <div id="server_time" style="background-color:#339999">&nbsp;</div>

                    <?php
    $current_server_time = date("Y")."/".date("m")."/".date("d")." ".date("H:i:s");
?>

                    <script language="JavaScript1.2">
                    <!--
                    function server_date(now_time) {
                        current_time1 = new Date(now_time);
                        current_time2 = current_time1.getTime() + 1000;
                        current_time = new Date(current_time2);

                        server_time.innerHTML = current_time.getDate() + "/" + (current_time.getMonth() + 1) + "/" +
                            current_time.getYear() + " " + current_time.getHours() + ":" + current_time.getMinutes() +
                            ":" + current_time.getSeconds();

                        setTimeout("server_date(current_time.getTime())", 1000);
                    }

                    setTimeout("server_date('<?=$current_server_time?>')", 1000);
                    //
                    -->
                    </script>
                    <!---------------- Server Time ---------------------->
                </span>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF"><span class="style1">Local Time </span></td>
            <td>
                <span class="style1">

                    <div id="local_time" style="background-color:#FFCC00">&nbsp;</div>
                    <script language="JavaScript1.2">
                    function local_date(now_time) {
                        current_local_time = new Date();

                        local_time.innerHTML = current_local_time.getDate() + "/" + (current_local_time.getMonth() +
                                1) + "/" + current_local_time.getYear() + " " + current_local_time.getHours() + ":" +
                            current_local_time.getMinutes() + ":" + current_local_time.getSeconds();

                        setTimeout("local_date()", 1000);
                    }

                    setTimeout("local_date()", 1000);
                    </script>
                </span>
            </td>
        </tr>
    </table>

    <center>
        <a href="server_date.php">refresh</a>
    </center>
</body>
</html>