<?php
session_start();

if(!empty($_SESSION['login'])){
      $login = "환영합니다. {$_SESSION['login']}님";
} else {
    header("Location: login.php");
}

include 'db_info.php';

ini_set("display_errors", "1");
$uploaddir = 'C:\xampp\htdocs\wargame\upload\file\\';
$uploadfile = $uploaddir . basename($_FILES['myfile']['name']);

if(move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)){
    echo '파일이 유효하고, 성공적으로 업로드 되었습니다.';
} else {
    print "파일 업로드 공격의 가능성이 있습니다.\n";
}

$filtered = array(
    'login'=> $_SESSION['login'],
    'title'=> $_POST['title'],
    'up_file'=> basename($_FILES['myfile']['name']),
    'content'=> $_POST['content']
);

$sql = "INSERT INTO board_data (login, title, up_file, content, writeday, read_num) VALUES('{$filtered['login']}', '{$filtered['title']}', '{$filtered['up_file']}', '{$filtered['content']}', NOW(), 0)";
$result=mysqli_query($conn, $sql);
       
if($result === FALSE){
    echo '<script>if(!alert("데이터베이스에 문제가 생겼습니다. 관리자에게 문의해주세요.")) document.location = "http://localhost/wargame/board.php";</script>';
    error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
} else {    
    echo '<script>if(!alert("성공적으로 저장이 되었습니다.")) document.location = "http://localhost/wargame/board.php";</script>';   
}
?>
<img src="file/<?=$_FILES['myfile']['name']?>"/>
             