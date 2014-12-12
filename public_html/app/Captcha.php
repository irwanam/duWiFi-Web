<?php
    include_once '../core/Captcha.php';
    
    $cap = new Captcha();
    if(isset($_POST['captchaResponse'])){
        $success = $cap->verifyResponse($_POST['captchaResponse']);
        echo json_encode($success);
    }
?>