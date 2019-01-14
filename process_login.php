<?php
session_start();

//데이터베이스 연결
include 'db_info.php';

//인젝션 방지
//$pattern = '//';
$pattern = "/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i";
        
if((preg_match($pattern, $_POST['id']) === 0) && (preg_match($pattern, $_POST['ps']) === 0)){

//앞에 \가 붙음 (\')   
    $filtered = array(
        'id'=> mysqli_real_escape_string($conn, $_POST['id']),
        'ps'=> mysqli_real_escape_string($conn, $_POST['ps'])
    );


    if(!empty($filtered['id']) && !empty($filtered['ps'])){
        $sql = "SELECT password FROM users WHERE login='{$filtered['id']}'";
        $result = mysqli_query($conn, $sql);
        
        if($result === FALSE){
            echo '<script>if(!alert("로그인하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.")) document.location = "http://localhost/wargame/login.php";</script>';
            error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
        } else {
            $row = mysqli_fetch_array($result);
            
            if(!empty ($row['password'])) {    
                if(password_verify($filtered['ps'], $row['password'])){
                    $_SESSION['login'] = $filtered['id'];        
                    header('Location: index.php');      
                }         
                else {
                    echo '<script>if(!alert("비밀번호가 틀렸습니다. 다시 입력해주세요.")) document.location = "http://localhost/wargame/login.php";</script>';
                }
            } else {
                echo '<script>if(!alert("회원정보가 없습니다. 회원가입해주십시요.")) document.location = "http://localhost/wargame/login.php";</script>';
            }
        }
        
//        
//        $sql = "SELECT login FROM users WHERE login = '{$filtered['id']}' AND password = '{$filtered['ps']}'";
//
//        $result = mysqli_query($conn, $sql);
//
//        if($result === FALSE){
//            echo '로그인하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
//            error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
//        } else {
//            $row = mysqli_fetch_array($result);
//            
//            if(!empty ($row['login'])) {                
//                $_SESSION['login'] = $filtered['id'];        
//                header('Location: index.php');      
//            } else {
//                echo '회원정보가 없습니다. 회원가입해주십시요.';
//            }
//        }
    } else {
        echo '<script>if(!alert("ID와 PSSWORD를 모두 입력해주세요.")) document.location = "http://localhost/wargame/login.php";</script>';
    }
} else {
    echo '<script>if(!alert("인젝션 공격이 감지되었습니다 다시 로그인해주십시오.")) document.location = "http://localhost/wargame/login.php";</script>';
  
}
?>
