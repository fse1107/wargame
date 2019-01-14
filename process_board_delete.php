<?php
session_start();

if(!empty($_SESSION['login'])){
      $login = "환영합니다. {$_SESSION['login']}님";
} else {
    header("Location: login.php");
}

include 'db_info.php';

$sql = "SELECT id, login FROM board_data WHERE id={$_GET['index']}";
$result=mysqli_query($conn, $sql);


       
if($result === FALSE){
    echo '<script>if(!alert("데이터베이스에 문제가 생겼습니다. 관리자에게 문의해주세요.")) document.location = "http://localhost/wargame/board.php";</script>';
    error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
} else {
    $row = mysqli_fetch_array($result);
    
    if(!empty($row['id'])){
        if(($_SESSION['login'] === $row['login']) || ($_SESSION['login'] === 'admin')){
            $sql = "DELETE FROM board_data WHERE id={$_GET['index']}";
            mysqli_query($conn, $sql);        
            echo '<script>if(!alert("정상적으로 삭제되었습니다.")) document.location = "http://localhost/wargame/board.php";</script>'; 
        }
        else{
            echo '<script>if(!alert("해당 게시판을 삭제할 권한이 없습니다.")) document.location = "http://localhost/wargame/board.php";</script>';  
        }            
    }
    else{        
        echo '<script>if(!alert("해당 게시판이 존재하지 않습니다.")) document.location = "http://localhost/wargame/board.php";</script>';   
    }   
}
?>

