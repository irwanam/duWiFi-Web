<?php
    require_once '../core/Database.php';

    class TableGateway
    {
        
        public function __construct()
        {

        }
        
        public function getAllData($table)
        {
            $con = new Database();
            $db = $con->connect();
            $data = $db->query("SELECT * FROM $table");
            
            if($data === false){
		return NULL;
            }

            $record = $data->fetchall(PDO::FETCH_ASSOC);
            return $record;
        }
        public function getData($table,$id)
        {
            $con = new Database();
            $db = $con->connect();
            $data = $db->query("SELECT * FROM $table WHERE id=$id");
            
            if($data === false){
		return NULL;
            }

            $record = $data->fetch(PDO::FETCH_ASSOC);
            return $record;
        }
        
    }
?>