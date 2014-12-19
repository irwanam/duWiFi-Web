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
                'password' => $_SESSION['password']
            );
        } else{
            $arr = array (
                'logged' => 'false'
            );
        }
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
            header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        }
        else {
            header('Access-Control-Allow-Origin: *');
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
?>