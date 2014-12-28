<?php
    require_once '../PEAR2_Net_RouterOS-1.0.0b5.phar';
    use PEAR2\Net\RouterOS;
    require_once '../PEAR2/Autoload.php';
    
    class Mikrotik
    {
        protected $mkt_host = '192.168.10.253';
        protected $mkt_user = 'duwifi-reader';
        protected $mkt_pass = 'sijitok';
        
        public function __construct()
        {

        }
        
        public function Connect()
        {
            $connect = new RouterOS\Client($this->mkt_host, $this->mkt_user, $this->mkt_pass);
            return $connect;
        }
        
        public function checkUserLogin($username)
        {
            $client = $this->Connect();
            $isActive = new RouterOS\Request(
			'/ip hotspot active print .proplist=user',
			RouterOS\Query::where('user', $username)
		);
            $userlist = $client->sendSync($isActive)->getAllOfType(RouterOS\Response::TYPE_DATA);
            foreach($userlist as $row){
                var_dump($row);
            }
        }
    }
?>