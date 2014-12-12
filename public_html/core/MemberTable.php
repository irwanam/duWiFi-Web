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
        
        public function findUsername($username)
        {
            $con = new Database();
            $db = $con->connect();
            $data = $db->query("SELECT username FROM member WHERE username='$username'");
            if($data !== false){
		return true;
            } else {
                return false;
            }
        }
    }
?>