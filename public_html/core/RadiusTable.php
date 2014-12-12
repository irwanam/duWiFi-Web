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
    }
?>