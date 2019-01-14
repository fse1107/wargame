<?php
session_start();

if(!empty($_SESSION['login'])){
      $login = "환영합니다. {$_SESSION['login']}님";
} else {
    header("Location: login.php");
}

include 'db_info.php';

$sql = "UPDATE board_data SET login='{$_SESSION['login']}', title='{$_POST['title']}', content='{$_POST['content']}', writeday=NOW(), read_num=0 WHERE id='{$_GET['index']}'";
$result=mysqli_query($conn, $sql);


       
if($result === FALSE){
    echo '<script>if(!alert("데이터베이스에 문제가 생겼습니다. 관리자에게 문의해주세요.")) document.location = "http://localhost/wargame/board.php";</script>';
    error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
} else {    
    echo '<script>if(!alert("성공적으로 수정되었습니다.")) document.location = "http://localhost/wargame/board.php?";</script>';   
}
?>
