<?php
    include 'db_info.php';

    $sql = "SELECT * FROM users WHERE login = '{$_SESSION['login']}'";
    $result = mysqli_query($conn, $sql);    
    
    $Information = array(
        'id'=>'',
        'ps'=>''
    );
    
    if($result === FALSE){
        echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
        error_log(mysqli_error($conn)); //서버 아파치 에러로그에 기록
    } else {
        $row = mysqli_fetch_array($result);
        $Information['id'] = htmlspecialchars($row['login']);
        $Information['ps'] = htmlspecialchars($row['password']);        
    }
?>