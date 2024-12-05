<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <!-- <link rel="stylesheet" href="styles.css" /> -->
</head>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: Roboto;
    background-repeat: no-repeat;
    background-size: cover;
    background: linear-gradient(120deg, #E0F7FA, #4DD0E1);
    height: 120vh;
    overflow: hidden;
}

.center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20vw;
    background: white;
    border-radius: 10px;
}

.center h1 {
    text-align: center;
    padding: 0 0 20px 0;
    border-bottom: 1px solid silver;
}

.center form {
    padding: 0 40px;
    box-sizing: border-box;
}

form .txt_field {
    position: relative;
    border-bottom: 2px solid #adadad;
    margin: 30px 0;
}

.txt_field input {
    width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
}

.txt_field label {
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
}

.txt_field span::before {
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 0px;
    height: 2px;
    background: #2691d9;
    transition: .5s;
}

.txt_field input:focus~label,
.txt_field input:valid~label {
    top: -5px;
    color: #2691d9;
}

.txt_field input:focus~span::before,
.txt_field input:Valid~span::before {
    width: 100%;
}

.pass {
    margin: -5px 0 20px 5px;
    color: #a6a6a6;
    cursor: pointer;
}

.pass:hover {
    text-decoration: underline;
}

input[type="Submit"] {
    width: 100%;
    height: 50px;
    border: 1px solid;
    border-radius: 25px;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;

}

input[type="Submit"]:hover {
    background: #2691d9;
    color: #e9f4fb;
    transition: .5s;
}

input[type="Cancel"] {
    width: 100%;
    height: 50px;
    border: 1px solid;
    border-radius: 25px;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;

}

.signup_link a {
    color: #2691d9;
    text-decoration: none;
}

.signup_link a:hover {
    text-decoration: underline;
}

.HomeAbout {
    width: 100vw;
    height: 35vh;
}
</style>

<body>
    <div class="container">
        <div class="center">
            <p>
                <center>
                    <img src="./img/login.png" alt="" srcset="" style="width: 100px; height: 100px;">
                </center>
            </p>
            <p>
            <h1>Login Referral </h1>
            </p>
            <form action="sys_refer_authen.php" method="POST">
                <div class="txt_field">
                    <input type="text" name="username" required>
                    <span></span>
                    <label>Username</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" required>
                    <span></span>
                    <label>Password</label>
                </div>
                <input type="hidden" id="show_ip" name="page" value="<?php  echo $page; ?>" />
                <input type="hidden" id="show_ip" name="show_ip" value="<?php echo $show_ip; ?>" />
                <input type="hidden" id="user_os" name="user_os" value="<?php  echo $user_os; ?>" />
                <input type="hidden" id="user_browser" name="user_browser"
                    value="<?php echo $user_browser; ?>" />&nbsp;&nbsp;
                <input name="submit" type="Submit" value="Login">
                <div class="signup_link"> </div>
                <p></p>
            </form>
        </div>
    </div>
</body>

</html>