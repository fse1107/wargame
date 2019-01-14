<?php
session_start();

include 'db_info.php';

//인젝션 방지
//$pattern = '/\'|\"/';
$pattern = "/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i";

if((preg_match($pattern, $_POST['id']) === 0) && (preg_match($pattern, $_POST['ps']) === 0)){

//앞에 \가 붙음 (\')    
    $filtered = array(
        'id'=> mysqli_real_escape_string($conn, $_POST['id']),
        'ps'=> password_hash($_POST['ps'], PASSWORD_DEFAULT)
    );    

    if(!empty($filtered['id']) && !empty($filtered['ps'])){
        //가입된 아이디가 존재하는지 찾음
        $sql = "SELECT login FROM users WHERE login = '{$filtered['id']}'";  
        $result = mysqli_query($conn, $sql);        
        
        if($result === FALSE){
            echo '<script>if(!alert("저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요."))document.location = "http://localhost/wargame/create_account.php";</script>';
            error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
        } else {
            $row = mysqli_fetch_array($result);
                    
            //중복된 아이디가 없으면 회원가입 진행
            if(empty ($row['login'])){
                $sql = "INSERT INTO users (login, password) VALUES('{$filtered['id']}', '{$filtered['ps']}')";
                $result = mysqli_query($conn, $sql);

                if($result === FALSE){
                    echo '<script>if(!alert("저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요."))document.location = "http://localhost/wargame/create_account.php";</script>';
                    error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
                } else {
                    $row = mysqli_fetch_array($result);
                    echo '<script>if(!alert("회원가입이 완료되었습니다."))document.location = "http://localhost/wargame/login.php";</script>';
                           
                }
            } else {    //중복된 아이디가 존재 시
                echo '<script>if(!alert("ID가 존재합니다. 다시 회원가입해주십시요."))document.location = "http://localhost/wargame/create_account.php";</script>';                
            }
        }    
    } else {
        echo '<script>if(!alert("ID와 PSSWORD를 모두 입력해주세요."))document.location = "http://localhost/wargame/create_account.php";</script>';
    }
} else {
    echo '<script>if(!alert("인젝션 공격이 감지되었습니다 다시 입력해주십시오."))document.location = "http://localhost/wargame/create_account.php";</script>';
}

?>
