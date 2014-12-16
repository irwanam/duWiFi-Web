<?php
    require_once '../core/RadiusTable.php';
    class Radius
    {
        
        public function __construct()
        {

        }
        
        public function addAccount($data)
        {
            $radcheckData = array (
                'id'        => null,
                'username'  => $data->username,
                'attribute' => 'Cleartext-Password',
                'op'        => ':=',
                'value'     => $data->password,
            );
            $radiusTable = new RadiusTable();
            $radiusTable->insertRadcheck($radcheckData);
            $arr = array(
                'success' => 'true',
                'email'   => $data->email,
                'account' => $data->username
                    );
            return $arr;
        }
        
        public function addRateLimit($username,$limit)
        {
            $radreplyData = array (
                'id'        => null,
                'username'  => $username,
                'attribute' => 'Mikrotik-Rate-Limit',
                'op'        => ':=',
                'value'     => $limit
            );
            $radiusTable = new RadiusTable();
            $radiusTable->insertRadreply($radreplyData);
            $arr = array(
                'success' => 'true',
                'account' => $username,
                'rate-limit' => $limit
                    );
            return $arr;
        }
    }
?>