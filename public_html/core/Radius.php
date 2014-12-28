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
        
        public function setSessionTime($username,$limit)
        {
            $radcheckData = array (
                'id'        => null,
                'username'  => $username,
                'attribute' => 'Max-All-Session',
                'op'        => ':=',
                'value'     => $limit
            );
            
            $radiusTable = new RadiusTable();
            $data = $radiusTable->findRadcheck($radcheckData);
            if($data===false){
                //add
                $radiusTable->insertRadcheck($radcheckData);
                $arr = array(
                    'success' => 'true',
                    'account' => $radcheckData['username'],
                    'Session Time' => $radcheckData['value']
                        );
                return $arr;          
            } else {
                $radcheckData['id']=$data['id'];
                $radcheckData['value']=(string)((int)$radcheckData['value']+(int)$data['value']);
                $radiusTable->updateRadcheck($radcheckData);
                $arr = array(
                    'success' => 'true',
                    'account' => $radcheckData['username'],
                    'Session Time' => $radcheckData['value']
                        );
                return $arr;
            }
        }
        
        public function leftSessionTime($username)
        {
            $radiusData = array (
                'username'  => $username,
                'attribute' => 'Max-All-Session',
            );
            $radiusTable = new RadiusTable();
            $data = $radiusTable->findRadcheck($radiusData);
            $usedSessionTime = (int)$radiusTable->usedSessionTime($radiusData);
            $leftTime = (int)$data['value']-$usedSessionTime;
            
            $sisamenit = $leftTime/60;
            $sisamenit*=1;
            $sisamenit=floor($sisamenit);
            $sisamenit/=1;
            $sisamenit=$sisamenit%60;
            
            $sisajam = $leftTime/3600;
            $sisajam*=1;
            $sisajam=floor($sisajam);
            $sisajam/=1;
                    
            $arr = array(
                'hours' => $sisajam,
                'minutes' => $sisamenit,
                'seconds' => (string)$leftTime%60,
                'lefttotal' => $leftTime,
                'usedtotal' => $usedSessionTime
            );
            
            return $arr;
        }
    }
?>