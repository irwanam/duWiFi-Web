<?php
    class Database
    {
        protected $db_host = 'localhost';
        protected $db_user = 'root';
        protected $db_pass = '';
        protected $db_name = 'duwifi';
        
        public function __construct()
        {

        }
        
        public function connect()
        {
            try {
                $dbh = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            return $dbh;
        }
        
    }
?>