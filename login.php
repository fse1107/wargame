<?php
session_start();

//if(!empty($_SESSION['login'])) {
//    
//} else {
//    session_destroy();
//}


?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>        
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css\common.css">             
        <link rel="stylesheet" type="text/css" href="css\login_create_account.css">
        <title>Login</title>
    </head>
    <body class="bodyh">
        <div style="margin:50px;" align="center">
            <a href="login.php" class="logo">
                War game
            </a>
        </div>
        <!--인젝션 공부-->
        <!--<form action="injection_login.php" method="GET">-->
            
        <!--정상코드-->
        <form action="process_login.php" method="POST">
            <div align="center" style="margin: 20pt">
                <input class="text" type="text" name="id" placeholder="ID" maxlength="20">
            </div>
            <div align="center" style="margin:20pt">
                <input class="text" type="password" name="ps" placeholder="PASSWORD" maxlength="30">
            </div>
            <div align="center">
                <input type="submit" class="button" value="Login">
                <input type="button" class="button" value="Add account" onclick="location.href='create_account.php'">
            </div>
        </form>        
    </body>
</html>
