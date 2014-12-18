<?php
    require_once '../core/Member.php';

    class Session
    {
        
        public function __construct()
        {

        }
        
        public function tryLogin($data)
        {
            $member = new Member();
            $dataLogin = $member->exchangeArray($data);
            $login = $member->memberLogin($dataLogin);
            if($login['success']!=='false'){
                $this->start($login);
                $arr = array(
                    'success' => 'true'
                );
            } else {
                $arr = array(
                    'success' => 'false'
                );
            }
            return $arr;
        }
        
        public function start($data)
        {
            $_SESSION['is_logged']='true';
            $_SESSION['id']=$data['id'];
        }
        
        public function stop()
        {
            session_destroy();
        }
    }
?>