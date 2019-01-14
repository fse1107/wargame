<?php
session_start();

if(!empty($_SESSION['login'])){
      $login = "환영합니다. {$_SESSION['login']}님";
} else {
    header("Location: login.php");
}
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
        <script type="text/javascript" src="javascript\script.js"></script>
        <title>Wargame</title>
    </head>
    <body class="bodyb">
        <div style="margin:20px;">
            <span align="left">
                <a class="logo" href="index.php">
                    War Game
                </a>  
            </span>  
            <span align="right">        
                <font style="color:white;">
                    <?=$login;?>
                </font>
            </span>
            <button onclick="logout()">로그아웃</button>
            <button onclick="location.href='mypage.php'">회원정보</button>
        </div>        
        <div align="center" style="align-content: center;">
            <?php
                include 'menu.php';
            ?>
        </div>        
    </body>
</html>
