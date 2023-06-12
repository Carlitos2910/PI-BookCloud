<?php

    namespace Lib;
    use PDOException;


    class Captcha {
        protected $secretKey = '0x36cB889D0111D7E1Da35faB828b37572caF3A3E2';
        protected $captchaVerificationEndpoint = 'https://hcaptcha.com/siteverify';

        public function checkCaptcha($response) {
            try{
                $data = array('secret' => $this->secretKey,'response' => $response);
                $responseData = json_decode($this->verifyCaptcha($data));
            }catch(PDOException $e){
                return false;
            }

            return true;
        }

        protected function verifyCaptcha($data) {
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, $this->captchaVerificationEndpoint);
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);

            return curl_exec($verify);
        }
    }

?>