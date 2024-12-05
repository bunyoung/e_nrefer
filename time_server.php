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
                </span>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF"><span class="style1">Local Time </span></td>
            <td>
                <span class="style1">
                    <!---------------- Local Time ---------------------->
                    <div id="local_time" style="background-color:#FFCC00">&nbsp;</div>
                    <!---------------- Local Time ---------------------->
                </span>
            </td>
        </tr>
    </table>

    <center>
        <a href="server_date.php">refresh</a>
    </center>
</body>

</html>