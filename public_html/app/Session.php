<?php
    require_once '../core/Session.php';
    $session = new Session();
    session_start();
    //Check Session login
    if(isset($_POST['session_check'])){
        if(isset($_SESSION['is_logged'])){
            $arr = array (
                'logged' => 'true',
                'idmember' => $_SESSION['id']
            );
        } else{
            $arr = array (
                'logged' => 'false'
            );
        }
        echo json_encode($arr);
    }
    
    if(isset($_POST['session_login'])){
        $dataLogin = array (
            'email' => $_POST['email'],
            'password' => md5($_POST['password'])
        );
        $loginstatus = $session->tryLogin($dataLogin);
        echo json_encode($loginstatus);
    }
    
    if(isset($_GET['logout'])){
        $session->stop();
        echo 'berhasil logout';
    }
?>