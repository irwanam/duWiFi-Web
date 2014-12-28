<?php
    require_once '../core/TableGateway.php';
    require_once '../core/Database.php';
    
    class MemberTable extends TableGateway
    {

        function __construct() {
        
        }
        
        public function insertMember($data)
        {
            $con = new Database();
            $db = $con->connect();
            $sth = $db->prepare("INSERT INTO member (id,first_name,last_name,email,username,password) VALUES (:id,:first_name,:last_name,:email,:username,:password)");
            $sth->bindParam(':id',$data['id'],PDO::PARAM_INT);
            $sth->bindParam(':first_name',$data['first_name'],PDO::PARAM_STR);
            $sth->bindParam(':last_name',$data['last_name'],PDO::PARAM_STR);
            $sth->bindParam(':email',$data['email'],PDO::PARAM_STR);
            $sth->bindParam(':username',$data['username'],PDO::PARAM_STR);
            $sth->bindParam(':password',$data['password'],PDO::PARAM_STR);
            $sth->execute();
        }
        
        
        public function updateMember($data)
        {
            $con = new Database();
            $db = $con->connect();
            $sth = $db->prepare("UPDATE member SET first_name=:first_name, last_name=:last_name, email=:email, password=:password, handphone=:handphone, address=:address, avatar=:avatar, sex=:sex, dob=:dob, last_update=now() WHERE id=:id");
            $sth->bindParam(':id',$data['id'],PDO::PARAM_INT);
            $sth->bindParam(':first_name',$data['first_name'],PDO::PARAM_STR);
            $sth->bindParam(':last_name',$data['last_name'],PDO::PARAM_STR);
            $sth->bindParam(':email',$data['email'],PDO::PARAM_STR);
            $sth->bindParam(':password',$data['password'],PDO::PARAM_STR);
            $sth->bindParam(':handphone',$data['handphone'],PDO::PARAM_STR);
            $sth->bindParam(':address',$data['address'],PDO::PARAM_INT);
            $sth->bindParam(':avatar',$data['avatar'],PDO::PARAM_INT);
            $sth->bindParam(':sex',$data['sex'],PDO::PARAM_INT);
            $sth->bindParam(':dob',$data['dob'],PDO::PARAM_STR);
            $sth->execute();
        }
        
        public function checkMember($key, $val)
        {
            $con = new Database();
            $db = $con->connect();
            $data = $db->query("SELECT $key FROM member WHERE $key='$val'");
            $exist = $data->rowCount();
            if($exist !== 0){
		return true;
            } else {
                return false;
            }
        }
        
        public function checkLogin($data)
        {
            $con = new Database();
            $db = $con->connect();
            $data = $db->query("SELECT * FROM member WHERE email='$data->email' AND password='$data->password'");
            $exist = $data->rowCount();
            $member = $data->fetch(PDO::FETCH_ASSOC);
            
            if($exist !== 0){
                $arr = array(
                    'success' => 'true',
                    'id' => $member['id'],
                    'first_name' => $member['first_name'],
                    'last_name' => $member['last_name'],
                    'email' => $member['email'],
                    'username' => $member['username'],
                    'password' => $member['password'],
                );		
            } else {
                $arr = array(
                    'success' => 'false'
                );
            }
            return $arr;
        }
    }
?>