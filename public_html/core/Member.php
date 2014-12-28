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
        public $handphone;
        public $address;
        public $avatar;
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
            $this->handphone    = (isset($data['handphone'])) ? $data['handphone'] : null;
            $this->address      = (isset($data['address'])) ? $data['address'] : null;
            $this->avatar       = (isset($data['avatar'])) ? $data['avatar'] : null;
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
                'handphone'     => $data->handphone,
                'address'       => $data->address,
                'avatar'        => $data->avatar,
                'company'       => $data->company,
                'sex'           => $data->sex,
                'dob'           => $data->dob
                );
            $memberTable = new MemberTable();
            if(empty($data->id)){
                $memberTable->insertMember($memberData);
                $arr = array(
                    'success' => 'true',
                    'action' => 'register',
                    'email' => $data->email
                        );
            } else {
                $memberTable->updateMember($memberData);
                $arr = array(
                    'success' => 'true',
                    'action' => 'save'
                        );
            }
            return $arr;
        }
        
        public function getAllMembers()
        {
            $db = new MemberTable();
            $member = $db->getAllData('member');
            return $member;
        }
        
        public function getMember($id)
        {
            $db = new MemberTable();
            $member = $db->getData('member',$id);
            return $member;
        }
        
        public function getAvatar($avaid)
        {
            $db = new MemberTable();
            $avatar = $db->getData('avatar',$avaid);
            return $avatar;
        }
        
        public function getAddress($addressid)
        {
            $db = new MemberTable();
            $address = $db->getData('address',$addressid);
            return $address;
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