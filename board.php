<?php
session_start();

if(!empty($_SESSION['login'])){
      $login = "환영합니다. {$_SESSION['login']}님";
} else {
    header("Location: login.php");
}

include 'db_info.php';



$sql = "SELECT @rownum := @rownum+1 AS num, id, title, login, writeday, read_num FROM board_data, (SELECT @rownum := 0) AS R ORDER BY writeday ASC;";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)){    
    
    $board .= "<tr style=\"border-bottom:1px solid white; cursor:pointer\" onmouseover=\"this.style.background='gray'\" onmouseout=\"this.style.background='black'\" onclick=\"location.href='board_view.php?index={$row['id']}'\">"
                . "<td class='t_num'><font color='white'>{$row['num']}</font></td>"
                . "<td class='t_title'><font color='white'>{$row['title']}</font></td>"
                . "<td class='t_writer'><font color='white'>{$row['login']}</font></td>"
                . "<td class='t_date'><font color='white'>{$row['writeday']}</font></td>"
                . "<td class='t_views'><font color='white'>{$row['read_num']}</font></td>"
            . "</tr>";    
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
        <link rel="stylesheet" type="text/css" href="css\board.css">
        <script type="text/javascript" src="javascript\script.js"></script>
        <title>board</title>
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
                    <?=$_SESSION['login'];?>
                </font>
            </span>
            <button onclick="logout()">로그아웃</button>
            <button onclick="location.href='mypage.php'">회원정보</button>
        </div>
        <div align="center" style="align-content: center;">
            <?php
//            메뉴
                include 'menu.php';
            ?>
        </div>
        <div style="margin:40px;" align="center">
            <font class="title">자유게시판</font>
        </div>
        <div align="center">         
            <table style="border:1px solid white;">
                <tbody>
                    <tr>
                        <td class="t_num"><font color="white">번호</font></td>
                        <td class="t_title"><font color="white">제목</font></td>
                        <td class="t_writer"><font color="white">글쓴이</font></td>
                        <td class="t_date"><font color="white">날짜</font></td>
                        <td class="t_views"><font color="white">조회수</font></td>
                    </tr>                              
                    <?=$board?>                
                </tbody>
            </table>
<!--            <span style="border-bottom:1px solid white;">
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>          
                </span>
                <span style="display:inline-block; width:40px; height:30px; text-align:center;">
                    <font color="white">번호</font>   
                </span>
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>     
                </span>
                <span style="display:inline-block; width:360px; height:30px; text-align:center;">
                    <font color="white">제목</font>    
                </span>
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>
                </span>
                <span style="display:inline-block; width:80px; height:30px; text-align:center;">
                    <font color="white">글쓴이</font>      
                </span>
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>            
                </span>
                <span style="display:inline-block; width:80px; height:30px; text-align:center;">
                    <font color="white">날짜</font>        
                </span>
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>          
                </span>
                <span style="display:inline-block; width:80px; height:30px; text-align:center;">
                    <font color="white">조회수</font>
                </span>     
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>          
                </span>
            </span>-->
        </div>
<!--        <div align="center" style="cursor: pointer;">
            <span style="border-bottom:1px solid white;" onmouseover="this.style.background='gray'" onmouseout="this.style.background='black'" onclick="locathon.href='view.php'">
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>          
                </span>
                <span style="display:inline-block; width:40px; height:30px; text-align:center;">
                    <font color="white">번호</font>   
                </span>
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>     
                </span>
                <span style="display:inline-block; width:360px; height:30px; text-align:center;">
                    <font color="white">제목</font>    
                </span>
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>
                </span>
                <span style="display:inline-block; width:80px; height:30px; text-align:center;">
                    <font color="white">글쓴이</font>      
                </span>
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>            
                </span>
                <span style="display:inline-block; width:80px; height:30px; text-align:center;">
                    <font color="white">날짜</font>        
                </span>
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>          
                </span>
                <span style="display:inline-block; width:80px; height:30px; text-align:center;">
                    <font color="white">조회수</font>
                </span> 
                <span style="display:inline-block; width:2px; height:30px; text-align:center;">
                    <font color="white">|</font>          
                </span>
            </span>
        </div>-->
        <div>
            
        </div>
        <div align="right">
            <span>
                <button onclick="location.href='board_create.php'">쓰기</button>
                <button onclick="location.href='index.php'">뒤로</button>
            </span>
        </div>
    </body>
</html><!--

<!--<tr align="center" onmouseover="this.style.background='gray'" onmouseout="this.style.background='black'" onclick="location.href='view.php?no=2175'">
게시물 번호
    <td width="30"><font color="white">2175</font></td> 
    <td><font color="white">secret</font></td>
    게시자
    <td width="100"><font color="white">hound45</font></td>
    제목
    <td width="500"><font color="white">lllklklkl &nbsp;&nbsp;<font size="2"><font color="yellow">1</font></font></font></td>
    작성날짜
    <td><font color="white">2018-11-12 21:58:36</font></td>
</tr>-->