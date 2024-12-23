<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <script src="./nstylejs.js"></script>
  <link rel="stylesheet" href="./nstyle.css">
</head>
<?php
include('main_script.php');
?>

<body>
    <section style="background:#efefe9;">
        <div class="container-fluid">
            <div class="row">
                <div class="board">
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="myTab">
                            <!-- <div class="liner"></div> -->
                            <li class="active">
                                <a href="#home" data-toggle="tab" title="welcome">
                                    <span class="round-tabs one">
                                        <i class="glyphicon glyphicon-home"></i>
                                    </span>
                                </a>
                            </li>

                            <li><a href="#profile" data-toggle="tab" title="profile">
                                    <span class="round-tabs two">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                </a>
                            </li>
                            <li><a href="#messages" data-toggle="tab" title="bootsnipp goodies">
                                    <span class="round-tabs three">
                                        <i class="glyphicon glyphicon-gift"></i>
                                    </span> </a>
                            </li>

                            <li><a href="#settings" data-toggle="tab" title="blah blah">
                                    <span class="round-tabs four">
                                        <i class="glyphicon glyphicon-comment"></i>
                                    </span>
                                </a></li>

                            <li><a href="#doner" data-toggle="tab" title="completed">
                                    <span class="round-tabs five">
                                        <i class="glyphicon glyphicon-ok"></i>
                                    </span> </a>
                            </li>

                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home">

                            <h3 class="head text-center">Welcome to Bootsnipp<sup>™</sup> <span
                                    style="color:#f48260;">♥</span></h3>
                            <p class="narrow text-center">
                                Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis
                                tincidunt
                                ut, utinam saperet facilisi an vim.
                            </p>

                            <p class="text-center">
                                <a href="" class="btn btn-success btn-outline-rounded green"> start using bootsnipp
                                    <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <h3 class="head text-center">Create a Bootsnipp<sup>™</sup> Profile</h3>
                            <p class="narrow text-center">
                                Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis
                                tincidunt
                                ut, utinam saperet facilisi an vim.
                            </p>

                            <p class="text-center">
                                <a href="" class="btn btn-success btn-outline-rounded green"> create your profile <span
                                        style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>
                            </p>

                        </div>
                        <div class="tab-pane fade" id="messages">
                            <h3 class="head text-center">Bootsnipp goodies</h3>
                            <p class="narrow text-center">
                                Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis
                                tincidunt
                                ut, utinam saperet facilisi an vim.
                            </p>

                            <p class="text-center">
                                <a href="" class="btn btn-success btn-outline-rounded green"> start using bootsnipp
                                    <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="settings">
                            <h3 class="head text-center">Drop comments!</h3>
                            <p class="narrow text-center">
                                Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis
                                tincidunt
                                ut, utinam saperet facilisi an vim.
                            </p>

                            <p class="text-center">
                                <a href="" class="btn btn-success btn-outline-rounded green"> start using bootsnipp
                                    <span style="margin-left:10px;" class="glyphicon glyphicon-send"></span></a>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="doner">
                            <div class="text-center">
                                <i class="img-intro icon-checkmark-circle"></i>
                            </div>
                            <h3 class="head text-center">thanks for staying tuned! <span style="color:#f48260;">♥</span>
                                Bootstrap</h3>
                            <p class="narrow text-center">
                                Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis
                                tincidunt
                                ut, utinam saperet facilisi an vim.
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</body>

</html>