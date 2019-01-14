<?php
session_start();

if(!empty($_SESSION['login'])){
      $login = "환영합니다. {$_SESSION['login']}님";
} else {
    header("Location: login.php");
}

include 'db_info.php';


$sql = "SELECT title, up_file, content FROM board_data WHERE id={$_GET['index']}";        
$result=mysqli_query($conn, $sql);

echo $sql;
       
if($result === FALSE){
    echo '<script>if(!alert("데이터베이스에 문제가 생겼습니다. 관리자에게 문의해주세요.")) document.location = "http://localhost/wargame/board.php";</script>';
    error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
} else {    
    $row = mysqli_fetch_array($result); 
    
    $filtered = array(
    'title'=> $row['title'],
    'up_file'=> $row['up_file'],
    'content'=> $row['content']
    );
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
        <link rel="stylesheet" type="text/css" href="css\board_create.css">
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
            <form action="process_board_modify.php?index=<?=$_GET['index']?>" method="POST">
                <table style="border:1px solid white;">
                    <tbody>
                        <tr>
                            <td class="common1"><font color="white">제목</td>                        
                            <td class="common2"><input type="text" style="width:98%;" name="title" value="<?=$filtered['title']?>"></td>
                        </tr>                  
                        <tr>
                            <td class="common1"><font color="white">파일업로드</td>
                            <td class="common2"><input type='file' style="width:98%;" name='myfile' value="<?=$filtered['up_file']?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="content_title"><font color="white">내용</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="content"><textarea style="width:95%; height:90%;"name='content'><?=$filtered['content']?></textarea></td>
                        </tr>               
                    </tbody>
                </table>                
                <div align="center">
                    <input type="submit" value="수정">                                     
                    <input type="button" class="button" value="취소" onclick="location.href='board_view.php?index=<?=$_GET['index']?>'">
                    <input type="button" class="button" value="목록" onclick="location.href='board.php'">
                </div>
            </form>             
        </div>
        <div>
            
        </div>
        <div align="right">
            <span>
                             
            </span>
        </div>
    </body>
</html>