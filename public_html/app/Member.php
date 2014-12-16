<?php
    require_once '../core/Member.php';
    require_once '../core/Radius.php';
    
    $member = new Member();
    $radius = new Radius();
    
    //Register New Member
    if(isset($_POST['RegTrigger'])){
        $data = array(
            'first_name'    => (!empty($_POST['first_name'])) ? $_POST['first_name'] : null,
            'last_name'     => (!empty($_POST['last_name'])) ? $_POST['last_name'] : null,
            'email'         => (!empty($_POST['email'])) ? $_POST['email'] : null,
            'username'      => $member->newUsername(8),
            'password'      => (!empty($_POST['password'])) ? md5($_POST['password']) : null,
        );
        
        //Insert into database
        $resMember = $member->saveMember($member->exchangeArray($data));
        $resAccount = $radius->addAccount($member->exchangeArray($data));
        $resRateLimit= $radius->addRateLimit($data['username'],'512k/512k');
        
        //JSON feedback
        echo '[';
        echo json_encode($resMember);
        echo json_encode($resAccount);
        echo json_encode($resRateLimit);
        echo ']';
        
    }
    
    //Check Member Email Exist 
    if(isset($_REQUEST['email'])){
        $resemail = $member->existEmail($_REQUEST['email']);
        echo $resemail;
    }
?>