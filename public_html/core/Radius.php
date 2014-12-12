<?php
    require_once '../core/RadiusTable.php';
    class Radius
    {
        
        public function __construct()
        {

        }
        
        public function newAccount($data)
        {
            $radcheckData = array (
                'id'        => $data->id,
                'username'  => $data->username,
                'attribute' => 'Cleartext-Password',
                'op'        => ':=',
                'value'     => $data->password,
            );
            $radiusTable = new RadiusTable();
            if(empty($data->id)){
                $radiusTable->insertRadcheck($radcheckData);
                $arr = array(
                    'success' => 'true',
                    'account' => $data->username
                        );
            } else {
                $arr = array(
                    'success' => 'false',
                    'account' => $data->username
                        );
            }
            return $arr;
        }
        
        //public function giftRegister
    }
?>