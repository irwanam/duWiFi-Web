<?php
    require_once '../core/Session.php';
    $session = new Session();
    session_start();
    //Check Session login
    if(isset($_POST['session_check'])){
        if(isset($_SESSION['is_logged'])){
            $arr = array (
                'logged' => 'true',
                'idmember' => $_SESSION['id'],
                'name' => $_SESSION['name'],
                'email' => $_SESSION['email'],
                'username' => $_SESSION['username'],
                'password' => $_SESSION['password'],
                'hotspot' => (isset($_SESSION['hotspot']))? $_SESSION['hotspot'] : 'offline'
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
    
    if(isset($_POST['session_logout'])){
        $session->stop();
    }
    
    if(isset($_POST['session_hotspot_login'])){
        ($_POST['session_hotspot_login']=="online")?$_SESSION['hotspot'] = 'online':$_SESSION['hotspot'] = 'offline';
    }
?>