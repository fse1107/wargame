<?php
session_start();

if(!empty($_SESSION['login'])){
      $login = "환영합니다. {$_SESSION['login']}님";
} else {
    header("Location: login.php");
}

include 'db_info.php';

$sql = "UPDATE board_data SET read_num=read_num+1 WHERE id={$_GET['index']}";
mysqli_query($conn, $sql);

$sql = "SELECT * FROM board_data WHERE id={$_GET['index']}";
$result = mysqli_query($conn, $sql);
       
if($result === FALSE){
    echo '<script>if(!alert("데이터베이스에 문제가 생겼습니다. 관리자에게 문의해주세요.")) document.location = "http://localhost/wargame/board.php";</script>';
    error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
} else {
    $row = mysqli_fetch_array($result);

    if(!empty ($row['id'])) {   
        $filtered = array(
            'id'=> $row['id'],
            'login'=> $row['login'],
            'up_file'=> $row['up_file'],
            'category'=> $row['category'],
            'title'=> $row['title'],
            'content'=> $row['content'],
            'writeday'=> $row['writeday'],
            'read_num'=> $row['read_num']
        );
    } else {
        echo '<script>if(!alert("해당 내용이 존재하지 않습니다.")) document.location = "http://localhost/wargame/board.php";</script>';
    }
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
        <link rel="stylesheet" type="text/css" href="css\board_view.css">
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
                        <td class="t_common1"><font color="white">제목</td>
                        <td colspan="3" class="t_title"><font color="white"><?=$filtered['title']?></td>
                    </tr>                  
                    <tr>
                        <td class="t_common1"><font color="white">날짜</td>
                        <td class="t_common2"><font color="white"><?=$filtered['writeday']?></td>
                        <td class="t_common1"><font color="white">조회수</td>
                        <td class="t_common2"><font color="white"><?=$filtered['read_num']?></td>
                    </tr>
                    <tr>
                        <td class="t_common1"><font color="white">글쓴이</td>
                        <td class="t_common2"><font color="white"><?=$filtered['login']?></td>
                        <td class="t_common1"><font color="white">파일</td>
                        <td class="t_common2"><font color="white"><a href="upload/file/<?=$filtered['up_file']?>" download><?=$filtered['up_file']?></a></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="t_comment_title"><font color="white">내용</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="t_comment"><font color="white"><?=$filtered['content']?></td>
                    </tr>               
                </tbody>
            </table>
        </div>
        <div>
            
        </div>
        <div align="right">
            <span>
                <button onclick="location.href='board.php'">목록</button>                
                <button onclick="location.href='board_modify.php?index=<?=$_GET['index']?>'">수정</button>
                <button onclick="">답글</button>
                <button onclick="location.href='process_board_delete.php?index=<?=$row['id']?>'">삭제</button>
            </span>
        </div>
    </body>
</html>