<?php
    require_once '../core/Member.php';
    require_once '../core/Radius.php';
    require_once '../core/Address.php';
    $member = new Member();
    $radius = new Radius();
    $address = new Address();
    ########################## CONFIG ##############################
    
    $MEMBER_CONFIG['new_username'] = $member->newUsername(8);
    $MEMBER_CONFIG['default_rateLimit'] = '512k/512k';
    $MEMBER_CONFIG['default_sessionLimit'] = 3600; // Dalam satuan detik.
    ################################################################
    
    
    
    //Register New Member
    if(isset($_POST['RegTrigger'])){
        $data = array(
            'first_name'    => (!empty($_POST['first_name'])) ? $_POST['first_name'] : null,
            'last_name'     => (!empty($_POST['last_name'])) ? $_POST['last_name'] : null,
            'email'         => (!empty($_POST['email'])) ? $_POST['email'] : null,
            'username'      => $MEMBER_CONFIG['new_username'],
            'password'      => (!empty($_POST['password'])) ? md5($_POST['password']) : null,
        );
        
        //Insert into database
        $resMember = $member->saveMember($member->exchangeArray($data));
        $resAccount = $radius->addAccount($member->exchangeArray($data));
        $resRateLimit= $radius->addRateLimit($data['username'],$MEMBER_CONFIG['default_rateLimit']);
        $resSessionTime = $radius->setSessionTime($data['username'],$MEMBER_CONFIG['default_sessionLimit']);
        
        //JSON feedback
        echo '[';
        echo json_encode($resMember);
        echo json_encode($resAccount);
        echo json_encode($resRateLimit);
        echo json_encode($resSessionTime);
        echo ']';
        
    }
    
    if(isset($_POST['SaveTrigger'])){
        $currentMember = $member->getMember($_POST['id']);
        $data = array(
            'id'            => $_POST['id'],
            'first_name'    => (!empty($_POST['first_name'])) ? $_POST['first_name'] : $currentMember['first_name'],
            'last_name'     => (!empty($_POST['last_name'])) ? $_POST['last_name'] : $currentMember['last_name'],
            'email'         => (!empty($_POST['email'])) ? $_POST['email'] : $currentMember['email'],
            'password'      => (!empty($_POST['password'])) ? md5($_POST['password']) : $currentMember['password'],
            'handphone'     => (!empty($_POST['handphone'])) ? $_POST['handphone'] : $currentMember['handphone'],
            'address'       => (!empty($_POST['address'])) ? $_POST['address'] : $currentMember['address'],
            'avatar'        => (!empty($_POST['avatar'])) ? $_POST['avatar'] : $currentMember['avatar'],
            'sex'           => (!empty($_POST['sex'])) ? $_POST['sex'] : $currentMember['sex'],
            'dob'           => (!empty($_POST['dob'])) ? $_POST['dob'] : $currentMember['dob']
        );
        
        //Insert into database
        $resMember = $member->saveMember($member->exchangeArray($data));
        
        //JSON feedback
        echo json_encode($resMember);
        
    }
    
    //Check Member Email Exist 
    if(isset($_REQUEST['email'])){
        $resemail = $member->existEmail($_REQUEST['email']);
        echo $resemail;
    }
    
    if(isset($_POST['getMember'])){
        $resMember = $member->getMember($_POST['getMember']);
        echo json_encode($resMember);
    }
    
    if(isset($_POST['getAvatar'])){
        $resAvatar = $member->getAvatar($_POST['getAvatar']);
        echo json_encode($resAvatar);
    }
    
    if(isset($_POST['getAddress'])){
        $resAddress = $address->getAddress($_POST['getAddress']);
        echo json_encode($resAddress);
    }
    
    if(isset($_POST['SaveAddressTrigger'])){
        $currentAddress = $address->getAddress($_POST['idaddress']);
        $data = array(
            'idmember'     => $_POST['idmember'],
            'idaddress'    => (!empty($_POST['idaddress'])) ? $_POST['idaddress'] : $currentAddress['idaddress'],
            'address'      => (!empty($_POST['address'])) ? $_POST['address'] : $currentAddress['address'],
            'village'      => (!empty($_POST['village'])) ? $_POST['village'] : $currentAddress['village'],
            'district'     => (!empty($_POST['district'])) ? $_POST['district'] : $currentAddress['district'],
            'city'         => (!empty($_POST['city'])) ? $_POST['city'] : $currentAddress['city'],
            'postal_code'  => (!empty($_POST['postal_code'])) ? $_POST['postal_code'] : $currentAddress['postal_code'],
            'phone'        => (!empty($_POST['phone'])) ? $_POST['phone'] : $currentAddress['phone'],
        );
        
        //Insert into database
        $resAddress = $address->saveAddress($address->exchangeArray($data));
        
        //JSON feedback
        echo json_encode($resAddress);   
    }
?>