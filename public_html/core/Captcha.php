<?php
    class Captcha
    {
        protected $secretKey = '6Lf_4f4SAAAAAMg2IZqMYK3R-IHs4LSpRPMOE-QA';
        protected $remote_ip;
        protected $response;
        protected $request;
        public function __construct()
        {

        }
        public function verifyResponse($response)
        {
            $this->remote_ip = $_SERVER['REMOTE_ADDR'];
            $this->response = $response;
            $this->request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$this->secretKey}&response={$this->response}&remoteip={$this->remote_ip}");
            
            if(!strstr($this->request, "true")){
                $arr = array(
                    'success' => 'false',
                    'message' => 'Captcha Verification Failed');
            }
            else{
                $arr = array(
                    'success' => 'true',
                    'message' => 'Captcha Verification Success');
            }
            return $arr;
        }
    }
?>