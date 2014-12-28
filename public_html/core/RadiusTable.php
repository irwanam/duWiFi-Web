<?php
    require_once '../core/TableGateway.php';
    require_once '../core/Database.php';
    
    class RadiusTable extends TableGateway
    {
        
        public function __construct()
        {

        }
        
        public function insertRadcheck($data)
        {
            $con = new Database();
            $db = $con->connect();
            $sth = $db->prepare("INSERT INTO radcheck (id,username,attribute,op,value) VALUES (:id,:username,:attribute,:op,:value)");
            $sth->bindParam(':id',$data['id'],PDO::PARAM_INT);
            $sth->bindParam(':username',$data['username'],PDO::PARAM_STR);
            $sth->bindParam(':attribute',$data['attribute'],PDO::PARAM_STR);
            $sth->bindParam(':op',$data['op'],PDO::PARAM_STR);
            $sth->bindParam(':value',$data['value'],PDO::PARAM_STR);
            $sth->execute();
        }

        public function updateRadcheck($data)
        {
            $con = new Database();
            $db = $con->connect();
            $sth = $db->prepare("UPDATE radcheck SET value=:value WHERE id=:id");
            $sth->bindParam(':id',$data['id'],PDO::PARAM_INT);
            $sth->bindParam(':value',$data['value'],PDO::PARAM_STR);
            $sth->execute();
        }
        
        public function findRadcheck($data)
        {
            $username = $data['username'];
            $attribute = $data['attribute'];
            $con = new Database();
            $db = $con->connect();
            $res = $db->query("SELECT * FROM radcheck where username='$username' AND attribute='$attribute'");
            
            $record = $res->fetch(PDO::FETCH_ASSOC);
            return $record;
        }

        public function insertRadreply($data)
        {
            $con = new Database();
            $db = $con->connect();
            $sth = $db->prepare("INSERT INTO radreply (id,username,attribute,op,value) VALUES (:id,:username,:attribute,:op,:value)");
            $sth->bindParam(':id',$data['id'],PDO::PARAM_INT);
            $sth->bindParam(':username',$data['username'],PDO::PARAM_STR);
            $sth->bindParam(':attribute',$data['attribute'],PDO::PARAM_STR);
            $sth->bindParam(':op',$data['op'],PDO::PARAM_STR);
            $sth->bindParam(':value',$data['value'],PDO::PARAM_STR);
            $sth->execute();
        }
        
        public function usedSessionTime($data)
        {
            $username = $data['username'];
            $con = new Database();
            $db = $con->connect();
            $res = $db->query("SELECT SUM(acctsessiontime)AS usedSessionTime FROM radacct where username='$username'");
            
            $record = $res->fetch(PDO::FETCH_ASSOC);
            
            return $record['usedSessionTime'];
        }
    }   
?>