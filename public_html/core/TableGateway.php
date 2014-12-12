<?php
    require_once '../core/Database.php';

    class TableGateway
    {
        
        public function __construct()
        {

        }
        
        public function getData($table)
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
        
        public function updateData()
        {
            $con = new Database();
            $db = $con->connect();
            
        }
    }
?>