<?php
    require_once '../core/MemberTable.php';
    require_once '../core/RadiusTable.php';
    
    class Member
    {   
        public $id;
        public $first_name;
        public $last_name;
        public $email;
        public $password;
        public $address;
        public $city;
        public $company;
        public $sex;
        public $dob;
        public $last_update;
        
        public function __construct()
        {

        }
        
        public function exchangeArray($data)
        {
            $this->id           = (isset($data['id'])) ? $data['id'] : null;
            $this->first_name   = (isset($data['first_name'])) ? $data['first_name'] : null;
            $this->last_name    = (isset($data['last_name'])) ? $data['last_name'] : null;
            $this->email        = (isset($data['email'])) ? $data['email'] : null;
            $this->username     = (isset($data['username'])) ? $data['username'] : null;
            $this->password     = (isset($data['password'])) ? $data['password'] : null;
            $this->address      = (isset($data['address'])) ? $data['address'] : null;
            $this->city         = (isset($data['city'])) ? $data['city'] : null;
            $this->company      = (isset($data['company'])) ? $data['company'] : null;
            $this->sex          = (isset($data['sex'])) ? $data['sex'] : null;
            $this->dob          = (isset($data['dob'])) ? $data['dob'] : null;
            
            return $this;
        }
        
        public function saveMember($data)
        {
            $memberData = array(
                'id'            => $data->id,
                'first_name'    => $data->first_name,
                'last_name'     => $data->last_name,
                'email'         => $data->email,
                'username'      => $data->username,
                'password'      => $data->password,
                'address'       => $data->address,
                'city'          => $data->city,
                'company'       => $data->company,
                'sex'           => $data->sex,
                'dob'           => $data->dob
                );
            $memberTable = new MemberTable();
            if(empty($data->id)){
                $memberTable->insertMember($memberData);
                $arr = array(
                    'success' => 'true',
                    'email' => $data->email
                        );
            } else {
                $arr = array(
                    'success' => 'false',
                    'email' => $data->email
                        );
            }
            return $arr;
        }
        
        public function getAllMembers()
        {
            $db = new MemberTable();
            $member = $db->getData('member');
            return $member;
        }
        
        public function existEmail($email)
        {
            $table = new MemberTable();
            $data = $table->checkMember('email', $email);
            if($data === false){
                $arr = 'true';
            } else {
                $arr = 'false';
            }
            return $arr;
        }
        
        function newUsername($length)
        {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $table = new MemberTable();
            
            do{
                $username = substr( str_shuffle( $chars ), 0, $length );
                $exist = $table->checkMember('username', $username);
            } while ($exist !== false);
            
            return $username;
        }
        
        function memberLogin($data)
        {
            $table = new MemberTable();
            $login = $table->checkLogin($data);
            return $login;
        }
    }
?>